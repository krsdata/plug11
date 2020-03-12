<?php

namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth; 
use App\Models\Notification;
use Illuminate\Contracts\Encryption\DecryptException;
use Config,Mail,View,Redirect,Validator,Response; 
use Crypt,okie,Hash,Lang,JWTAuth,Input,Closure,URL; 
use App\Helpers\Helper as Helper;
use PHPMailerAutoload;
use PHPMailer; 
use App\Models\Competition;
use App\Models\TeamA;
use App\Models\TeamB;
use App\Models\Toss;
use App\Models\Venue;
use App\Models\Matches;
use App\Models\Player;
use App\Models\TeamASquad;
use App\Models\TeamBSquad;
use App\Models\CreateContest;
use App\Models\CreateTeam;
use App\Models\Wallet;
use App\Models\WalletTransaction;
use App\Models\Rank;
use App\Models\JoinContest;



class UserController extends BaseController
{
   
    public function __construct(Request $request) {

        if ($request->header('Content-Type') != "application/json")  {
            $request->headers->set('Content-Type', 'application/json');
        } 
    } 

    public function generateUserName(){
        $uname =  Helper::generateRandomString();
        $is_user = 1;   
        while ($is_user=null) {
            $is_user = User::where('user_name',$uname)->first();
            if($is_user){
                $uname      = Helper::generateRandomString();
            }
        }
        return $uname;
    }

    public function registration(Request $request)
    {   
        $input['first_name']    = $request->get('first_name')??$request->get('name');
        $input['last_name']    = $request->get('last_name');
        
        $input['name']          = $request->get('name')??$request->get('first_name'); 
        $input['email']         = $request->get('email'); 
        $input['password']      = Hash::make($request->input('password'));
        $input['role_type']     = 3; //$request->input('role_type'); ;
        $input['user_type']     = $request->get('user_type');
        $input['provider_id']   = $request->get('provider_id'); 
       // $user = User::firstOrNew(['provider_id'=>$request->get('provider_id')]);
       
        if($request->input('user_id')){
            $u = $this->updateProfile($request,$user);
            return $u;
        } 

        if($input['user_type']=='googleauth' || $input['user_type']=='facebookauth' ){
                //Server side valiation
                $validator = Validator::make($request->all(), [
                   'email' => 'required|email',
                   'name' => 'required',
                   'provider_id' => 'required'
                ]);
        }else{
            //Server side valiation
            $validator = Validator::make($request->all(), [
               'email' => 'required|email|unique:users',
               'password' => 'required',
               'name' => 'required'
            ]);
        }
         
        /** Return Error Message **/
        if ($validator->fails()) {
            $error_msg      =   [];
            foreach ( $validator->messages()->all() as $key => $value) {
                        array_push($error_msg, $value);     
                    }
                    
            return Response::json(array(
                'status' => false,
                'code'=>201,
                'message' => $error_msg[0]
                )
            );
        } 
         
        \DB::beginTransaction();

        $helper = new Helper;
        /** --Create USER-- **/
        $user = new User;
        foreach ($input as $key => $value) {
            $user->$key = $value;    
        }
        $user->user_name = strtoupper(substr($user->name, 0, 3)).$this->generateUserName();
        $user->save(); 

        if($user->id){
            $wallet = new Wallet;
            $wallet->user_id = $user->id;
            $wallet->validate_user = Hash::make($user->id);
            $wallet->save();
            $wallet  =  Wallet::find($wallet->id);
        }
            
        \DB::commit();
        
        $user  = User::find($user->id);
        $user->validate_user = Hash::make($user->id);      
        $user->save();
        
        $user_data['user_id ']         =  $user->id;
        $user_data['name']             =  $user->name; 
        $user_data['email']            =  $user->email; 
        $user_data['bonus_amount']     =  (float)$wallet->bonus_amount;
        $user_data['usable_amount']    =  (float)$wallet->usable_amount;
        
        $subject = "Welcome to Plug11! Verify your email address to get started";
        $email_content = [
                'receipent_email'=> $request->input('email'),
                'subject'=>$subject,
                'greeting'=> 'PLUG11',
                'first_name'=> $request->input('name')??$request->input('first_name')
                ];

      //$verification_email = $helper->sendMailFrontEnd($email_content,'verification_link');
        
        
        $notification = new Notification;
        $notification->addNotification('user_register',$user->id,$user->id,'User register','');

        // user device details
        $devD = \DB::table('hardware_infos')->where('user_id',$user->id)->first();
        if($devD){
            $deviceDetails = json_encode($request->deviceDetails);
            \DB::table('hardware_infos')->where('user_id',$devD->user_id)->update([
            'user_id' => $user->id,
            'device_details' => $deviceDetails
            ]);
        }else{
           $deviceDetails = json_encode($request->deviceDetails);
            \DB::table('hardware_infos')->insert([
            'user_id' => $user->id??0,
            'device_details' => $deviceDetails
            ]); 
        }
       
        return response()->json(
                            [ 
                                "status"=>true,
                                "code"=>200,
                                "message"=>"Thank you for registration. Please verify  your email.",
                                'data' => $user_data,
                                'token' => 1
                            ]
                        );
    }


    public function updateProfile(Request $request)
    {     

        $user = User::find($request->user_id); 

        if(!$request->user_id && (User::find($request->user_id))==null)
        {
            return Response::json(array(
                'status' => false,
                'code' => 201,
                'message' => 'Invalid user Id!',
                'data'  =>  $request->all()
                )
            );
        } 

        if($request->user_name){

            $user_id = User::where('id','!=',$request->user_id)->where('user_name',$request->user_name)->first();
            
            if($user_id){
               return Response::json(array(
                    'status' => false,
                    'code' => 201,
                    'message' => 'User Id already taken!',
                    'data'  =>  $request->all()
                    )
                ); 
            }

        }

        $table_cname = \Schema::getColumnListing('users');
        $except = ['id','created_at','updated_at','profile_image','modeOfreach'];
        
        foreach ($table_cname as $key => $value) {
           
           if(in_array($value, $except )){
                continue;
           } 
            if($request->get($value)){
                $user->$value = $request->get($value);
           }
        }
       
        
        if($request->get('profile_image')){ 
            $profile_image = $this->createImage($request->get('profile_image')); 
            if($profile_image==false){
                return Response::json(array(
                    'status' => false,
                     'code' => 201,
                    'message' => 'Invalid Image format!',
                    'data'  =>  $request->all()
                    )
                );
            }
            $user->profile_image  = $profile_image;       
        }        
           

        try{
            $user->save();
            $status = true;
            $code  = 200;
            $message ="Profile updated successfully";
        }catch(\Exception $e){
            $status = false;
            $code  = 201;
            $message =$e->getMessage();
        }
         
        return response()->json(
                            [ 
                            "status" =>$status,
                            'code'   => $code,
                            "message"=> $message,
                            'data'=>isset($user)?$user:[]
                            ]
                        );
         
    }

    // Image upload

    public function createImage($base64)
    {
        try{
            $img  = explode(',',$base64);
            if(is_array($img) && isset($img[1])){
                $image = base64_decode($img[1]);
                $image_name= time().'.jpg';
                $path = storage_path() . "/image/" . $image_name;
              
                file_put_contents($path, $image); 
                return url::to(asset('storage/image/'.$image_name));
            }else{
                if(starts_with($base64,'http')){
                    return $base64;
                }
                return false; 
            }

            
        }catch(Exception $e){
            return false;
        }
        
    }

     // Validate user
    public function validateInput($request,$input){
        //Server side valiation 

        $validator = Validator::make($request->all(), $input);
         
        /** Return Error Message **/
        if ($validator->fails()) {
            $error_msg      =   [];
            foreach ( $validator->messages()->all() as $key => $value) {
                        array_push($error_msg, $value);     
                    }

            if($error_msg){
               return array(
                    'status' => false,
                    'code' => 201,
                    'message' => $error_msg[0],
                    'data'  =>  $request->all()
                    );
            }

        }
    }
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function customerLogin(Request $request)
    {
       // echo "Email:".$request->email;
        $input = $request->all();
       // print_r ($input);
        $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                     'user_type' => 'required'
                ]);
        if ($validator->fails()) {
            $error_msg = [];
            foreach ($validator->messages()->all() as $key => $value) {
                array_push($error_msg, $value);
            }
            if ($error_msg) {
                return array(
                    'status' => false,
                    'code' => 201,
                    'message' => $error_msg[0],
                    'data' => $request->all()
                );
            }
        }

        $user_type = $request->user_type;
        switch ($user_type) {
            case 'facebookAuth':

                $credentials = [
                        'email'=>$request->get('email'),
                        'provider_id'=>$request->get('provider_id'),
                        'user_type' => 'facebookAuth'
                    ];
                    
                if (User::where($credentials)->first() ){
                   $usermodel =  User::where('email',$request->email)->first();
                  // $usermodel->provider_id = $request->get('provider_id'); 
                  // $usermodel->save(); 
                    $status = true;
                    $code = 200;
                    $message = "login successfully"; 
                }else{ 
                   $user = new User;
                   
                    $user->first_name    = $request->get('first_name');
                    $user->last_name     = $request->get('last_name');
                    $user->name          = $request->get('name'); 
                    $user->email         = $request->get('email'); 
                    $user->role_type     = 3;//$request->input('role_type'); ;
                    $user->user_type     = $request->get('user_type');
                    $user->provider_id   = $request->get('provider_id'); 
                    $user->password   = "";
                    $user->user_name =$this->generateUserName();
                     // strtoupper(substr($request->get('name'), 0, 3)).

                    /** Return Error Message **/
                    if (User::where(['email'=>$request->email])->first()) {
                       
                                
                        return Response::json(array(
                            'status' => false,
                            'code'=>201,
                            'message' =>'Invalid credentials',
                            'data'  =>  $request->all()
                            )
                        );
                    } 

                    $user->save() ;
                    if($user->id){
                        $wallet = new Wallet;
                        $wallet->user_id = $user->id;
                        $wallet->validate_user = Hash::make($user->id);
                        $wallet->save();
                        $wallet  =  Wallet::find($wallet->id);
                    }
                    $user->validate_user = Hash::make($user->id);
                    $user->save();
                    $usermodel = $user;
 
                    $status = true;
                    $code = 200;
                    $message = "login successfully"; 
                }

                break;
            case 'googleAuth':
                
               $credentials = [
                        'email'=>$request->get('email'),
                        'provider_id'=>$request->get('provider_id'),
                        'user_type' => 'googleAuth'
                    ];


                if (User::where('email',$request->email)->first()) {
                        $usermodel = User::where('email',$request->email)->first();
                       // $usermodel->provider_id = $request->get('provider_id'); 
                       // $usermodel->save(); 
                        $status = true;
                        $code = 200;
                        $message = "login successfully"; 
                    } 
                else{    
                    $user = new User;
                   
                    $user->first_name    = $request->get('first_name')??$request->get('name');
                    $user->last_name     = $request->get('last_name'); 
                    $user->email         = $request->get('email'); 
                    $user->role_type     = 3;//$request->input('role_type'); ;
                    $user->user_type     = $request->get('user_type');
                    $user->provider_id   = $request->get('provider_id'); 
                    $user->password   = ""; 
                    
                    $user->user_name = $this->generateUserName();

                    if (User::where(['email'=>$request->email])->first()) {
                       
                                
                        return Response::json(array(
                            'status' => false,
                            'code'=>201,
                            'message' =>'Invalid credentials'
                            )
                        );
                    } 
                        

                    $user->save() ;
                    if($user->id){
                        $wallet = new Wallet;
                        $wallet->user_id = $user->id;
                        $wallet->validate_user = Hash::make($user->id);
                        $wallet->save(); 
                    }

                    $user->validate_user = Hash::make($user->id);
                    $user->save();
                    $usermodel =  $user;
                    $status = true;
                    $code = 200;
                    $message = "login successfully"; 
                }

                break;
            
            default:
                $credentials = [
                        'email'=>$request->get('email'),
                        'password'=>$request->get('password')
                    ];

                 $auth = Auth::attempt($credentials);

                if ($auth ){
                    $usermodel = Auth::user();
                    $status = true;
                    $code = 200;
                    $message = "login successfully";
                }else{ 
                    $usermodel = null;
                    $status = false;
                    $code = 201;
                    $message = "login failed"; 
                }   
                break;
        }

        $data = []; 
        if($usermodel){
            $wallet  = Wallet::where('user_id',$usermodel->id)->first();
            if($wallet!=null){
                $data['name'] = $usermodel->name;
                $data['user_email'] = $usermodel->email;
                $data['user_id'] = $usermodel->id;
                $data['mobile_number'] = $usermodel->phone;
                $data['bonus_amount']     =  (float)$wallet->bonus_amount;
                $data['usable_amount']    = (float)$wallet->usable_amount;  
                $status = true;  
            }
            $devD = \DB::table('hardware_infos')->where('user_id',$usermodel->id)->first();

        if($devD){
            $deviceDetails = json_encode($request->deviceDetails);
            \DB::table('hardware_infos')->where('user_id',$devD->user_id)->update([
            'user_id' => $usermodel->id??0,
            'device_details' => $deviceDetails
            ]);

            \DB::table('users')->where('email',$request->email)->update([
                'device_id'=>$request->device_id
            ]);

        }else{
           $deviceDetails = json_encode($request->deviceDetails);
            \DB::table('hardware_infos')->insert([
            'user_id' => $usermodel->id??0,
            'device_details' => $deviceDetails
            ]); 
            }
          \DB::table('users')->where('id',$usermodel->id)->update([
                'login_status' => true,
                'device_id' => $request->device_id
            ]);       
        }


        $this->sendNotification($request->device_id, 'Login', "successfully logged in at ".date('d-m-Y h:i:s'));

        if($data){
            return response()->json([ 
                    "status"=>$status,
                    "code"=>$code,
                    "message"=> $message ,
                    'data'=> $data??$request->all(),
                    'token' => $usermodel?Hash::make($usermodel->id):1
                 ]);   
        }else{
            return response()->json([ 
                    "status"=>$status,
                    "code"=>$code,
                    'token' => $usermodel?Hash::make($usermodel->id):1
                 ]); 
        }
          
    }

     /* @method : Email Verification
    * @param : token_id
    * Response : json
    * Return :token and email 
   */



   
    public function emailVerification(Request $request)
    {
        $verification_code = $request->input('verification_code');
        $email    = $request->input('email');

        if (Hash::check($email, $verification_code)) {
           $user = User::where('email',$email)->get()->count();
           if($user>0)
           {
              User::where('email',$email)->update(['status'=>1]);  
           }else{
            echo "Verification link is Invalid or expire!"; exit();
                return response()->json([ "status"=>0,"message"=>"Verification link is Invalid!" ,'data' => '']);
           }
           echo "Email verified successfully."; exit();  
           return response()->json([ "status"=>1,"message"=>"Email verified successfully." ,'data' => '']);
        }else{
            echo "Verification link is Invalid!"; exit();
            return response()->json([ "status"=>0,"message"=>"Verification link is invalid!" ,'data' => '']);
        }
    }

    public function temporaryPassword(Request $request){

        $email =  $request->email;
        $user = User::where('email',$email)->first();

        if($user){


            return response()->json([ "status"=>true,'code'=>200,"message"=>"Temporary Password sent"]);

        }else{
            return response()->json([ "status"=>false,'code'=>201,"message"=>"Email does not exist!"]);

        }
    }
   
    public function logout(Request $request){

        $user_id =  User::find($request->user_id);

        if($user_id){
            $user_id->login_status = false;
            $user_id->save();
            return response()->json([ "status"=>true,'code'=>200,"message"=>"Logout successfully"]);
        }else{
            return response()->json([ "status"=>false,'code'=>201,"message"=>"User does not"]); 
        }

    }

    public function deviceNotification(Request $request){

        $user_id =  User::find($request->user_id);
        $device_id = $request->device_id;

        $validator = Validator::make($request->all(), [
               'user_id' => 'required',
               'device_id' => 'required'
        ]);
        /** Return Error Message **/
        if ($validator->fails()) {
            $error_msg      =   [];
            foreach ( $validator->messages()->all() as $key => $value) {
                        array_push($error_msg, $value);     
                    }
                    
            return Response::json(array(
                'status' => false,
                'code'=>201,
                'message' => $error_msg[0]
                )
            );
        } 

        if($user_id){
            $user_id->device_id = $device_id;
            $user_id->save();
            return response()->json([ "status"=>true,'code'=>200,"message"=>"notification updated"]);
        }else{
            return response()->json([ "status"=>false,'code'=>201,"message"=>"something went wrong"]); 
        }
    }

   public function sendPushNotification(){
        $this->sendNotification('fSHkwLUR35c:APA91bH3x8vhQaiQwsVgZvq81GGahd7HST7vo5emBWJhzn6TfbNdxKJtOMxSQf-ZrM1D_TSgzkWL_by6ykcBBaSaja1OVfyY6B4EBOc4bR6eF4ELeN6tUn9mE7w12VYnJSUL6Dst4tx7', "registration", "success");
    }

    public function sendNotification($token, $title_msg, $body){
       
        $serverLKey = 'AIzaSyAFIO8uE_q7vdcmymsxwmXf-olotQmOCgE';
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

       $extraNotificationData = ["message" => $body, "title" => $title_msg];

       $fcmNotification = [
           //'registration_ids' => $tokenList, //multple token array
           'to' => $token, //single token
           //'notification' => $notification,
           'data' => $extraNotificationData
       ];

       $headers = [
           'Authorization: key='.$serverLKey,
           'Content-Type: application/json'
       ];


       $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $fcmUrl);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fcmNotification));
       $result = curl_exec($ch);
       //echo "result".$result;
       //die;
       curl_close($ch);
       return true;
   }    
}
