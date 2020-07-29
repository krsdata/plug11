<?php
namespace App\Http\Controllers\Api;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\BaseController as BaseController;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Models\Notification;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\QueryException;
use Config,Mail,View,Redirect,Validator,Response;
use Crypt,okie,Hash,Lang,JWTAuth,Input,Closure,URL;
use App\Helpers\Helper as Helper;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Monolog\Handler\StreamHandler;
use Illuminate\Support\Str;
use Monolog\Handler\SyslogUdpHandler;
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
use App\Models\JoinContest;
use App\Models\WalletTransaction;
use App\Models\MatchPoint;
use App\Models\PrizeDistribution;
use App\Models\MatchStat;
use App\Models\ReferralCode;
use File;
use Ixudra\Curl\Facades\Curl;
use PaytmWallet;

class ApiController extends BaseController
{

    public $token;
    public $date;
    public $cric_url;

    public function __construct(Request $request) {
        $this->date = date('Y-m-d');
        $this->token = env('CRIC_API_KEY',"8740931958a5c24fed8b66c7609c1c49");
        $request->headers->set('Accept', 'application/json');
        
        $this->cric_url = 'https://rest.entitysport.com/v2/';

        if ($request->header('Content-Type') != "application/json")  {
            $request->headers->set('Content-Type', 'application/json');
        }
    }

    public function statusCheck(Request $request)
    {
        $order_id = $request->order;
        $status = PaytmWallet::with('status');
        $status->prepare(['order' => $order_id]);
        $s = $status->check();
        $response = $status->response(); // To get raw response as array

        try{
            if($status->isSuccessful()){
            $response['SF_STATUS'] = 1;
           return $response;
        }else if($status->isFailed()){
            $response['SF_STATUS'] = 2;
            return $response;
        }else if($status->isPending()){
            $response['SF_STATUS'] = 3;
          return $response;
        }
        }catch(\Exception $e){
            $response['SF_STATUS'] = 2;
          return $response;
        }
        
        
    }

    /**
     * Obtain the payment information.
     *
     * @return Object
     */
    public function paymentCallback(Request $request )
    {   
        try{
            $transaction = PaytmWallet::with('receive');
            $response = $transaction->response(); // To get raw response as array
            $data['paytm'] =  json_encode($response);   
            \DB::table('paytm')->insert($data);
            return true;
        }catch(\Exception $e){

        }
    }  
    
    public function contestFillNotify(Request $request)
    {
        $device_id = User::whereNotNull('device_id')->pluck('device_id')->toArray();

        $match = Matches::where('status',1)
                ->whereDate('date_start',\Carbon\Carbon::today())
                ->where('timestamp_start','>=',time())
                ->first();
        $t1 = $match->timestamp_start;
        $t2 = time();
        $td = round((($t1 - $t2)/60),2);
        $cf = $match->short_title??'Contest Filling fast';
        $data = [
            'action' => 'notify' ,
            'title' => "🏏 $cf  🕚 🏆🏆 🔔",
            'message' => '**Contest is filling fast. Create your team and join the contest. Hurry up!!**'
        ];
                        
        if($td>5 && $td%15==0 || $td<120){        
            $this->sendNotification($device_id, $data);  
            return ['true']; 
        }
        if($request->status==1){
            $this->sendNotification($device_id, $data);  
            return ['true'];
        }
    }

    public function apkUpdate(Request $request ){

        $version_code = $request->version_code;

        if($version_code){

            $apk_update_status = \DB::table('apk_updates')
                ->where('version_code','>',$version_code)
                ->first();
            if($apk_update_status){
                return [
                    'status'        =>  true,
                    'code'          =>  200,
                    'message'       =>  $apk_update_status->message?$apk_update_status->message:'Update is available',
                    'url'           =>  $apk_update_status->url,
                    'title'         =>  $apk_update_status->title,
                    'url'           =>  $apk_update_status->url,
                    'release_note'  =>  $apk_update_status->release_notes??'new updates'
                ];
            }else{
                return [
                    'status'        =>  false,
                    'code'          =>  201,
                    'message'       =>  'No update available',
                    'url'           =>  null,
                    'title'         =>  null,
                    'url'           =>  null,
                    'release_note'  =>  null
                ];
            }

        }else{
            return [
                'status'        =>  false,
                'code'          =>  201,
                'message'       =>  'No update available',
                'url'           =>  null,
                'title'         =>  null,
                'url'           =>  null,
                'release_note'  =>  null
            ];
        }
    }
    /*
    @var match_id
    @var content_id
    @desc join contest status
    */
    public function joinNewContestStatus(Request $request){

        $match_id   = $request->match_id;
        $contest_id = $request->contest_id;

        $cc = CreateContest::where('match_id',$match_id)
            ->where('id',$contest_id)
            ->first();

        $create_teams = \DB::table('create_teams')
            ->where('match_id',$match_id)
            ->where('user_id',$request->user_id);
        

        $create_teams_count = $create_teams->count();

        $join_contests = \DB::table('join_contests')
            ->where('match_id',$match_id)
            ->where('user_id',$request->user_id)
            ->where('contest_id',$request->contest_id);
        
        $close_team_id = $join_contests->pluck('created_team_id')->toArray();
        $request->merge(['type'=> 'close']);
        $request->merge(['close_team_id'=> $close_team_id]);
        // not join team id
        $close_team_id = $join_contests->pluck('created_team_id')->toArray();
        
        $close_team = $this->getMyTeam($request);
        $ct = $close_team->getdata()->response->myteam;
        if($close_team->getdata()->response->myteam){
        
          //   $team_list[] = ['close_team'=>$ct]; 
        }
        //  join team id
        $open_team_id = $create_teams->whereNotIn('id',$close_team_id)
                                    ->pluck('id')->toArray();
         
        $request->merge(['open_team_id'=> $open_team_id]);
         $request->merge(['type'=> 'open']);
        $open_team = $this->getMyTeam($request);   
        if($open_team->getdata()->response->myteam){
            $ot = $open_team->getdata()->response->myteam;
            $team_list[] = ['open_team' => $ot];   
        }
        
      
        $join_contests_count = $join_contests->count();
        if($cc && ($cc->filled_spot>0 && $cc->total_spots==$cc->filled_spot)){
           // $this->automateCreateContest();
            return [
                'status'=>true,
                'code' => 200,
                'message' => 'Contest is full',
                'action'=>3,
                'team_list' => $team_list??null 
            ];
        }elseif($create_teams_count > $join_contests_count){
            return [
                'status'=>true,
                'code' => 200,
                'message' => ' Join contest ',
                'action'=>2,
                'team_list' => $team_list??null
            ];
        }else{
            return [
                'status'=>true,
                'code' => 200,
                'message' => 'create new team to join this contest',
                'action'=>1,
                'team_list' => $team_list??null
            ];
        }
    }

    public function prizeBreakup(Request $request){

        $match_id   = $request->match_id;
        $contest_id = $request->contest_id;

        $contest =  CreateContest::where('match_id',$match_id)
            ->where('id',$contest_id)
            ->get();

        $contest->transform(function ($item, $key)   {

            $defaultContest  = \DB::table('prize_breakups')
                ->where('default_contest_id',$item->default_contest_id)
                ->where('contest_type_id',$item->contest_type)
                ->get();

            $rank = [];
            foreach ($defaultContest as $key => $value) {
                $prize = $value->prize_amount;
                if($value->rank_from == $value->rank_upto || $value->rank_upto==1){
                    $rank_rang = "$value->rank_from";
                }else{
                    $rank_rang = $value->rank_from.'-'.$value->rank_upto;
                }

                if($item->total_spots==0 && $rank_rang==1){

                    $prize = round(($item->entry_fees*$item->filled_spot)*(0.25));

                    if($prize<$item->entry_fees){
                        if($item->filled_spot>1){
                            $prize = $item->entry_fees*($item->filled_spot-1);    
                        }else{
                            $prize = $item->entry_fees;
                        }
                        
                    }

                    \DB::table('prize_breakups')->where('id',$value->id)
                        ->update(['prize_amount'=>$prize]);
                }


                $rank[] = [
                    'range' => $rank_rang,
                    'price' => $prize
                ];
            }
            $item->rank = $rank;
            return $item;
        });

        $data['prizeBreakup'] = $contest[0]->rank??null ;
        return [
            'status'=>true,
            'code' => 200,
            'message' => 'Prize Breakup',
            'response' => $data
        ];

    }

    public function updateUserMatchPoints(Request $request){

        if($request->match_id){
            $matches = Matches::where('match_id',$request->match_id)
                       // ->whereDate('date_start',\Carbon\Carbon::today())
                        ->get();
        }else{
            $matches = Matches::where('status',3)
            ->whereDate('date_start',\Carbon\Carbon::today())
            ->get();
        }
        
        $matches->transform(function($item,$key)use($request){
                
                $request->merge(['match_id'=>$item->match_id]);  

                $this->getPlayerPoints($request);

                $contests = \DB::table('create_contests')
                    ->where('match_id',$item->match_id)
                    ->where('is_cancelled',0)
                    ->get();
                    // get contest based on contest
                $contests->transform(function($item,$key){
                        $jc = \DB::table('match_stats')
                            ->where('match_id',$item->match_id)
                            ->where('contest_id',$item->id)
                            ->get() // get team based on join contest
                            ->transform(function($item,$key){
                                $this->updateMatchRankByMatchId($item->match_id,$item->contest_id);      
                            });
                });
            });
        $this->WinningPrizeDistribution($request);
        return [
            'status'=>true,
            'code' => 200,
            'message' => 'points updated'

        ];
    }
    // update Ranking
    public function updateMatchRankByMatchId($match_id=null,$contest_id=null)
    {
        $servername =  env('DB_HOST','localhost');
        $username   =  env('DB_USERNAME','root');
        $password   =  env('DB_PASSWORD','');
        $dbname     =  env('DB_DATABASE','fantasy');
        // Create connection
        $conn = mysqli_connect($servername, $username, $password, $dbname);
        $sql = 'SELECT *, FIND_IN_SET( points, (SELECT GROUP_CONCAT( points ORDER BY points DESC ) FROM match_stats  where match_id='.$match_id.' and contest_id='.$contest_id.')) AS rank FROM match_stats where match_id='.$match_id.' and contest_id='.$contest_id.' ORDER BY ranking ASC';
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_object($result)) {

                if($row->points>0)
                {
                    MatchStat::updateOrCreate(
                    [
                        'match_id'  => $row->match_id,
                        'user_id'   => $row->user_id,
                        'team_id'   => $row->team_id,
                        'contest_id'=> $row->contest_id,
                        'join_contest_id'=> $row->join_contest_id
                    ],
                    ['ranking'=>$row->rank]);

                    $jc = JoinContest::find($row->join_contest_id);
                                        
                    if($jc){
                        $jc->ranks = $row->rank;
                        $jc->save();
                    }
                }
            }
        }
        mysqli_close($conn);

        return ['match_id'=>$match_id];

    }

    public function getPoints(request $request){

        $team_id = CreateTeam::find($request->team_id);

        $validator = Validator::make($request->all(), [
            'team_id' => 'required'
        ]);

        // Return Error Message
        if ($validator->fails() ||  $team_id==null) {
            $error_msg  =   [];
            foreach ( $validator->messages()->all() as $key => $value) {
                array_push($error_msg, $value);
            }

            return Response::json(array(
                    'system_time'=>time(),
                    'status' => false,
                    "code"=> 201,
                    'message' => $error_msg[0]??"Team is not available"
                )
            );
        }

        $player_id = json_decode($team_id->teams,true);
        $team_arr  = json_decode($team_id->team_id,true);


        $mpObject    =   MatchPoint::where('match_id',$team_id->match_id)->first();

        $playerObject = Player::where('match_id',$team_id->match_id)
            ->whereIn('pid',$player_id);

        $pids = $playerObject->pluck('pid');
        $pids_role = $playerObject->pluck('playing_role','pid');

        $player_team_id = $playerObject->pluck('team_id','pid')->toArray();

        if(!$mpObject){

            $captain        =   $team_id->captain;
            $vice_captain   =   $team_id->vice_captain;
            $trump          =   $team_id->trump;

            $players =$playerObject->get()
                        ->transform(function($item,$key){
                        $playing11_a = \DB::table('team_a_squads')
                                    ->where('match_id',$item->match_id)
                                    ->where('player_id',$item->pid)
                                    ->where('playing11','true')
                                    ->first();
                        $playing11_b = \DB::table('team_b_squads')
                                    ->where('match_id',$item->match_id)
                                    ->where('player_id',$item->pid)
                                    ->where('playing11','true')
                                    ->first();
                        if($playing11_a){
                            $item->playing11 = $playing11_a->playing11=='true'?true:false;
                        }elseif ($playing11_b) {
                           $item->playing11 = $playing11_b->playing11=='true'?true:false;
                        }else{
                           $item->playing11 = false; 
                        }             
                          return $item;

                    });

            foreach ($players as $key => $result) {

                if($result->playing_role=='wkbat'){
                    $result->playing_role = "wk";
                }

                $data[] = [

                    'pid'       => $result->pid,
                    'team_id'   => $result->team_id,
                    'name'      => $result->short_name,
                    'short_name'=> $result->short_name,
                    'points'    => 0,
                    'rating'    => 0,
                    'role'      => $result->playing_role,
                    'captain'   =>  ($captain==$result->pid)?true:false,
                    'vice_captain'   => ($vice_captain==$result->pid)?true:false,
                    'trump'     => ($trump==$result->pid)?true:false,
                    'playing11' => $result->playing11??false
                ];
            }
        }
        $total_points = 0;
        if($team_id && $mpObject!=null)  {
            $teams_id = json_decode($team_id->team_id,true);
            $captain        =   $team_id->captain;
            $vice_captain   =   $team_id->vice_captain;
            $trump          =   $team_id->trump;

            $player_id = json_decode($team_id->teams,true);
           // dd($team_id->match_id);    
            $mpObject = MatchPoint::where('match_id',$team_id->match_id)
                ->whereIn('pid',$pids)
                ->select('match_id','pid','name','role','rating','point','starting11')->get();
           // return $mpObject ;    
            $mpObject->transform(function($item,$key)use($pids_role){

                        $playing11_a = \DB::table('team_a_squads')
                                    ->where('match_id',$item->match_id)
                                    ->where('player_id',$item->pid)
                                    ->where('playing11','true')
                                    ->first();
                        $playing11_b = \DB::table('team_b_squads')
                                    ->where('match_id',$item->match_id)
                                    ->where('playing11','true')
                                    ->where('player_id',$item->pid)
                                    ->first();
                        $role_cat = ['wkcap','cap','squad'];
                                    
                        if($playing11_a){
                            $item->role = $playing11_a->role;
                            $item->playing11 = 'true';
                            $p11=1;
                        }
                        elseif($playing11_b) {

                           $item->role = $playing11_b->role; 
                           $item->playing11 = 'true';
                           $p11=1;
                        }else{
                           $item->playing11 = false; 
                        }

                        $item->role = $pids_role[$item->pid];
                        return $item;
                    });
            //mp=match point
                //    return $mpObject;

            foreach ($mpObject as $key => $result) {

                $point = $result->point;
                if($captain==$result->pid){
                    $point = 2*$result->point;
                    $cname = true;
                }
                elseif($vice_captain==$result->pid){
                    $point = (1.5)*$result->point;
                    $vcname =true;
                }
                elseif($trump==$result->pid){
                    $point = 3*$result->point;
                    $tname = true;
                }

                $array_sum[] = $point;

                $name = explode(' ', $result->name);

                $fname = $name[0]??"";
                $lname = $name[1]??"" ;

                $fl = strlen(trim($fname.trim($lname)));
                if($fl<=10){
                    $short_name = $result->short_name;
                }else{
                    if(strlen($lname)>=10)
                    {
                        $short_name = $lname;
                    }
                    else{
                        $short_name = $fname[0].' '.$lname;
                    }
                }
                if($result->role=='wkbat'){
                    $result->role = "wk";
                }
                //$short_name??$result->name
                $data[] = [
                    'pid'       => $result->pid,
                    'team_id'   => $player_team_id[$result->pid]??null,
                    'name'      => $result->name,
                    'short_name'=> $result->name,
                    'points'    => (float)$point,
                    'rating'    => (float)$result->rating,
                    'role'      => ($result->role=='wkbat')?'wk':$result->role,
                    'captain'   =>  ($captain==$result->pid)?true:false,
                    'vice_captain'   => ($vice_captain==$result->pid)?true:false,
                    'trump'     => ($trump==$result->pid)?true:false,
                    'playing11' => $result->playing11??false
                ];
            }
            $total_points = array_sum($array_sum);
        }
        return [
            'status'=>true,
            'code' => 200,
            "match_id" => $team_id->match_id,
            'message' => 'points update',
            'total_points' => $total_points,
            'response' => [
                'player_points' => $data
            ]
        ];
    }

    public function getPlayerPoints(Request $request){

            $match_point_result = null;
            $contests = \DB::table('create_contests')
            ->where('match_id',$request->match_id)
            ->where('is_cancelled',0)
            ->get();
            // get contest based on contest
            $contests->transform(function($item,$key)use($match_point_result){
                $jc = \DB::table('join_contests')
                    ->where('match_id',$item->match_id)
                    ->where('contest_id',$item->id)
                    ->get() // get team based on join contest
                    ->transform(function($item,$key)use($match_point_result){
                        $ct = CreateTeam::where('id',$item->created_team_id)
                            ->where('match_id',$item->match_id)
                            ->first();

                        $contest_id = $item->contest_id;    
                        $teams  = json_decode($ct->teams);

                        $mp     = MatchPoint::where('match_id',$item->match_id)
                                ->get();

                            foreach ($mp as $key => $result) {
                                if(in_array($result->pid, $teams))
                                {
                                    $pt = $result->point;
                                    if($ct->captain==$result->pid){
                                        $pt = 2*$result->point;
                                    }
                                    if($ct->vice_captain==$result->pid){
                                        $pt = (1.5)*$result->point;
                                    }
                                    if($ct->trump==$result->pid){
                                        $pt = 3*$result->point;
                                    }
                                    $data['points'][] = $pt;
                                }
                            }

                            $total_points = array_sum($data['points']);
                            $match_id = $item->match_id;
                            $join_contest_id = $item->id;
                            $user_id = $item->user_id;


                            $match_stat = MatchStat::firstOrNew(
                                [
                                    'match_id'  =>  $match_id,
                                    'user_id'   =>  $user_id,
                                    'team_id'   =>  $ct->id,
                                    'contest_id' => $contest_id,
                                    'join_contest_id' => $join_contest_id,
                                ]
                            );
                            $match_stat->points = (float)$total_points;
                            $match_stat->save();
                            $ct->points = $total_points;
                            $ct->save();

                            $jc_object = JoinContest::find($join_contest_id);
                            $jc_object->points = $total_points;
                            $jc_object->save();
                    });
            });


        return [
            'status'=>true,
            'code' => 200,
            'message' => 'points update'

        ];

    }

    // update points by LIVE Match
    public function updatePointAfterComplete(Request $request){
        $matches = Matches::whereIn('status',[2,3])
            ->where('timestamp_start','>=',strtotime("-1 days"))
            ->get();
        foreach ($matches as $key => $match) {   # code...

            $points = file_get_contents($this->cric_url.'matches/'.$match->match_id.'/point?token='.$this->token);
        
            $this->storeMatchInfoAtMachine($points,'info/'.$match->match_id.'.txt');
            $points_json = json_decode($points);
            $m = [];
            foreach ($points_json->response->points as $team => $teams) {
                if($teams==""){
                    continue;
                }
                foreach ($teams as $key => $players) {
                    foreach ($players as $key => $result) {
                        $result->match_id = $match->match_id;
                        if($result->pid==null){
                            continue;
                        }
                        $m[] = MatchPoint::updateOrCreate(
                            ['match_id'=>$match->match_id,'pid'=>$result->pid],
                            (array)$result);

                    }
                }
            }
        }

        echo 'points_updated';
    }

    // update points by LIVE Match
    public function updatePointsAndPlayerByMatchId(Request $request){
        $matches = Matches::where('match_id',$request->match_id)
                ->whereDate('date_start',\Carbon\Carbon::today())
                ->where('status',2)
                ->select('match_id','updated_at')
                ->get();

        foreach ($matches as $key => $match) {   # code...

            $points = file_get_contents($this->cric_url.'matches/'.$match->match_id.'/point?token='.$this->token);
            $points_json = json_decode($points);
            $this->storeMatchInfoAtMachine($points,'point/'.$match->match_id.'.txt');
            
            foreach ($points_json->response->points as $team => $teams) {
                if($teams==""){
                    continue;
                }
                foreach ($teams as $key => $players) {
                    foreach ($players as $key => $result) {
                        $result->match_id = $match->match_id;
                        if($result->pid==null){
                            continue;
                        }
                        MatchPoint::updateOrCreate(
                            ['match_id'=>$match->match_id,'pid'=>$result->pid],
                            (array)$result);

                    }
                }
            }
        }
        return "points updated";
    }
    // update points by LIVE Match
    public function updatePoints(Request $request){
        sleep(5);
        if($request->match_id){
            if($request->status==3){
                $matches = Matches::where('status',3)
                        ->where('match_id',$request->match_id)
                        ->get();
            }else{
                $matches = Matches::where('match_id',$request->match_id)
                ->get();
            }
            
        }else{
           $matches = Matches::where('status',3)
                ->whereDate('updated_at',\Carbon\Carbon::today())
                ->get(); 
        }
        $m = [];
        foreach ($matches as $key => $match) {   # code...

            $points = file_get_contents($this->cric_url.'matches/'.$match->match_id.'/point?token='.$this->token);
            $points_json = json_decode($points);
                        
            foreach ($points_json->response->points as $team => $teams) {
               
                if($teams==""){
                    continue;
                }
                foreach ($teams as $key => $players) {

                    foreach ($players as $key => $result) {
                        $result->match_id = $match->match_id;
                        if($result->pid==null){
                            continue;
                        }
                        
                        $m[$result->role][] = [
                            'name'=>$result->name,
                            'point'=> $result->point,
                            'role' => $result->role
                        ];

                        MatchPoint::updateOrCreate(
                            ['match_id'=>$match->match_id,'pid'=>$result->pid],
                            (array)$result);
                    }
                }
            }

            $request->merge(['match_id' =>  $match->match_id]);
            $this->updateUserMatchPoints($request);    
            
            if(isset($points_json->response)){
                $match_obj = Matches::firstOrNew(
                    [
                        'match_id' => $match->match_id
                    ]
                );
                $match_obj->status = $points_json->response->status;
                $match_obj->status_str = $points_json->response->status_str;
                $match_obj->status_note = $points_json->response->status_note;
                $match_obj->result = $points_json->response->result;
                $match_obj->save();
            }

            /*TEAM A*/
            $team_a = TeamA::firstOrNew(['match_id' => $match->match_id]);
            $team_a->match_id   = $match->match_id;

            if(isset($points_json->response->teama)){
                foreach ($points_json->response->teama as $key => $value) {
                    $team_a->$key = $value;
                }
            }
            $team_a->save(); 

            /*TEAM B*/
              /*TEAM A*/
            $team_b = TeamB::firstOrNew(['match_id' => $match->match_id]);
            $team_b->match_id   = $match->match_id;

            if(isset($points_json->response->teamb)){
                foreach ($points_json->response->teamb as $key => $value) {
                    $team_b->$key = $value;
                }
            }  
            $team_b->save(); 
        }
        if($request->user_id==285 && $m){
            $this->updateUserMatchPoints($request);
            echo date('H:i:s A -');
            return $m;
        }else{
            return 'points updated';
        } 
       
    }

    public function getContestStat(Request $request){

        $match_stat =  MatchPoint::with(['player' => function($q){
            $q->with('team_a');
            $q->with('team_b');
        }])
            ->where('match_id',$request->match_id)
            ->select('match_id','pid','name','rating','point','role')
            ->get();
        $data = [];
        foreach ($match_stat as $key => $stat) {

            if(isset($stat->player->team_a)){
                $team_name = $stat->player->team_a->short_name;
            }
            if(isset($stat->player->team_b)){
                $team_name = $stat->player->team_b->short_name;
            }

            $data[] = [
                'match_id' => $stat->match_id,
                'pid' => $stat->pid,
                'rating' => $stat->rating,
                'point' => $stat->point,
                'role' => strtoupper($stat->role),
                'team_id' => $stat->player->team_id,
                'player_name' => $stat->player->short_name,
                'team_name' => $team_name
            ];

        }

        return [
            'status'=>true,
            'code' => 200,
            'message' => 'contestStat',
            'response' => ['contestStat'=>$data]

        ];

    }
    // update points by LIVE Match ID
    public function getPointsByMatch(Request $request){

        $points = file_get_contents($this->cric_url.'matches/'.$request->match_id.'/point?token='.$this->token);
        $points_json = json_decode($points);
        $this->storeMatchInfoAtMachine($points,'point/'.$request->match_id.'.txt');
            
        // dd($points_json->response->points);
        foreach ($points_json->response->points as $team => $teams) {
            foreach ($teams as $key => $players) {
                foreach ($players as $key => $result) {
                    $result->match_id = $request->match_id;
                    if($result->pid==null){
                        continue;
                    }
                    //  dd($result);
                    $m[] = MatchPoint::updateOrCreate(
                        ['match_id'=>$request->match_id,'pid'=>$result->pid],
                        (array)$result);
                }
            }
        }
        return ['points'=>$m];
    }
    
  /**
    * Description : Leaderboard data
    * @var match_is
    * @var user_id
    * @var content_id
    */
    public function leaderBoard(Request $request){
        // $join_contests = [];

        $okhttp = Str::contains($_SERVER['HTTP_USER_AGENT'], 'okhttp');
        if(!$okhttp){
            return array(
                    'status' => false,
                    'code' => 201,
                    'message' => 'unauthorise access!'
                );
        }

        $match_id = $request->match_id;
        $join_contests = JoinContest::where('match_id',$request->get('match_id'))
            ->where('contest_id',$request->get('contest_id'))
            ->pluck('created_team_id')->toArray();

        $user_id = $request->user_id;

        $leader_board1 = JoinContest::with('user')
            ->where('match_id',$request->match_id)
            ->where('contest_id',$request->get('contest_id'))
            ->where(function($q) use($user_id){
                $q->where('user_id',$user_id);
            })
            ->orderBy('ranks','ASC')
            ->get();

            $leader_board1->transform(function($item,$key){
               /* $prize = \DB::table('prize_distributions')
                        ->where('match_id' ,$item->match_id)
                        ->where('user_id',$item->user_id)
                        ->where('contest_id',$item->contest_id)
                        ->where('created_team_id',$item->created_team_id)
                        ->first();

                if(isset($prize->rank)){
                    $item->prize_amount = $prize->prize_amount??$item->winning_amount;    
                }else{
                    $item->prize_amount = $item->winning_amount??0;
                } */ 
                $item->prize_amount = $item->winning_amount??0;
                if($item->cancel_contest==1){
                    $item->prize_amount = 0;    
                }

                   
                return $item;
                
            });

        $point = ($leader_board1[0]->points??null);

        $leader_board2 = JoinContest::whereHas('user')
            ->where('match_id',$request->match_id)
            ->where('contest_id',$request->get('contest_id'))
            ->where(function($q) use($user_id,$point){
                $q->where('user_id','!=',$user_id);
                if($point){
                    $q->orderBy('ranks','ASC');
                }else{
                    $q->orderBy('ranks','ASC');
                }
            })
            ->orderBy('ranks','ASC')
            ->get()
            ->transform(function($item,$key){
               /* $prize = \DB::table('prize_distributions')
                        ->where('match_id' ,$item->match_id)
                        ->where('user_id',$item->user_id)
                        ->where('contest_id',$item->contest_id)
                        ->where('created_team_id',$item->created_team_id)
                        ->first();
              //  $item->prize_amount = $prize;
                if(isset($prize->rank)){
                    $item->prize_amount = $prize->prize_amount??$item->winning_amount;
                }else{
                    $item->prize_amount = $item->winning_amount??0;
                } */ 
                //$item->prize_amount = $item->winning_amount??0;  
                $item->prize_amount = $item->winning_amount??0;
                if($item->cancel_contest==1){
                    $item->prize_amount = 0;    
                } 
                return $item;
            });
        $lb = [];    
        foreach ($leader_board1 as $key => $value) {

            if(!isset($value->user)){
                continue;
            }
          //  $user = 
            $data['match_id'] = $value->match_id;
            $data['team_id'] = $value->created_team_id;
            $data['user_id'] = $value->user->user_name??$value->user->id;
            $data['team'] = $value->team_count;
            $data['point'] = $value->points;
            $data['rank'] = $value->ranks;
            $data['prize_amount'] = $value->prize_amount??$value->winning_amount;
            $data['winning_amount'] = $value->winning_amount;

            $user_data =  $value->user->name;
            $fn = explode(" ",$user_data);

            $data['user'] = [
                'first_name'    => $value->user->first_name,
                'last_name'     => $value->user->last_name,
                'name'          => $value->user->name,
                'user_name'     => $value->user->team_name??reset($fn),
                'team_name'     => $value->user->team_name??reset($fn),
                'profile_image' => $value->user->profile_image,
                'short_name'    => substr($value->user->first_name,0,1).substr($value->user->last_name,0,1)
            ];
            $lb[] = $data;
        }
        foreach ($leader_board2 as $key => $value) {

            if(!isset($value->user)){
                continue;
            }

            $data['match_id'] = $value->match_id;
            $data['team_id'] = $value->created_team_id;
            $data['user_id'] = $value->user->user_name??$value->user->id;
            $data['team'] = $value->team_count;
            $data['point'] = $value->points;
            $data['rank'] = $value->ranks;
            $data['prize_amount'] =  $value->prize_amount??$value->winning_amount;
            $data['winning_amount'] = $value->winning_amount;
            $user_data =  $value->user->name;
            $fn = explode(" ",$user_data);    

            $data['user'] = [
                'first_name'    => reset($fn),
                'last_name'     => end($fn),
                'name'          => reset($fn).' '.end($fn),
                'user_name'     => $value->user->team_name??reset($fn),
                'team_name'     => $value->user->team_name??reset($fn),
                'profile_image' => isset($user_data)?$value->user->profile_image:null,
                'short_name'    => substr(reset($fn),0,1).substr(end($fn),0,1)
            ];
            $lb[] = $data;
        }
        $lb = $lb??null;

        $match_info = $this->setMatchStatusTime($match_id);
      //return($lb);
        if($lb){
            return [
                'system_time'=>time(),
                'match_status' => $match_info['match_status']??null,
                'match_time' => $match_info['match_time']??null,
                'status'=>true,
                'code' => 200,
                'message' => 'leaderBoard',
                'total_team' =>  count($lb),
                'leaderBoard' =>mb_convert_encoding($lb, 'UTF-8', 'UTF-8')

            ];
        }else{
            return [
                'system_time'=>time(),
                'match_status' => $match_info['match_status']??null,
                'match_time' => $match_info['match_time']??null,
                'status'=>false,
                'code' => 201,
                'message' => 'leaderBoard not available'
            ];
        }

    }

    /*
    @method : createTeam

   */
    public function getMyTeam(Request $request){

        $match_id =  $request->match_id;
        $user_id  =  $request->user_id;
         
        $userVald = User::find($request->user_id);
        $matchVald = Matches::where('match_id',$request->match_id)->count();

        if(!$userVald || !$matchVald){
            return [
                'status'=>false,
                'code' => 201,
                'message' => 'user id or match id is invalid'
    
            ];
        }

        if($request->type=="close"){
            $myTeam   =  CreateTeam::where('match_id',$match_id)
                        ->whereIn('id',$request->close_team_id)   
                        ->where('user_id',$user_id )
                        ->get();
        }elseif($request->type=="open"){
            $myTeam   =  CreateTeam::where('match_id',$match_id)
                        ->whereIn('id',$request->open_team_id)
                        ->where('user_id',$user_id)
                        ->get(); 
            
        }else{
            $myTeam   =  CreateTeam::where('match_id',$match_id)
            ->where('user_id',$user_id )
            ->get();
        }

        

        $user_name = User::find($user_id);
        $data = [];
        foreach ($myTeam as $key => $result) {

            $team_id =  json_decode($result->team_id,true);
            $teams = json_decode($result->teams,true);
            if($team_id==null or $teams==null){
                continue;
            }

            $captain = $result->captain;
            $trump = $result->trump;
            $vice_captain = $result->vice_captain;
            $team_count = $result->team_count;
            $team_count = $result->team_count;
            $user_id    = $result->user_id;
            $match_id   = $result->match_id;
            $points     = $result->points;
            $rank       = $result->rank;

            $k['created_team'] = ['team_id' => $result->id];

            $player = Player::WhereIn('team_id',$team_id)
                ->whereIn('pid',$teams)
                ->where('match_id',$result->match_id)
                ->get();

            foreach ($player as $key => $value) {

                if($value->playing_role=="wkbat"){
                    $team_role["wk"][] = $value->pid;
                }else{
                    $team_role[$value->playing_role][] = $value->pid;
                }

            }
            //dd($team_role);
            foreach ($team_role as $key => $value) {

                $k[$key] = $value;
            }
            $team_role = [];
            $c = Player::WhereIn('team_id',$team_id)
                ->whereIn('pid',[$captain,$vice_captain,$trump])
                ->where('match_id',$result->match_id)
                ->pluck('short_name','pid');

            $k['c'] = ['pid'=> (int)$captain,'name' => $c[$captain]];
            $k['vc'] = ['pid'=>(int)$vice_captain,'name' => $c[$vice_captain]];
            $k['t'] = ['pid'=>(int)$trump,'name' => $c[$trump]];


            $t_a = TeamA::WhereIn('team_id',$team_id)
                ->where('match_id',$result->match_id)
                ->first();
            $t_b = TeamB::WhereIn('team_id',$team_id)
                ->where('match_id',$result->match_id)
                ->first();

            $tac = Player::Where('team_id',$t_a->team_id)
                ->whereIn('pid',$teams)
                ->where('match_id',$result->match_id)
                ->get();
            $tbc = Player::Where('team_id',$t_b->team_id)
                ->whereIn('pid',$teams)
                ->where('match_id',$result->match_id)
                ->get();
            // team count with name
            $t[]   = ['name' => $t_a->short_name, 'count' => $tac->count()];
            $t[]   = ['name' => $t_b->short_name, 'count' => $tbc->count()];


            $k['match']         = [$t_a->short_name.'-'.$t_b->short_name];
            $k['team']          = $t;
            $k['c_img']         = "";
            $k['vc_img']        = "";
            $k['t_img']         = "";
            // username
            $k['team_name'] =  $user_name->user_name. '('.$result->team_count.')';
            $k['points']        = $points;
            $k['rank']          = $rank;
            $data[] = $k;
            $t = [];

        }

        $match_info = $this->setMatchStatusTime($match_id);
          //  dd($match_info);
            return response()->json(
                [
                    'system_time'=>time(),
                    'match_status' => $match_info['match_status']??null,
                    'match_time' => $match_info['match_time']??null,
                "status"=>true,
                "code"=>200,
                "teamCount" => $myTeam->count(),
                "message"=>"success",
                "response"=>["myteam"=>$data]
            ]
        );
    }
    /*
     @method : createTeam
    */
    public function createTeam(Request $request){
        
        $this->matchInfo($request,'createTeam');
        $match_id = $request->match_id;
        $userVald = User::find($request->user_id);
        $matchVald = Matches::where('match_id',$request->match_id)->first();

        if($matchVald){
            $timestamp = $matchVald->timestamp_start;
            $t = time();
            if($t > $timestamp){
                return [
                    'status'=>false,
                    'code' => 201,
                    'message' => 'Match time up'

                ];
            }
        }

        if(!$userVald || !$matchVald){
            return [
                'status'=>false,
                'code' => 201,
                'message' => 'user_id or match_id is invalid'

            ];
        }

        $ct = CreateTeam::firstOrNew(['id'=>$request->create_team_id]);
        Log::channel('before_create_team')->info($request->all());
        if($request->create_team_id){ 

            if($ct->id==null){
                return [
                    'status'=>false,
                    'code' => 201,
                    'message' => 'Team list is empty!'

                ];
            }
        }
        $is_exist = CreateTeam::where(
                [
                    'match_id'       => $request->match_id,
                    'contest_id'     => $request->contest_id,
                    'team_id'        => json_encode($request->team_id),
                    'teams'          => json_encode($request->teams),
                    'captain'        => $request->captain,
                    'vice_captain'   => $request->vice_captain,
                    'trump'          => $request->trump,
                    'user_id'        => $request->user_id
                ]
            )->first();
         
        if($is_exist && $request->create_team_id==0){
            return [
                'status'=>false,
                'code' => 201,
                'message' => 'You have already created this team!'

            ];
        }

        $team_count = CreateTeam::where('user_id',$request->user_id)
            ->where('match_id',$request->match_id)->count();
        if($team_count>=11 && $request->create_team_id==null){
            return [
                'status'=>false,
                'code' => 201,
                'message' => 'Max create team limit exceeded'

            ];
        }

        try {
            if($request->create_team_id==null){
                $c_t = CreateTeam::where(
                    'match_id',$request->match_id)
                    ->where('user_id' , $request->user_id)
                    ->count();

                $t_count = $c_t+1;

                $ct->team_count = "T".$t_count;
            }

            $ct->match_id       = $request->match_id;
            $ct->contest_id     = $request->contest_id;
            $ct->team_id        = json_encode($request->team_id);
            $ct->teams          = json_encode($request->teams);
            $ct->captain        = $request->captain;
            $ct->vice_captain   = $request->vice_captain;
            $ct->trump          = $request->trump;
            $ct->user_id        = $request->user_id;

            if($request->create_team_id){
                $ct->edit_team_count = $ct->edit_team_count+1;
            }
            $ct->save();
            
            $ct->team_id  = $request->team_id;
            $ct->create_team_id  = $ct->id;
            // player analytics
            $request->merge(['created_team_id'=>$ct->id]);
            
            $this->playerAnalytics($request);

            Log::channel('after_create_team')->info($request->all());
            $match_info = $this->setMatchStatusTime($match_id);
          //  dd($match_info);
            return response()->json(
                [
                    'system_time'=>time(),
                    'match_status' => $match_info['match_status']??null,
                    'match_time' => $match_info['match_time']??null,
                    "status"=>true,
                    "code"=>200,
                    "message"=>"Success",
                    "response"=>["matchconteam"=>$ct]
                ]
            );

        } catch (QueryException $e) {

            return response()->json(
                [
                    "status"=>false,
                    "code"=>201,
                    "message"=>"Failed"
                ]
            );
        }
    }


    public function updateContestByMatch($match_id=null){

        $default_contest = \DB::table('default_contents')
            ->where('match_id',$match_id)
            ->whereNull('deleted_at')
            ->get()
            ->transform(function($item,$key){
                $contest_type = \DB::table('contest_types')->select('sort_by')->first();
                $item->sort_by = $contest_type->sort_by??0;
                return $item;
            });;

        foreach ($default_contest as $key => $result) {
            $createContest = CreateContest::firstOrNew(
                [
                    'match_id'          =>  $match_id,
                    'contest_type'      =>  $result->contest_type,
                    'entry_fees'        =>  $result->entry_fees,
                    'total_spots'       =>  $result->total_spots,
                    'first_prize'       =>  $result->first_prize

                ]
            );

            $createContest->sort_by            =    $result->sort_by;
            $createContest->match_id            =   $match_id;
            $createContest->contest_type        =   $result->contest_type;
            $createContest->total_winning_prize =   $result->total_winning_prize;
            $createContest->entry_fees          =   $result->entry_fees;
            $createContest->total_spots         =   $result->total_spots;
            $createContest->first_prize         =   $result->first_prize;
            $createContest->winner_percentage   =   $result->winner_percentage;
            $createContest->cancellation        =   $result->cancellation;
            $createContest->default_contest_id  =   $result->id;
            $createContest->save();
            return true;
        }

    }
    // crrate contest dyanamic
    public function createContest($match_id=null){

        $default_contest = \DB::table('default_contents')
            ->whereNull('match_id')
            ->whereNull('deleted_at')
            ->get()
            ->transform(function($item,$key){
                $contest_type = \DB::table('contest_types')
                                ->where('id',$item->contest_type)->select('sort_by')->first();
                $item->sort_by = $contest_type->sort_by??0;
                return $item;
            });


        foreach ($default_contest as $key => $result) {
            $createContest = CreateContest::firstOrNew(
                [
                    'match_id'          =>  $match_id,
                    'contest_type'      =>  $result->contest_type,
                    'entry_fees'        =>  $result->entry_fees,
                    'total_spots'       =>  $result->total_spots,
                    'first_prize'       =>  $result->first_prize

                ]
            );
            $createContest->sort_by             =   $result->sort_by;
            $createContest->match_id            =   $match_id;
            $createContest->contest_type        =   $result->contest_type;
            $createContest->total_winning_prize =   $result->total_winning_prize;
            $createContest->entry_fees          =   $result->entry_fees;
            $createContest->total_spots         =   $result->total_spots;
            $createContest->first_prize         =   $result->first_prize;
            $createContest->winner_percentage   =   $result->winner_percentage;
            $createContest->cancellation        =   $result->cancellation;
            $createContest->default_contest_id  =   $result->id;
            $createContest->save();

            $default_contest_id = \DB::table('default_contents')
                ->where('match_id',$match_id)
                ->whereNull('deleted_at')
                ->get();

            if($default_contest_id){
                foreach ($default_contest_id as $key => $value) {
                    $this->updateContestByMatch($match_id);
                }
            }

        }
    }

    public function setMatchStatusTime($match_id=null){
        $match = Matches::where('match_id',$match_id)->first();

        if($match){
            $arr['match_status'] = $match->status_str;
            $arr['match_time'] = $match->timestamp_start;

            return $arr;
        }else{

            $arr['match_status'] = null;
            $arr['match_time'] = null;

            return $arr;

        }
    }
    // get contest details by match id
    public function getContestByMatch(Request $request){
        $this->automateCreateContest();

        $match_id =  $request->match_id;
        $matchVald = Matches::where('match_id',$request->match_id)->first();
        /*
        CreateContest::where('total_spots','!=',0)->where('is_cloned','!=',1)->where('total_spots','>=',50)->where('filled_spot','!=',0)->get()
                ->transform(function($item,$key)use($matchVald){
                    $np1 = (int)($item->total_spots*(0.1));

                    if($item->filled_spot==$np1){
                            $device_id = User::pluck('device_id')->toArray();

                            $data = [
                                            'action' => 'notify' ,
                                            'title' => ' Contest is filling fast' ,
                                            'message' => 'Hurry up!!.'.$matchVald->title .' is filling fast.Join with maximum team and win maximum cash.'
                                        ];
                           // $this->sendNotification($device_id, $data);
                        }
                    });
                    */

        if(!$matchVald){
            return [
                'system_time'=>time(),
                'status'=>false,
                'code' => 201,
                'message' => 'match id is invalid'

            ];
        }
        $contest = CreateContest::with('contestType')
            ->where('match_id',$match_id)
            ->where('is_cancelled',0)
            ->orderBy('sort_by','asc')
           // ->orderBy('id','DESC')
            ->orderBy('total_winning_prize','DESC')
            ->get();
           // return $contest;
        if($contest){
            $matchcontests = [];
            foreach ($contest as $key => $result) {
                if($result->total_spots <= $result->filled_spot && $result->total_spots!=0){
                    continue;
                }
                //notification per

                $data2['isCancelled'] =   $result->is_cancelled?true:false;
                $data2['totalSpots'] =   $result->total_spots;
                $data2['firstPrice'] =   $result->first_prize;
                $data2['sort_by'] =   $result->sort_by;
                $data2['totalWinningPrize'] =    $result->total_winning_prize;
                if($result->total_spots==0)
                {
                    $data2['totalSpots'] =   0;
                    
                    $twp = round(($result->filled_spot)*($result->entry_fees)*(0.5));
                    

                    if($twp<$result->entry_fees){
                        if($result->filled_spot>1){
                            $prize = $result->entry_fees*($result->filled_spot-1);    
                        }else{
                            $prize = $result->entry_fees;
                        }  
                        $data2['totalWinningPrize'] = $prize;
                        $first_p = $prize;
                    }else{
                        $data2['totalWinningPrize'] = round(($result->filled_spot)*($result->entry_fees)*(0.5));
                        $first_p = round($twp*(0.2));    
                    }
                    $data2['firstPrice'] =   $first_p;

                }
                elseif($result->total_spots!=0 && $result->filled_spot==$result->total_spots)
                {
                   // $this->automateCreateContest();
                    continue;
                }
                $data2['contestId'] =    $result->id;

                $data2['entryFees'] =    $result->entry_fees;

                $data2['filledSpots'] =  $result->filled_spot;

                $data2['winnerPercentage'] = $result->winner_percentage;
                $data2['maxAllowedTeam'] =   $result->contestType->max_entries;
               // $data2['sort_by'] =   $result->sort_by;
                
                $data2['cancellation'] = $result->cancellation;
                $matchcontests[$result->contest_type][] = [
                    'sort_by' => $result->sort_by,
                    'contestTitle'=>$result->contestType->contest_type,
                    'contestSubTitle'=>$result->contestType->description,
                    'contests'=>$data2
                ];
            }
            // $data = [];
            $data[0] = null;
            foreach ($matchcontests as $key => $value) {

                foreach ($value as $key2 => $value2) {
                    //$value2['contests']['sort_by']
                    $k['contestTitle'] = $value2['contestTitle'];
                    $k['contestSubTitle'] = $value2['contestSubTitle'];
                    $k['contests'][] = $value2['contests'];
                }
                $data[] = $k;
                if($k['contestTitle']=='Practise Contest'){
                   // $data[0] = $k;
                }else{
                  // $data[] = $k;
                }
                $k = [];
            }

            $join_contests_team = \DB::table('join_contests')
                           ->where('match_id',$request->match_id)
                           ->where('user_id',$request->user_id)
                           ->pluck('created_team_id')->toArray();

            $join_contests = \DB::table('create_teams')
                ->where('match_id',$request->match_id)
                ->where('user_id',$request->user_id)
             //   ->whereIn('id',$join_contests_team)
                ->select('id as team_id')
                ->get();


            $myjoinedContest = $this->getMyContest2($request);
            $match_info = $this->setMatchStatusTime($match_id);
          //  dd($match_info);
            return response()->json(
                [
                    'system_time'=>time(),
                    'match_status' => $match_info['match_status']??null,
                    'match_time' => $match_info['match_time']??null,
                    "status"=>true,
                    "code"=>200,
                    "message"=>"Success",
                    "response"=>[
                        'matchcontests'=>array_values(array_filter($data)),
                        'myjoinedTeams' =>$join_contests,
                        'myjoinedContest' => ($myjoinedContest)
                    ]
                ]
            );
        }
    }

    public function getMatchDataFromApi()
    {
        //upcoming
        $upcoming =    file_get_contents($this->cric_url.'matches/?status=1&token='.$this->token);
        $this->storeMatchInfoAtMachine($upcoming,'upcoming/'.'upcoming.txt');
        
        \File::put(public_path('/upload/json/upcoming.txt'),$upcoming);

        //complted
        $completed =    file_get_contents($this->cric_url.'matches/?status=2&token='.$this->token);

        $this->storeMatchInfoAtMachine($completed,'completed/'.'completed.txt');
        \File::put(public_path('/upload/json/completed.txt'),$completed);

        //live
        $live =    file_get_contents($this->cric_url.'matches/?status=3&token='.$this->token);

        $this->storeMatchInfoAtMachine($live,'live/'.'live.txt');
        \File::put(public_path('/upload/json/live.txt'),$live);

        return ['file updated'];
    }

    public function removePlaying11($match_id=null, $is_playing=null){
        
            $setPlaying = $is_playing;
         # code...
            $token =  $this->token;
            $path = $this->cric_url.'matches/'.$match_id.'/squads/?token='.$token;
            $data = $this->getJsonFromLocal($path);
            // update team a players
            $teama = $data->response->teama;
            foreach ($teama->squads as $key => $squads) {
                $teama_obj = TeamASquad::firstOrNew(
                    [
                        'team_id'=>$teama->team_id,
                        'player_id'=>$squads->player_id,
                        'match_id'=>$match_id
                    ]
                );

                $teama_obj->team_id   =  $teama->team_id;
                $teama_obj->player_id =  $squads->player_id;
                $teama_obj->role      =  $squads->role;
                $teama_obj->role_str  =  $squads->role_str;
                $teama_obj->playing11 =  $setPlaying??$squads->playing11;
                $teama_obj->name      =  $squads->name;
                $teama_obj->match_id  =  $match_id;
                $teama_obj->save();
                $team_id[$squads->player_id] = $teama->team_id;
            }

            $teamb = $data->response->teamb;
            foreach ($teamb->squads as $key => $squads) {

                $teamb_obj = TeamBSquad::firstOrNew(['team_id'=>$teamb->team_id,'player_id'=>$squads->player_id,'match_id'=>$match_id]);

                $teamb_obj->team_id   =  $teamb->team_id;
                $teamb_obj->player_id =  $squads->player_id;
                $teamb_obj->role      =  $squads->role;
                $teamb_obj->role_str  =  $squads->role_str;
                $teamb_obj->playing11 =  $setPlaying??$squads->playing11;
                $teamb_obj->name      =  $squads->name;
                $teamb_obj->match_id  =  $match_id;
                $teamb_obj->save();

                $team_id[$squads->player_id] = $teamb->team_id;
            }
    }
    //access from admin
    public function saveMatchDataByMatchId($match_id=null,Request $request)
    {   
       $matches = Matches::firstOrNew(
                [
                    'match_id' => $match_id
                ]
            );
         
        //upcoming
        $data =  file_get_contents($this->cric_url.'matches/'.$match_id.'/info?token='.$this->token);

        $json = json_decode($data);
        $title = $json->response->title??null;

        if($request->Playing11){
            $this->removePlaying11($match_id, null);
            return "<p style='padding:10px' class='alert alert-success'> Playing11 announced! <p>";

        }else{
            $this->saveMatchDataFromAPI2DB($data); 
            $this->removePlaying11($match_id, "false");
            $matches->status =1;
            $matches->status_str = 'upcoming';
            $matches->save();
        }

        return "<p style='padding:10px' class='alert alert-success'> Match $title saved successfully<p>";
    }

    public function updateMatchDataById($match_id=null)
    {
       $endpoint = $this->cric_url.'matches/'.$match_id.'/info?token='.$this->token;
        //$response = Curl::to($endpoint)->get();
        $data =    file_get_contents($endpoint);
       // $this->saveMatchDataFromAPI2DB($data);
        $this->saveMatchDataById($data);

        return [$match_id.' : match id updated successfully'];
    }

    public function updateMatchStatus(Request $request)
    {   $match_id = $request->match_id;
        $matches = Matches::where('status',1)
                        ->whereDate('date_start',\Carbon\Carbon::today())
                        ->get(); 
                    
        foreach ($matches as $key => $result) {
            $match_id = $result->match_id;
            $data =    file_get_contents($this->cric_url.'matches/'.$match_id.'/info?token='.$this->token);

            $match = json_decode($data);
            if(isset($match->response)){
                \DB::table('matches')->where('match_id',$match->response->match_id)
                        ->update(
                            [
                                'status'=>$match->response->status,
                                'status_str'=>$match->response->status_str
                            ]
                        );
            }
        } 
        return ['match id updated successfully'];
    }

    public function updateMatchInfo(Request $request)
    {
        //upcoming 
        $match_id = $request->match_id;
        if($match_id){
           $matches =  Matches::where('match_id',$match_id)
            ->get(); 
        }else{
            $matches =  Matches::where('status',3)
            ->where('timestamp_start','>=',strtotime("-1 days"))
            ->where('timestamp_start','<=',time())
            ->get();
        }
        
        foreach ($matches as $key => $match) {

            $data =    file_get_contents($this->cric_url.'matches/'.$match->match_id.'/info?token='.$this->token);
                $this->saveMatchDataFromAPI2DB($data);
        }

        return [$matches->count().' Match is updated successfully'];

    }
    public function updateLiveMatchFromApp()
    {
        //upcoming
        $match = Matches::where('status',3)->get();
        foreach ($match as $key => $result) {

            $data =    file_get_contents($this->cric_url.'matches/'.$result->match_id.'/info?token='.$this->token);

            $this->saveMatchDataById($data);
        }
        return [' Live match  updated successfully'];

    }

    public function updateMatchDataByStatus($status=1)
    {   
        if($status==1){
            $fileName="upcoming";
        }
        elseif($status==2){
            $fileName="completed";
        }
        elseif($status==3){
            $fileName="live";
        }elseif($status==4){
            $fileName="cancelled";
        }
        else{
            return ['data not available'];
        }
       // echo $this->cric_url.'matches/?status='.$status.'&token='.$this->token.'&per_page=30'; die;
        //upcoming $this->cric_url
        $data =    file_get_contents($this->cric_url.'matches/?status='.$status.'&token='.$this->token.'&per_page=30');
       // return  $data;
        \File::put(public_path('/upload/json/'.$fileName.'.txt'),$data);
        
        //$this->storeMatchInfoAtMachine($data,'status/'.$fileName.'.txt');
        $data = $this->storeMatchInfo($fileName);
        
        $this->saveMatchDataFromAPI($data);

        return [$fileName.' match data updated successfully'];

    }

    public function updateMatchDataByMatchId($match_id=null,$status=1)
    {
        if($status==1){
            $fileName="upcoming";
        }
        elseif($status==2){
            $fileName="completed";
        }
        elseif($status==3){
            $fileName="live";
        }elseif($status==4){
            $fileName="cancelled";
        }
        else{
            return ['data not available'];
        }
        // https://rest.entitysport.com/v2/matches/44198/info
        //upcoming
        $data =    file_get_contents($this->cric_url.'matches/'.$match_id.'/info?token='.$this->token);

        $this->storeMatchInfoAtMachine($data,'info/'.$match_id.'.txt');
        
        $json = json_decode($data); 
        $datas['status']    = $json->status;
        $arr['items'][]     = $json->response;
        $datas['response']  = $arr;

        $json_data = json_encode($datas); 

        \File::put(public_path('/upload/json/'.$fileName.'.txt'),$json_data);

        $data = $this->storeMatchInfo($fileName);

         $this->saveMatchDataFromAPI($data);

        return [$match_id.' match data updated successfully'];

    }

    //get file data from local
    public function getJsonFromLocal($path=null)
    {
        return json_decode(file_get_contents($path));
    }

    public function storeMatchInfoAtMachine($data,$fileName){

        \File::put(public_path('/data/v2/matches/'.$fileName),$data);                
    }

    public function getMatchInfoFromMachine($fileName=null,$file_path="/upload/json/"){
        if($fileName){
            $files = [$fileName];
        }else{
            $files = ['live','completed','upcoming'];
        }
        try {
            if(in_array($fileName, $files)){
                return $this->getJsonFromLocal(public_path($file_path.$fileName.'.txt'));
            }

        } catch (Exception $e) {
            //  dd($e);
        }
        return ['match info stored'];
    }

    // store by match type
    public function storeMatchInfo($fileName=null){
        if($fileName){
            $files = [$fileName];
        }else{
            $files = ['live','completed','upcoming'];
        }
        try {
            if(in_array($fileName, $files)){
                return $this->getJsonFromLocal(public_path('/upload/json/'.$fileName.'.txt'));
            }

        } catch (Exception $e) {
            //  dd($e);
        }
        return ['match info stored'];
    }

    public function saveMatchDataById($data){
        $data = json_decode($data);

        if(isset($data->response)){

            $result_set = $data->response;

            foreach ($result_set as $key => $rs) {
                $data_set[$key] = $rs;
            }
            $remove_data = ['toss','venue','teama','teamb','competition'];

            $matches = Matches::firstOrNew(
                [
                    'match_id' => $data_set['match_id']
                ]
            );

            foreach ($data_set as $key => $value) {

                if(in_array($key, $remove_data)){
                    continue;
                }
                $matches->$key = $value;
            }
            $matches->save();
        }
        //
        return ["match info updated "];

    }

    public function saveMatchDataFromAPI2DB($data){
        $data = json_decode($data);

        if(isset($data->response)){
            $result_set = $data->response;
            $mid = [];
            //  foreach ($results as $key => $result_set) {

            if($result_set->format==5   or $result_set->format==17){
                // continue;
            }
            foreach ($result_set as $key => $rs) {
                $data_set[$key] = $rs;
            }
            $competition = Competition::firstOrNew(['match_id' => $data_set['match_id']]);
            $competition->match_id   = $data_set['match_id'];

            foreach ($data_set['competition'] as $key => $value) {
                $competition->$key = $value;
            }
            $competition->save();
            $competition_id = $competition->id;

            /*TEAM A*/
            $team_a = TeamA::firstOrNew(['match_id' => $data_set['match_id']]);
            $team_a->match_id   = $data_set['match_id'];

            foreach ($data_set['teama'] as $key => $value) {
                $team_a->$key = $value;
            }

            $team_a->save();

            $team_a_id = $team_a->id;


            /*TEAM B*/
            $team_b = TeamB::firstOrNew(['match_id' => $data_set['match_id']]);
            $team_b->match_id   = $data_set['match_id'];

            foreach ($data_set['teamb'] as $key => $value) {
                $team_b->$key = $value;
            }

            $team_b->save();
            $team_b_id = $team_b->id;


            /*Venue */
            $venue = Venue::firstOrNew(['match_id' => $data_set['match_id']]);
            $venue->match_id   = $data_set['match_id'];

            foreach ($data_set['venue'] as $key => $value) {
                $venue->$key = $value;
            }

            $venue->save();
            $venue_id = $venue->id;


            /*Venue */
            $toss = Toss::firstOrNew(['match_id' => $data_set['match_id']]);
            $toss->match_id   = $data_set['match_id'];

            foreach ($data_set['toss'] as $key => $value) {
                $toss->$key = $value;
            }

            $toss->save();
            $toss_id = $toss->id;

            $remove_data = ['toss','venue','teama','teamb','competition'];


            $matches = Matches::firstOrNew(
                [
                    'match_id' => $data_set['match_id']
                ]
            );
            foreach ($data_set as $key => $value) {

                if(in_array($key, $remove_data)){
                    continue;
                }
                $matches->$key = $value;

            }
            $matches->toss_id = $toss_id;
            $matches->venue_id = $venue_id;
            $matches->teama_id = $team_a_id;
            $matches->teamb_id = $team_b_id;
            $matches->competition_id = $toss_id;

            $matches->save();

            $mid[] = $data_set['match_id'];
            $this->createContest($data_set['match_id']);
         
            if(count($mid)){
                $this->getSquad($mid);
                // $this->saveSquad($mid);
            }
        }
        return [$mid,"match info updated "];
    }

    public function saveMatchDataFromAPI($data){
        echo date('h:i:s A');
        if(isset($data->response) && count($data->response->items)){

            $results = $data->response->items;
            $mid = [];
            foreach ($results as $key => $result_set) {
                if($result_set->format==5   or $result_set->format==17){
                 //   continue;
                }
                foreach ($result_set as $key => $rs) {
                    $data_set[$key] = $rs;
                }
                $competition = Competition::firstOrNew(['match_id' => $data_set['match_id']]);
                $competition->match_id   = $data_set['match_id'];

                foreach ($data_set['competition'] as $key => $value) {
                    $competition->$key = $value;
                }
                $competition->save();
                $competition_id = $competition->id;

                /*TEAM A*/
                $team_a = TeamA::firstOrNew(['match_id' => $data_set['match_id']]);
                $team_a->match_id   = $data_set['match_id'];

                foreach ($data_set['teama'] as $key => $value) {
                    $team_a->$key = $value;
                }

                $team_a->save();
                $team_a_id = $team_a->id;
                /*TEAM B*/
                $team_b = TeamB::firstOrNew(['match_id' => $data_set['match_id']]);
                $team_b->match_id   = $data_set['match_id'];

                foreach ($data_set['teamb'] as $key => $value) {
                    $team_b->$key = $value;
                }

                $team_b->save();
                $team_b_id = $team_b->id;


                /*Venue */
                $venue = Venue::firstOrNew(['match_id' => $data_set['match_id']]);
                $venue->match_id   = $data_set['match_id'];

                foreach ($data_set['venue'] as $key => $value) {
                    $venue->$key = $value;
                }

                $venue->save();
                $venue_id = $venue->id;


                /*Venue */
                $toss = Toss::firstOrNew(['match_id' => $data_set['match_id']]);
                $toss->match_id   = $data_set['match_id'];

                foreach ($data_set['toss'] as $key => $value) {
                    $toss->$key = $value;
                }

                $toss->save();
                $toss_id = $toss->id;

                $remove_data = ['toss','venue','teama','teamb','competition'];



                $matches = Matches::firstOrNew(
                    [
                        'match_id' => $data_set['match_id']
                    ]
                );
                
                if(isset($matches->is_cancelled) && $matches->is_cancelled){
                    continue;
                }

                foreach ($data_set as $key => $value) {

                    if(in_array($key, $remove_data)){
                        continue;
                    }
                    $matches->$key = $value; 
                    if($key=='status_str' && $value=='Scheduled')
                    {  
                        $matches->status_str = 'Upcoming';
                    }
                }
                $matches->toss_id = $toss_id;
                $matches->venue_id = $venue_id;
                $matches->teama_id = $team_a_id;
                $matches->teamb_id = $team_b_id;
                $matches->competition_id = $toss_id;

                $matches->save();

                $mid[] = $data_set['match_id'];

               // if($matches->status==1){
                    $this->createContest($data_set['match_id']);   
               // }
                //

            }
            if(count($mid)){
                //$player_match_id =  Matches::whereIn('match_id',$mid)->groupBy('match_id')->pluck('match_id')->toArray();               
                //$arr = array_diff($mid,$player_match_id);

                $this->getSquad($mid);
            }
        }
        
        //
        return ["match info updated "];
    }

    public function saveSquad($match_ids=null){
        foreach ($match_ids as $key => $match_id) {
            # code...
            $cid = Competition::where('match_id',$match_id)->first();

            $token =  $this->token;
            $path = $this->cric_url.'competitions/'.$cid->cid.'/squads/'.$match_id.'?token='.$this->token;

            $data_sqd = file_get_contents($path);
            $this->storeMatchInfoAtMachine($data_sqd,'squads/'.$match_id.'.txt');
            $data = $this->getJsonFromLocal($path);

            foreach ($data->response->squads as $key => $pvalue) {

                if(!isset($pvalue->players)){
                    continue;
                }

                foreach ($pvalue->players as $key2 => $results) {

                    $data_set =   Player::firstOrNew(
                        [
                            'pid'       =>  $results->pid,
                            'team_id'   =>  $pvalue->team_id,
                            'match_id'  =>  $match_id
                        ]
                    );

                    foreach ($results as $key => $value) {
                        if($key=="primary_team"){
                            continue;
                            $data_set->$key = json_encode($value);
                        }
                        $data_set->$key         =   $value;
                        $data_set->match_id     =   $match_id;
                        $data_set->team_id      =   $pvalue->team_id;
                        $data_set->cid          =   $cid->cid;

                    }

                    $data_set->save();

                }
            }
        }
        echo "player saved";
        //return ['saved'];
    }

    public function updateSquad($match_id=null){

        # code...
        $cid = Competition::where('match_id',$match_id)->first();

        $token =  $this->token;
        $path = $this->cric_url.'competitions/'.$cid->cid.'/squads/'.$match_id.'?token='.$this->token;

        $data = $this->getJsonFromLocal($path);

        foreach ($data->response->squads as $key => $pvalue) {
            if(!isset($pvalue->players)){
                continue;
            }

            foreach ($pvalue->players as $key2 => $results) {


                $data_set =   Player::firstOrNew(
                    [
                        'pid'=>$results->pid,
                        'team_id'=>$pvalue->team_id,
                        'match_id'=>$match_id
                    ]
                );


                foreach ($results as $key => $value) {
                    if($key=="primary_team"){
                        continue;
                        $data_set->$key = json_encode($value);
                    }
                    $data_set->$key  =  $value;
                    $data_set->match_id  =  $match_id;
                    $data_set->team_id = $pvalue->team_id;
                }
                $data_set->save();
            }
        }

        echo "played saved";
        //return ['saved'];
    }

    public function getMatchHistory(Request $request){
        //$status =  $request->status;
        $user_id = $request->user_id;

        $is_user = Auth::loginUsingId($user_id);
        if($is_user === false){
            return  [
                'system_time'=>time(),
                'status'=>false,
                'code'=>201,
                'message'=>'User not found'
            ];
        }

        $status = '(
                        CASE
                        WHEN status_str = "Scheduled" THEN "Upcoming"
                        ELSE
                        "Scheduled" end) as status_str';



        $upcomingMatches = Matches::with('teama','teamb')
            ->select('match_id','title','short_title','status','status_str','timestamp_start','timestamp_end','date_start','date_end','game_state','competition_id','game_state_str',\DB::raw($status))
            ->whereIn('match_id',
                \DB::table('join_contests')->where('user_id',$user_id)
                    ->groupBy('match_id')
                    ->pluck('match_id')->toArray()
            )
            ->where('status',1)
            ->where('timestamp_start','>=' , time())
            ->orderBy('created_at','desc')
            ->get();
            
            $upcomingMatches->transform(function($items,$key)use($user_id){
                //  dd($items);

                $league_title = \DB::table('competitions')->where('id',$items->competition_id)->first()->title??null;

                $items->league_title = $league_title;

                if($items->is_free==0){
                    $items->has_free_contest= false;
                }else{
                    $items->has_free_contest= true;
                }

                $t1 = $items->timestamp_start;

                $date_start = date('h:i A',$t1);
                $items->date_start = $date_start;

                $total_joined_team = \DB::table('join_contests')
                    ->where('match_id' ,$items->match_id)
                    ->where('user_id',$user_id)
                    ->count();
                $items->total_joined_team = $total_joined_team;

                $total_join_contests =  \DB::table('join_contests')
                    ->where('match_id',$items->match_id)
                    ->where('user_id',$user_id)
                    ->groupBy('contest_id')
                    ->count();
                $items->total_join_contests = $total_join_contests;

                $total_created_team =  \DB::table('create_teams')
                    ->where('match_id',$items->match_id)
                    ->where('user_id',$user_id)
                    ->count();
                $items->total_created_team = $total_created_team;

                if($items->status==4){
                    $items->status_str = "Cancel"; 
                }
                elseif($items->status==2){
                    $items->status_str = "Completed" ;
                }
                elseif($items->status==1){
                   $items->status_str = "Upcoming"; 
                }elseif($items->status==3){
                   $items->status_str = "Live" ;
                }else{
                   $items->status_str = $items->status_str; 
                }
                return $items;
            });



        $completedMatches = Matches::with('teama','teamb')
            ->select('match_id','title','short_title','status','status_str','timestamp_start','timestamp_end','date_start','date_end','game_state','game_state_str','competition_id')
            ->whereIn('match_id',
                \DB::table('join_contests')->where('user_id',$user_id)
                    ->groupBy('match_id')
                    ->pluck('match_id')
                    ->toArray()
            )
            ->whereIn('status',[2,4])
            ->orderBy('timestamp_start','desc')
            ->get()
            ->transform(function($items,$key)use($user_id){
                //  dd($items);
                $league_title = \DB::table('competitions')->where('id',$items->competition_id)->first()->title??null;

                $items->league_title = $league_title;

                if($items->is_free==0){
                    $items->has_free_contest= false;
                }else{
                    $items->has_free_contest= true;
                }

                $t1 = $items->timestamp_start;

                $date_start = date('d,M Y, h:i A',$t1);
                $items->date_start = $date_start;

                $total_joined_team = \DB::table('join_contests')
                    ->where('match_id' ,$items->match_id)
                    ->where('user_id',$user_id)
                    ->get();
                $items->total_joined_team = $total_joined_team->count()??0;

                $total_join_contests =  \DB::table('join_contests')
                    ->where('match_id',$items->match_id)
                    ->where('user_id',$user_id)
                    ->selectRaw('distinct contest_id')
                    ->groupBy('contest_id')
                    ->get();

                $items->total_join_contests = $total_join_contests->count()??0;

                $total_created_team =  \DB::table('create_teams')
                    ->where('match_id',$items->match_id)
                    ->where('user_id',$user_id)
                    ->count();
                $items->total_created_team = $total_created_team;

                $prize = \DB::table('prize_distributions')
                        ->where('match_id' ,$items->match_id)
                        ->where('user_id',$user_id)
                        ->where('rank','>',0)
                        ->sum('prize_amount');

                $items->prize_amount = $prize;

                if($items->status==4){
                    $items->status_str = "Abandoned"; 
                }
                elseif($items->status==2){
                    $items->status_str = "Completed" ;
                }
                elseif($items->status==1){
                   $items->status_str = "Upcoming"; 
                }elseif($items->status==3){
                   $items->status_str = "Live" ;
                }else{
                   $items->status_str = $items->status_str; 
                }  
                if($items->status==2 && $items->current_status==0){
                    $items->status_str = "In Review" ;
                }      

                return $items;
            });


        $liveMatches = Matches::with('teama','teamb')
            ->select('match_id','title','short_title','status','status_str','timestamp_start','timestamp_end','date_start','date_end','game_state','game_state_str','competition_id')
            ->whereIn('match_id',
                \DB::table('join_contests')->where('user_id',$user_id)
                    ->groupBy('match_id')
                    ->pluck('match_id')
                    ->toArray()
            )
            ->where('status',3)
            ->orderBy('updated_at','desc')
            ->get()

            ->transform(function($items,$key)use($user_id){
                
                $league_title = \DB::table('competitions')->where('id',$items->competition_id)->first()->title??null;

                $items->league_title = $league_title;

                if($items->is_free==0){
                    $items->has_free_contest= false;
                }else{
                    $items->has_free_contest= true;
                }

                $t1 = $items->timestamp_start;

                $date_start = date('h:i A',$t1);
                $items->date_start = $date_start;

                $total_joined_team = \DB::table('join_contests')
                    ->where('match_id' ,$items->match_id)
                    ->where('user_id',$user_id)
                    ->get();
                $items->total_joined_team = $total_joined_team->count()??0;

                $total_join_contests =  \DB::table('join_contests')
                    ->where('match_id',$items->match_id)
                    ->where('user_id',$user_id)
                    ->selectRaw('distinct contest_id')
                    ->groupBy('contest_id')
                    ->get();

                $items->total_join_contests = $total_join_contests->count()??0;

                $total_created_team =  \DB::table('create_teams')
                    ->where('match_id',$items->match_id)
                    ->where('user_id',$user_id)
                    ->count();
                $items->total_created_team = $total_created_team;

                $prize = \DB::table('prize_distributions')
                        ->where('match_id' ,$items->match_id)
                        ->where('user_id',$user_id)
                        ->where('rank','>',0)
                        ->sum('prize_amount');

                $items->prize_amount = $prize;

                if($items->status==4){
                    $items->status_str = "Cancel"; 
                }
                elseif($items->status==2){
                    $items->status_str = "Completed" ;
                }
                elseif($items->status==1){
                   $items->status_str = "Upcoming"; 
                }elseif($items->status==3){
                   $items->status_str = "Live" ;
                }else{
                   $items->status_str = $items->status_str; 
                }

                if($items->status==2 && $items->current_status==0){
                    $items->status_str = "In Review" ;
                }

                $t1 = $items->timestamp_start;
                $t2 = time();
                $td = round((($t1 - $t2)/60),2);
                                  
                if($td>(0.5)){
                    $items->status=3;
                    $items->status_str='Upcoming Live';
                }

                return $items;
            });

        if(count($upcomingMatches)==0){
            $upcomingMatches = null;
        }
        if(count($completedMatches)==0){
            $completedMatches = null;
        }
        if(count($liveMatches)==0){
            $liveMatches = null;
        }


        $actiontype = $request->action_type;

        $my_match = null;
        switch ($actiontype) {
            case 'upcoming':
                $type_name = "upcomingMatch";
                $my_match = $upcomingMatches;
                break;
            case 'completed':
                $type_name = "completed";
                $my_match = $completedMatches;
                break;
            case 'live':
                $type_name = "live";
                $my_match = $liveMatches;
                break;

            default:
                $type_name = null;
                $my_match = null;
                break;
        }

        if($type_name && $my_match){
            $data['matchdata'][] = [
                'action_type'=>$actiontype, $type_name => $my_match
            ];
        }else{
            $data['matchdata'] = null;
        }
        return ['status'=>true,'code'=>200,'message'=>'success','system_time'=>time(),'response'=>$data];
    }

    // get Match by status and all
    public function getMatch(Request $request){

        $user = $request->user_id;
        $banner = \DB::table('banners')->select('title','url','actiontype')->get();
        $join_cont =  \DB::table('join_contests')->where('user_id',$user);
        $join_contests = $join_cont->get('match_id');
        
        $jm = [];
        $created_team = CreateTeam::where('user_id',$user)
           // ->where('team_join_status',1)
            ->orderBy('updated_at','desc')
            ->limit(5)
            ->get()
            ->groupBy('match_id');

        if($created_team->count()){
            foreach ($created_team as $match_id => $join_contest) {

                # code...
                $jmatches = Matches::with('teama','teamb')->where('match_id',$match_id)->select('match_id','title','short_title','status','status_str','timestamp_start','timestamp_end','game_state','game_state_str','current_status','competition_id','timestamp_end')
                    ->orderBy('status','DESC')
                    ->first();

                $winning_amount = $join_cont->where('cancel_contest',0)
                        ->where('user_id',$request->user_id)
                        ->where('match_id',$jmatches->match_id)
                        ->where('ranks','>',0)
                        ->sum('winning_amount');

                $join_match = $jmatches;
                $league_title = \DB::table('competitions')->where('id',$jmatches->competition_id)
                    ->first()->title??null;

                $prize = \DB::table('prize_distributions')
                        ->where('match_id' ,$jmatches->match_id)
                        ->where('user_id',$request->user_id)
                        ->where('rank','>',0)
                        ->sum('prize_amount');
                        /*
                $winning_amount = \DB::table('join_contests')
                        ->where('match_id' ,$jmatches->match_id)
                        ->where('user_id',$request->user_id)
                        ->where('ranks','>',0)
                        ->sum('winning_amount');*/
                
              //  $jmatches->prize_amount = $prize??$winning_amount;
                $join_match->winning_amount = $winning_amount;
                $join_match->prize_amount = $winning_amount??$prize;
                $jmatches->league_title = $league_title;

                if($jmatches->is_free==0){
                    $jmatches->has_free_contest= false;
                }else{
                    $jmatches->has_free_contest= true;
                }

                $join_contests_count =  \DB::table('join_contests')
                    ->where('user_id',$user)
                    ->where('match_id',$match_id)
                    ->selectRaw('distinct contest_id')
                    ->get();

                if((($join_match->timestamp_end < time())  && $join_match->timestamp_end > strtotime("-1440 minutes") &&  $join_match->current_status!=1) ||
                    ($join_match->status==2 && $join_match->current_status==0) 
                      //  $join_match->status_str = "In Review";
                    ){
                    if($join_match->status==4){
                       $join_match->status_str = 'Abandoned'; 
                    } 


                }elseif($join_match->current_status==1){
                    $join_match->status_str = "Completed";
                }else{
                    if($join_match->status==4){
                       $join_match->status_str = 'Abandoned'; 
                    }elseif($join_match->status==2){
                       $join_match->status_str = "Completed" ;
                    }
                    elseif($join_match->status==1){
                       $join_match->status_str = "Upcoming"; 
                    }elseif($join_match->status==3){
                       $join_match->status_str = "Live" ;
                        
                        $t11 = $jmatches->timestamp_end;
                        $t21 = time();
                        $td11 = round((($t11 - $t21)/60),2);
                        $request->merge(['match_id'=>$jmatches->match_id]);
                        $request->merge(['status'=>3]);
                        if($td11<0){
                            $this->updatePoints($request);     
                        }
                    }
                }                

                if($join_match->status==2 && $join_match->current_status==0){
                    $join_match->status_str = "In Review" ;
                }

                $lineup = \DB::table('team_a_squads')->where('match_id',$join_match->match_id)
                                ->where('playing11',"true")->count();

                if($lineup && $join_match->status==1){
                  //  $join_match->status_str = "lined up";
                }     

                $join_match_count   =   \DB::table('join_contests')
                    ->where('user_id',$user)
                    ->where('match_id',$match_id)
                    ->get();

                $join_match->total_joined_team   =  $join_match_count->count();
                $join_match->total_join_contests =  $join_contests_count->count();
                $jm[$match_id] = $join_match;
            }

            $data['matchdata'][] = [
                'viewType'=>1,
                'joinedmatches'=>array_values($jm)
            ];
        }
        //dd(\Carbon\Carbon::now()->endOfWeek());
        $match = Matches::with('teama','teamb')
            ->whereIn('status',[1,3])
            ->select('match_id','title','short_title','status','status_str','timestamp_start','timestamp_end','date_start','date_end','game_state','game_state_str','is_free','competition_id')
            ->orderBy('is_free','DESC')
            ->orderBy('timestamp_start','ASC')
            ->whereMonth('date_start',date('m'))
            ->where('timestamp_start','>=' , time())
            ->limit(15)
            ->get()->transform(function($item,$key){
                    $league_title = \DB::table('competitions')->where('id',$item->competition_id)->first()->title??null;

                    if($item->is_free==0){
                        $item->has_free_contest= false;
                    }else{
                        $item->has_free_contest= true;
                    }

                    $lineup = \DB::table('team_a_squads')->where('match_id',$item->match_id)
                                ->where('playing11',"true")->count();

                   /* if($lineup && $item->status==1){
                        $item->status = "lined up";
                    }   */ 

                    $t1 = $item->timestamp_start;

                    $date_start = date('h:i A',$t1);
                    $item->date_start = $date_start;

                    $t2 = time();
                    $td = round((($t1 - $t2)/60),2);
                                        
                    $item->time_left = ($td>0)?$td.'Min':'time up';    

                    if($td>(0.5)){
                        $item->status=1;
                        $item->status_str='Upcoming';
                    }
                    if($td>1 and $td<=30){
                        $item->status=1;
                        $item->status_str='Upcoming';
                        $item->is_lineup = true; 
                        //exec('curl https://sportsfight.in/api/v2/updateMatchDataByStatus/3');
        
                    }else{
                        $item->is_lineup = $lineup?true:false;
                    } 

                    $item->league_title = $league_title;
                    return $item;
            });

        $data['matchdata'][] = ['viewType'=>2,'banners'=>$banner];
        $data['matchdata'][] = ['viewType'=>3,'upcomingmatches'=>$match];
        
        Log::channel('after_getMatch')->info($request->all());
        return ['total_result'=>count($match),'status'=>true,'code'=>200,'message'=>'success','system_time'=>time(),'response'=>$data];
    }

    public function getAllCompetition(){
        $com = \DB::table('competitions')->select('id','match_id','cid')->get()->toArray();
        return $com;
    }
    public function getAnalytics($match_id = null){
        
        $ct = CreateTeam::where('match_id',$match_id)->count();
        $player = \DB::table('player_analytics')->select('player_id',\DB::raw('COUNT(player_id) as count'))->where('match_id',$match_id)->groupBy('player_id')->where('created_team_id','>',0)->get()
            ->transform(function($item,$key) use($ct,$match_id){
                if($ct){
                  $percent = ($item->count/$ct)*100;  
              }else{
                    $percent = 0;
              }
                $trump = \DB::table('create_teams')
                        ->where('match_id',$match_id)
                        ->where('trump',$item->player_id)
                        ->count();
                $vc = \DB::table('create_teams')
                        ->where('match_id',$match_id)
                        ->where('vice_captain',$item->player_id)
                        ->groupBy('vice_captain')
                        ->count();
                $captain = \DB::table('create_teams')
                        ->where('match_id',$match_id)
                        ->where('captain',$item->player_id)
                        ->groupBy('captain')
                        ->count();
                $trump_per = ($trump/$ct)*100;
                $vc_per = ($vc/$ct)*100;
                $captain_per = ($captain/$ct)*100;
                
                $item->selection = number_format($percent,1);
                $item->trump = $trump_per;  
                $item->vice_captain = $vc_per;
                $item->captain = $captain_per; 

                return $item;

            });

        return $player;

    }
    // get players
    public function getPlayer(Request $request)
    {
        $analytics  = $this->getAnalytics($request->match_id);
        $match_id   =  $request->get('match_id');
        $matchVald  = Matches::where('match_id',$request->match_id)->count();
        if(!$matchVald){
            return [
                'status'=>false,
                'code' => 201,
                'message' => ' match_id is invalid'

            ];
        }

        $players =  Player::with(['teama'=>function($q) use ($match_id){
            $q->where('match_id',$match_id);
        }])
            ->with(['teamb'=>function($q)use ($match_id){
                $q->where('match_id',$match_id);
            }])
            ->with('team_b','team_a')
            ->where(function($q) use($match_id){
                $q->groupBy('playing_role');
                $q->where('match_id',$match_id);
            })
            ->orderBy('fantasy_player_rating','DESC')
            ->get();

        if(!$players->count()){
            return ['status'=>true,'code'=>404,'message'=>'record not found',
                'response'=>[
                    'players'=>[]
                ]
            ];
        }
        $rs['wk'] = [];
        $bat['bat'] = [];
        $bat['all'] = [];
        $bat['bowl'] = [];

        $match_points= MatchPoint::where('match_id',$match_id)->pluck('point','pid')->toArray();

        foreach ($players as $key => $results) {
            if($results->teama ){

                $data['playing11'] =  filter_var($results->teama->playing11, FILTER_VALIDATE_BOOLEAN);

            }
            elseif($results->teamb){

                $data['playing11'] =  filter_var($results->teamb->playing11, FILTER_VALIDATE_BOOLEAN);
            }

            if($results->team_a){
                $data['team_name'] = $results->team_a->short_name;
            }else{

                $data['team_name'] = $results->team_b->short_name;
            }

            $data['pid'] = $results->pid;
            $data['match_id'] = $results->match_id;
            $data['team_id'] = $results->team_id;
            $data['points'] = ($match_points[$results->pid])??0;
            $fname = $results->first_name;
            $lname = $results->last_name;

            $fl = strlen(trim($fname.trim($lname)));
            
            if($fl>=25){
                $data['short_name'] = $results->short_name;
            }else{
                if(strlen($lname)<=25)
                {
                    $data['short_name'] = $fname." ".$lname;
                }
                else{
                    if($lname==""){
                        $data['short_name'] = $results->short_name;
                    }else{
                        $data['short_name'] = $fname.' '.$lname;    
                    }
                    
                }
            }
          //  $data['short_name'] =  $results->title;           
            $data['fantasy_player_rating'] = ($results->fantasy_player_rating);

            $sel_per = $analytics->where('player_id',$results->pid)->first();
            
            if($sel_per){
                $data['analytics'] = $analytics->where('player_id',$results->pid)->first();
            }else{
                $data['analytics'] = ['selection'=>"0.0",'trump'=>"0.0",'vice_captain'=>"0.0",'captain'=>'0.0'];
            }

            if($results->playing_role=="wkbat")
            {
                $rs['wk'][]  = $data;
            }else{
                $rs[$results->playing_role][]  = $data;
            }

            $data = [];
        } 
        return  [
            'system_time'=>time(),
            'status'=>true,
            'code'=>200,
            'message'=>'success',
            'response'=>[
                'players'=>$rs
            ]
        ];
    }
    


    // update player by match_id

    public function getSquad($match_ids=null){

        foreach ($match_ids as $key => $match_id) {
            # code...
            $t1 =  date('h:i:s');
            $token =  $this->token;
            $path = $this->cric_url.'matches/'.$match_id.'/squads/?token='.$token;
            $data = $this->getJsonFromLocal($path);
            // update team a players
            $teama = $data->response->teama;
            foreach ($teama->squads as $key => $squads) {
                $teama_obj = TeamASquad::firstOrNew(
                    [
                        'team_id'=>$teama->team_id,
                        'player_id'=>$squads->player_id,
                        'match_id'=>$match_id
                    ]
                );

                $teama_obj->team_id   =  $teama->team_id;
                $teama_obj->player_id =  $squads->player_id;
                $teama_obj->role      =  $squads->role;
                $teama_obj->role_str  =  $squads->role_str;
                $teama_obj->playing11 =  $squads->playing11;
                $teama_obj->name      =  $squads->name;
                $teama_obj->match_id  =  $match_id;

                $teama_obj->save();
                $team_id[$squads->player_id] = $teama->team_id;
            }

            $teamb = $data->response->teamb;
            foreach ($teamb->squads as $key => $squads) {

                $teamb_obj = TeamBSquad::firstOrNew(['team_id'=>$teamb->team_id,'player_id'=>$squads->player_id,'match_id'=>$match_id]);

                $teamb_obj->team_id   =  $teamb->team_id;
                $teamb_obj->player_id =  $squads->player_id;
                $teamb_obj->role      =  $squads->role;
                $teamb_obj->role_str  =  $squads->role_str;
                $teamb_obj->playing11 =  $squads->playing11;
                $teamb_obj->name      =  $squads->name;
                $teamb_obj->match_id  =  $match_id;
                $teamb_obj->save();

                $team_id[$squads->player_id] = $teamb->team_id;
            }
            // update all players
            foreach ($data->response->players as $pkey => $pvalue)
            {

                $data_set =   Player::firstOrNew(
                    [
                        'pid'=>$pvalue->pid,
                        'team_id'=>$team_id[$pvalue->pid],
                        'match_id'=>$match_id
                    ]
                );

                foreach ($pvalue as $key => $value) {
                    if($key=="primary_team"){
                        continue;
                        $data_set->$key = json_encode($value);
                    }
                    $data_set->$key  =  $value;
                    $data_set->match_id  =  $match_id;
                    $data_set->pid = $pvalue->pid;
                    $data_set->team_id = $team_id[$pvalue->pid];
                }

                $data_set->save();
            }
            // update player in updatepoint table

            foreach ($data->response->players as $pkey => $pvalue)
            {
                $data_mp =  MatchPoint::firstOrNew(
                    [
                        'pid'=>$pvalue->pid,
                        'match_id'=>$match_id
                    ]
                ); 
                if($data_mp->short_name==null){
                    $data_mp->match_id  =  $match_id;
                    $data_mp->pid = $pvalue->pid; 
                    $data_mp->role = $pvalue->playing_role; 
                    $data_mp->name = $pvalue->short_name; 
                    $data_mp->rating = $pvalue->fantasy_player_rating;
                
                    $data_mp->save(); 
                } 
            }
            $t2 =  date('h:i:s');
            //echo $t1.'--'.$t2;
        }
    }

    public function getCompetitionByMatchId($match_id=null){
        $d['start_time'] = date('d-m-Y h:i:s A');
        $com = \DB::table('competitions')
            ->select('id','match_id','cid')
            ->where(function($query) use ($match_id){
                $query->where('match_id',$match_id);
            })->get()->toArray();

        $token = $this->token ;
        $players = [];

        foreach ($com as $key => $result) {

            $path = $this->cric_url.'competitions/'.$result->cid.'/squads/?token='.$token;

            $data = $this->getJsonFromLocal($path);

            if(isset($data->response->squads)){
                foreach ($data->response->squads as $key => $rs) {
                    if($rs->players){

                        foreach ($rs->players as $pkey => $pvalue) {

                            $data_set =   Player::firstOrNew(['pid'=>$pvalue->pid]);
                            foreach ($pvalue as $key => $value) {

                                if($key=="primary_team"){
                                    continue;
                                    $data_set->$key = json_encode($value);
                                }

                                $data_set->$key = $value;
                            }
                            $data_set->match_id = $result->match_id;
                            $data_set->cid = $result->cid;
                            if($rs->team_id){
                                $data_set->team_id = $rs->team_id;
                            }
                            $data_set->save();
                        }

                    }


                }

            }

        }
        $d['end_time'] = date('d-m-Y h:i:s A');
        $d['message'] ="Player information updated";
        $d['status'] ="ok";
        return  $d;
    }


    public function updateAllSquad(){

        $com =  Matches::where('status',3)->select('match_id')->get();
        $players = [];

        foreach ($com as $key => $value) {
            $this->getSquad([$value->match_id]);
        }

        echo date('h:i:s');
    }

    public function maxAllowedTeam($request){
        if($request->created_team_id==null){
            return false;
        }    
        $created_team = CreateTeam::whereIn('id',$request->created_team_id)->count();

        $contest = CreateContest::find($request->contest_id);

        $total_spots = $contest->total_spots??0;
        $filled_spot = $contest->filled_spot??0;

        $allowed_team = 0;
        
        if($total_spots>0){
            $allowed_team = $total_spots-$filled_spot;
            if($allowed_team<0){
                 return [
                    'status'=>false,
                    'code' => 201,
                    'message' => 'This Contest is already full'
                ];
            }
        } 

        if($allowed_team<$created_team && $total_spots!=0){
            return [
                'status'=>false,
                'code' => 201,
                'message' => 'Only '.$allowed_team.' spot left!'
            ];

        }elseif($created_team>$total_spots && $total_spots!=0){

            return [
                'status'=>false,
                'code' => 201,
                'message' => 'Max allowed spot exceeded!'
            ];
        }
        elseif($total_spots == $filled_spot && $total_spots!=0){
            return [
                'status'=>false,
                'code' => 201,
                'message' => 'Spot already full!'
            ];
        }
            
        $check_join_contest = \DB::table('join_contests')
            ->whereIn('created_team_id',$request->created_team_id)
            ->where('match_id',$request->match_id)
            ->where('user_id',$request->user_id)
            ->where('contest_id',$request->contest_id)
            ->get();
        
        $created_team_id  = $request->created_team_id;
        $contest_id       = $request->contest_id;  

        if(count($created_team_id)==1 AND  $check_join_contest->count()==1){
            return [
                'status'=>false,
                'code' => 201,
                'message' => 'This team already Joined'

            ];
        }

        $cc = CreateContest::find($contest_id);

        if($cc && ($cc->total_spots>0 && $cc->filled_spot>=$cc->total_spots)){
            return [
                'status'=>false,
                'code' => 201,
                'message' => 'This contest is already full!'

            ];
        }        
        return true;
    }

    public function  joinContest(Request  $request)
    {

        $match_id           = $request->match_id;
        $user_id            = $request->user_id;
        $created_team_id    = $request->created_team_id;
        $contest_id         = $request->contest_id;
        $max_t = $this->maxAllowedTeam($request);
        // join team validation 

        $this->matchInfo($request,'joinContest'); 

        $validator = Validator::make($request->all(), [
            'match_id' => 'required',
            'user_id' => 'required',
            'contest_id' => 'required',
            'created_team_id' => 'required'

        ]);  
        // Return Error Message
        if ($validator->fails() || !isset($created_team_id)) {
            $error_msg  =   [];
            foreach ( $validator->messages()->all() as $key => $value) {
                array_push($error_msg, $value);
            }

            return Response::json(array(
                    'system_time'=>time(),
                    'status' => false,
                    "code"=> 201,
                    'message' => $error_msg[0]??'Team id missing'
                )
            );
        }

        Log::channel('before_join_contest')->info($request->all());

        $check_join_contest = \DB::table('join_contests')
            ->whereIn('created_team_id',$created_team_id)
            ->where('match_id',$match_id)
            ->where('user_id',$user_id)
            ->where('contest_id',$contest_id)
            ->get();

        if(count($created_team_id)==1 AND  $check_join_contest->count()==1){
            return [
                'status'=>false,
                'code' => 201,
                'message' => 'This team already Joined'

            ];
        }

        $cc = CreateContest::find($contest_id);

        if($cc && ($cc->total_spots!=0 && $cc->filled_spot>=$cc->total_spots)){
            return [
                'status'=>false,
                'code' => 201,
                'message' => 'This contest already full'

            ];
        }

        if($max_t!==true){
            return $max_t;
            exit();
        }

        $userVald = User::find($request->user_id);
        $matchVald = Matches::where('match_id',$request->match_id)->count();

        if(!$userVald || !$matchVald || !$contest_id){
            return [
                'status'=>false,
                'code' => 201,
                'message' => 'user_id or match_id or contest_id is invalid'

            ];
        }
        
        $data = [];
        $cont = [];

        $ct = \DB::table('create_teams')
            ->whereIn('id',$created_team_id)->count();

        if($ct)
        {
            foreach ($created_team_id as $key => $ct_id) {
                \DB::beginTransaction();
                
                $is_full = CreateContest::find($contest_id);
                if($is_full==null){
                    return [
                        'status'=>false,
                        'code' => 201,
                        'message' => 'invalid contest'
                    ];
                }
                if($is_full && $is_full->total_spots>0  && ($is_full->total_spots==$is_full->filled_spot)){
                    return [
                        'status'=>false,
                        'code' => 201,
                        'message' => 'This Contest is already full'
                    ];
                }
                // free contest validation, if more than two team 
                $check_max_contest = \DB::table('join_contests')
                        ->where('match_id',$match_id)
                        ->where('user_id',$user_id)
                        ->where('contest_id',$contest_id)
                        ->count(); 

                $contestT = CreateContest::find($contest_id);
                $contestTyp = \DB::table('contest_types')->where('id',$contestT->contest_type)->first();

                 /*if(
                    isset($check_max_contest) 
                    && $check_max_contest>=2 
                    && $is_full->entry_fees==0 || $check_max_contest>=$contestTyp->max_entries
                )*/
                if(
                    isset($check_max_contest) 
                    && $check_max_contest>=$contestTyp->max_entries
                    || isset($request->created_team_id) && count($request->created_team_id) >$contestTyp->max_entries
                ){

                    return [
                        'status'=>false,
                        'code' => 201,
                        'message' => "Only $contestTyp->max_entries teams are allowed"
                    ];
                }

                

                $check_join_contest = \DB::table('join_contests')
                    ->where('created_team_id',$ct_id)
                    ->where('match_id',$match_id)
                    ->where('user_id',$user_id)
                    ->where('contest_id',$contest_id)
                    ->first();

                if($check_join_contest){

                    continue;
                }
                $data['match_id'] = $match_id;
                $data['user_id'] = $user_id;
                $data['created_team_id'] = $ct_id;
                $data['contest_id'] = $contest_id;

                $ctid  = CreateTeam::find($ct_id);
                $data['team_count'] = $ctid->team_count??null;

                
                   // $cc->save();
                    // payment deduct
                   // $total_team_count   =  count($request->created_team_id);
                    $total_fee          =  $cc->entry_fees;
                   // $payable_amount     =  $total_fee*$total_team_count;
                    $payable_amount     =  $total_fee;    
                    $deduct_from_bonus  =  $payable_amount*(0.1);
                    
                    $final_paid_amount  =  $payable_amount-$deduct_from_bonus;

                    $item = Wallet::where('user_id',$user_id)->get();
                    
                    $bonus_amount = $item->where('payment_type',1)->first();

                    $refer_amount = $item->where('payment_type',2)->first();
                    $depos_amount = $item->where('payment_type',3)->first();
                    $prize_amount = $item->where('payment_type',4)->first();
                   
                    $transaction_amt = 0;
                    if($bonus_amount && $bonus_amount->amount>$deduct_from_bonus){
                        $bonus_amount->amount = $bonus_amount->amount-$deduct_from_bonus;
                        $bonus_amount->save();
                         
                    }else{

                        $final_paid_amount = $final_paid_amount+($deduct_from_bonus);
                    } 
                                                                     
                    if($depos_amount && $depos_amount->amount > $final_paid_amount){
                        $depos_amount->amount = $depos_amount->amount-$final_paid_amount;
                        $depos_amount->save();
                       
                    }elseif($prize_amount && $prize_amount->amount > $final_paid_amount){
                        $prize_amount->amount = $prize_amount->amount-$final_paid_amount;
                        $prize_amount->save();
                        
                    }elseif($refer_amount && $refer_amount->amount > $final_paid_amount){
                        
                        $refer_amount->amount = $refer_amount->amount-$final_paid_amount;
                        $refer_amount->save();
                         
                    }else{

                        if(isset($is_full) && $is_full->entry_fees>0){
                             return [
                                'status'=>false,
                                'code' => 201,
                                'message' => "You don't have sufficient balance!"
                            ]; 
                        }
                       
                    } 

                 //   $cc->save(); 
                    // transaction histoory
                    if($final_paid_amount){
                        $wt =  new WalletTransaction;
                        $wt->user_id = $user_id;
                        $wt->amount  =$final_paid_amount;
                        $wt->payment_type = 6;
                        $wt->payment_type_string = 'Join Contest';
                        $wt->transaction_id = time().'-'.$user_id;
                        $wt->payment_mode =  'Sportfight';
                        $wt->payment_status =  'Success';
                        $wt->debit_credit_status = "-";
                        $wt->payment_details = json_encode($request->all());
                       
                        $wt->save();
                    } 

                $jcc = \DB::table('join_contests')
                    ->where('match_id',$match_id)
                    ->where('contest_id',$contest_id)
                    ->where('user_id',$user_id)
                    ->count();
               // if($jcc<=$cc->total_spots || $cc->total_spots==0){
                // join contest    
                $t =   JoinContest::updateOrCreate($data,$data);

               // }
                // End spot count
                $cont[] = $data;
                $ct = \DB::table('create_teams')
                    ->where('id',$ct_id)
                    ->update(['team_join_status'=>1]);

                $cc->filled_spot = CreateTeam::where('match_id',$match_id)
                    ->where('team_join_status',1)->count();
                $cc->save();

                $is_full = CreateContest::find($contest_id);
                $c_count = (int)$is_full->is_full+1;
                $is_full->is_full = $c_count;
                $is_full->filled_spot =  $c_count;
                $is_full->save();

            \DB::commit();

            }
            $message = "Team created successfully!";
        }else{
            $cont = ["error"=>"contest id not found"];
            $message = "Something went wrong!";
        }
        Log::channel('after_join_contest')->info($cont);

        $match_info = $this->setMatchStatusTime($match_id);
          //  dd($match_info);
            return response()->json(
                [
                'system_time'=>time(),
                'match_status' => $match_info['match_status']??null,
                'match_time' => $match_info['match_time']??null,
                "status"=>true,
                "code"=>200,
                "message"=>$message,
                "response"=>["joinedcontest"=>$cont]
            ]
        );
    }


    // get contest details by match id
    public function getMyContest(Request $request){

        $match_id =  $request->match_id;

        $matchVald = Matches::where('match_id',$request->match_id)->count();

        if(!$matchVald){
            return [
                'system_time'=>time(),
                'status'=>false,
                'code' => 201,
                'message' => 'match id is invalid'

            ];
        }

        $join_contests = JoinContest::where('user_id',$request->user_id)
            ->where('match_id',$match_id)->groupBy('contest_id')
            ->pluck('contest_id')->toArray();
            
        $validator = Validator::make($request->all(), [
            //  'match_id' => 'required'
        ]);

        // Return Error Message
        if ($validator->fails()) {
            $error_msg  =   [];
            foreach ( $validator->messages()->all() as $key => $value) {
                array_push($error_msg, $value);
            }
            return Response::json(array(
                    'system_time'=>time(),
                    'status' => false,
                    "code"=> 201,
                    'message' => $error_msg[0]
                )
            );
        }

        $contest = CreateContest::with('contestType')
            ->where('match_id',$match_id)
            ->whereIn('id',$join_contests)
            ->orderBy('sort_by','ASC')
            ->get();

        if($contest){
            $matchcontests = [];

            foreach ($contest as $key => $result) {
                $myjoinedContest = $this->myJoinedTeam($request->match_id,$request->user_id,$result->id);

                // dd($result);
                $data2['isCancelled'] =   $result->is_cancelled?true:false;
                $data2['totalSpots'] =   $result->total_spots;
                $data2['firstPrice'] =   $result->first_prize;
                $data2['totalWinningPrize'] =    $result->total_winning_prize;
                if($result->total_spots==0)
                {
                    $data2['totalSpots'] =   0;

                    $twp = round(($result->filled_spot)*($result->entry_fees)*(0.5));
                    $data2['totalWinningPrize'] = round(($result->filled_spot)*($result->entry_fees)*(0.5));

                    $data2['firstPrice'] =   round($twp*(0.2));
                }
                elseif($result->total_spots!=0 && $result->filled_spot==$result->total_spots)
                {
                  //  continue;
                }

                $data2['contestTitle']      =  $result->contestType->contest_type;
                $data2['contestSubTitle']   =  $result->contestType->description;
                $data2['contestId']         =  $result->id;

                $data2['entryFees']         =  $result->entry_fees;
                $data2['filledSpots']       =  $result->filled_spot;
                $data2['winnerPercentage']  =  $result->winner_percentage;
                $data2['maxAllowedTeam']    =  $result->contestType->max_entries;
                $data2['cancellation']      =  $result->cancellable;
                $data2['maxEntries']        =  $result->contestType->max_entries;
                $data2['joinedTeams']       =  $myjoinedContest;


                $matchcontests[] = $data2;
            }
            $data = $matchcontests;

            $match_info = $this->setMatchStatusTime($match_id);
          //  dd($match_info);
             return response()->json(
                [
                    'system_time'=>time(),
                    'match_status' => $match_info['match_status']??null,
                    'match_time' => $match_info['match_time']??null,
                    'system_time'=>time(),
                    "status"=>true,
                    "code"=>200,
                    "message"=>"Success",
                    "response"=>[
                        'my_joined_contest'=>$data
                    ]
                ]
            );
        }
    }


    public function getMyContest2(Request $request){

        $match_id =  $request->match_id;

        $matchVald = Matches::where('match_id',$request->match_id)->count();

        
        $join_contests = JoinContest::where('user_id',$request->user_id)
            ->where('match_id',$match_id)->groupBy('contest_id')
            ->pluck('contest_id')->toArray();

        $contest = CreateContest::with('contestType')
            ->where('match_id',$match_id)
            ->whereIn('id',$join_contests)

            ->orderBy('contest_type','ASC')
            ->get();

        if($contest){
            $matchcontests = [];

            foreach ($contest as $key => $result) {
                $myjoinedContest = $this->myJoinedTeam($request->match_id,$request->user_id,$result->id);

                // dd($result);
                $data2['isCancelled'] =   $result->is_cancelled?true:false;
                $data2['totalSpots'] =   $result->total_spots;
                $data2['firstPrice'] =   $result->first_prize;
                $data2['totalWinningPrize'] =    $result->total_winning_prize;
                if($result->total_spots==0)
                {
                    $data2['totalSpots'] =   0;

                    $twp = round(($result->filled_spot)*($result->entry_fees)*(0.5));
                    $data2['totalWinningPrize'] = round(($result->filled_spot)*($result->entry_fees)*(0.5));

                    $data2['firstPrice'] =   round($twp*(0.2));
                }
                elseif($result->total_spots!=0 && $result->filled_spot==$result->total_spots)
                {
                  //  continue;
                }

                $data2['contestTitle'] = $result->contestType->contest_type;
                $data2['contestSubTitle'] =$result->contestType->description;
                $data2['contestId'] =    $result->id;
                //  $data2['totalWinningPrize'] =    $result->total_winning_prize;
                $data2['entryFees'] =    $result->entry_fees;
                // $data2['totalSpots'] =   $result->total_spots;
                $data2['filledSpots'] =  $result->filled_spot;
                //  $data2['firstPrice'] =   $result->first_prize;
                $data2['winnerPercentage'] = $result->winner_percentage;
                $data2['maxAllowedTeam'] =   $result->contestType->max_entries;
                $data2['cancellation'] = $result->cancellable;
                $data2['maxEntries'] =  $result->contestType->max_entries;
                $data2['joinedTeams'] = $myjoinedContest;


                $matchcontests[] = $data2;
            }
            return $matchcontests;
        }
    }

    public function myJoinedTeam($match_id=null,$user_id=null,$contest_id=null)
    {
        /*
                $check_my_contest = \DB::table('join_contests')
                        ->where('match_id',$match_id)
                        ->where('user_id',$user_id);


                $created_team_id = $check_my_contest->pluck('created_team_id')->toArray();
                $contest_id      = $check_my_contest->pluck('contest_id')->toArray();
                $myContest       =     $check_my_contest->first();*/


        $joinMyContest =  JoinContest::with('createTeam','contest')
            ->where('match_id',$match_id)
            ->where('user_id',$user_id)
            ->where('contest_id',$contest_id)
            ->orderBy('ranks','ASC')
            ->get()
            ->transform(function($item,$key){
                 /*$prize = \DB::table('prize_distributions')
                        ->where('match_id' ,$item->match_id)
                        ->where('user_id',$item->user_id)
                        ->where('contest_id',$item->contest_id)
                        ->where('created_team_id',$item->created_team_id)
                        ->first();
                
                if(isset($prize->rank)){
                    $item->prize_amount = $prize->prize_amount??$item->winning_amount;    
                }else{
                    $item->prize_amount = $item->winning_amount??0;
                }*/
                
                $item->prize_amount = $item->winning_amount??0;
                if($item->cancel_contest==1){
                    $item->prize_amount = 0;
                }
                
                return $item;
            });

        $userVald = User::find($user_id);
        if($joinMyContest){
            $matchcontests = [];

            foreach ($joinMyContest as $key => $result) {
                
                $data2['team_name'] = ($userVald->user_name).'('.$result->team_count.')';
                // $data2['team'] = $result->createTeam->team_count;
                $data2['createdTeamId'] =    $result->created_team_id;
                $data2['contestId'] =    $result->contest_id;
                $data2['isWinning'] =   false;
                $data2['rank']      = $result->ranks??$result->rank;
                $data2['points']    = $result->points;
                if(isset($result->prize_amount)){
                    $data2['prize_amount']    = $result->prize_amount??0; 
                }
                $matchcontests[] =  $data2 ;
                $data2 = [];
            }
            return $matchcontests;
        }
    }
    public function myJoinedContest($match_id=null,$user_id=null)
    {

        $check_my_contest = \DB::table('join_contests')
            ->where('match_id',$match_id)
            ->where('user_id',$user_id);

        $contest_id = $check_my_contest->pluck('created_team_id');
        $myContest  =     $check_my_contest->first();


        $joinMyContest =  JoinContest::with('createTeam','contest')
            ->where('match_id',$match_id)
            ->where('user_id',$user_id)
            ->whereIn('created_team_id',$contest_id)
            ->get();
        $userVald = User::find($user_id);
        if($joinMyContest){
            $matchcontests = [];

            foreach ($joinMyContest as $key => $result) {
                $t_c = $result->createTeam->team_count;
                $data2['teamName'] = ($userVald->first_name??$userVald->name).'('.$t_c.')';
                // $data2['team'] = $result->createTeam->team_count;
                $data2['createdTeamId'] =    $result->created_team_id;
                $data2['contestId'] =    $result->contest_id;
                $data2['totalWinningPrize'] =    $result->contest->total_winning_prize;
                $data2['entryFees'] =    $result->contest->entry_fees;
                $data2['totalSpots'] =   $result->contest->total_spots;
                $data2['filledSpots'] =  $result->contest->filled_spot;
                $data2['firstPrice'] =   $result->contest->first_prize;
                $data2['winnerPercentage'] = $result->contest->winner_percentage;
                $data2['cancellation'] = $result->contest->cancellable;
                $contest_type_id = $result->contest->contest_type;

                $contestType = \DB::table('contest_types')
                    ->where('id',$contest_type_id)
                    ->first();

                $data2['maxEntries'] = $contestType->max_entries;

                $matchcontests[$result->contest_type][] = [
                    'contestTitle'=>$contestType->contest_type,
                    'contestSubTitle'=>$contestType->description,
                    'contests'=>$data2
                ];
            }

            $data = [];
            foreach ($matchcontests as $key => $value) {

                foreach ($value as $key2 => $value2) {
                    $k['contestTitle'] = $value2['contestTitle'];
                    $k['contestSubTitle'] = $value2['contestSubTitle'];
                    $k['contests'][] = $value2['contests'];
                }
                $data[] = $k;
                $k= [];
            }

            return $data;

        }
    }

    //Added by manoj
    public function getWallet(Request $request){
        $myArr = array();

        $user_id = User::find($request->user_id);
        $wallet = Wallet::where('user_id',$request->user_id)->first();
        if($wallet){
            $myArr['wallet_amount']   = $wallet->usable_amount;
            $myArr['bonus_amount']    = $wallet->bonus_amount;
            $myArr['is_account_verified']    = $this->isAccountVerified($request);
            $myArr['refferal_friends_count']    = $this->getRefferalsCounts($request);
            $myArr['user_id']         =  $wallet->user_id;
            $myArr['withdrawal_amount']    = 0;
        }else{
            $myArr['wallet_amount']   = 0;
            $myArr['bonus_amount']    = 0;
            $myArr['withdrawal_amount']    = 0;
            $myArr['is_account_verified']    = $this->isAccountVerified($request);
            $myArr['refferal_friends_count']    = $this->getRefferalsCounts($request);
            $myArr['user_id']         = (int)$request->user_id;
        }

        $wallet = Wallet::where('user_id',$request->user_id)
                    ->select('user_id')
                    ->get()
                    ->transform(function($item,$key)use($request){
                        $wallet_amount = 0;
                        $item->bonus_amount = 0;
                        $item->prize_amount = 0;
                        $item->referral_amount = 0;
                        $item->deposit_amount = 0;
                        $item->is_account_verified = $this->isAccountVerified($request);
                        $item->refferal_friends_count = $this->getRefferalsCounts($request);
                        
                        $prize_amounts = Wallet::where('user_id',$item->user_id)->get();

                        foreach ($prize_amounts  as $key => $prize_amount) {
                            if($prize_amount->payment_type==1){
                                $item->bonus_amount   = $prize_amount->amount;

                            }
                            elseif($prize_amount->payment_type==4){
                                $wallet_amount = $wallet_amount+$prize_amount->amount;
                                $item->prize_amount   = $prize_amount->amount;
                            }
                            elseif($prize_amount->payment_type==2){
                                $wallet_amount = $wallet_amount+$prize_amount->amount;
                                $item->referral_amount = $prize_amount->amount;
                            }
                            elseif($prize_amount->payment_type==3){
                                $wallet_amount = $wallet_amount+$prize_amount->amount;
                                $item->deposit_amount = $prize_amount->amount;
                            }
                        }

                        $bank_account_verified = \DB::table('bank_accounts')
                                                ->where('user_id',$item->user_id)
                                                ->first();

                        $pancard =  \DB::table('verify_documents')
                                                ->where('user_id',$item->user_id)
                                                ->whereIn('doc_type',['pancard'])
                                                ->first();
                        $adharcard =  \DB::table('verify_documents')
                                                ->where('user_id',$item->user_id)
                                                ->whereIn('doc_type',['adharcard'])
                                                ->first();
                        $payment_status =   \DB::table('verify_documents')
                                                ->where('user_id',$item->user_id)
                                                ->where('doc_type','paytm')
                                                ->first(); 
                        if($payment_status){
                            $payment_status = $payment_status->status;
                        }else{
                            $payment_status = 0;
                        }                     

                        $doc_status = 0;                        
                        if($pancard && $adharcard){
                            if($pancard->status=2 || $adharcard->status==2){
                                $doc_status =2;
                            }
                        }elseif ($pancard) {
                           $doc_status =$pancard->status;
                        }
                        elseif ($adharcard) {
                           $doc_status =$adharcard->status;
                        }
                        if(isset($bank_account_verified) && $bank_account_verified->status)
                        {
                            $item->bank_account_verified = $bank_account_verified->status;

                        }else{
                            $item->bank_account_verified = 0;
                        }
                        
                        $item->document_verified = $doc_status;
                        $item->paytm_verified = $payment_status;
                        $item->wallet_amount = sprintf('%0.2f', $wallet_amount);
                        $withdrawal_amount = \DB::table('wallet_transactions')
                                            ->where('payment_type',5)
                                            ->sum('amount');

                        $item->withdrawal_amount = $withdrawal_amount;
                        return $item;
                    });

        return response()->json(
            [
                "status"=>true,
                "code"=>200,
                "walletInfo"=>$wallet[0]??$myArr
            ]
        );
    }

    private function getRefferalsCounts(Request $request){

        return \DB::table('referral_codes')
            ->where('refer_by',$request->user_id)
            ->count();

    }

    private function isAccountVerified(Request $request){
        /*
         Documents submitted status code
           1. EMAIL VERIFIED
           2. PAN OR ADHAR
           3. BANK ADDRESS
           4. PAYTM NO
         */
        $emailStatus = 0;
        $documentsStatus = 0;
        $addressProofStatus = 0;
        $paytmStatus = 0;

        $documentsTable = \DB::table('verify_documents')
            ->where('user_id',$request->user_id)
            ->get();
        if($documentsTable){
            foreach ($documentsTable as $key => $value) {
                // print_r($value);
                // die;
                $docType = $value->doc_type;
                if($docType == 'adharcard' OR $docType == 'pancard'){
                    if($value->status ==2){
                        $documentsStatus = 2;
                    }elseif($value->status ==1){
                        $documentsStatus = 1;
                    }elseif($value->status ==3){
                        $documentsStatus = 3;
                    }
                    else {
                        $documentsStatus = 0;
                    }
                }
                if($docType == 'paytm'){
                    $paytmStatus = 2;
                }
            }
        }

        $bankAccounts  = \DB::table('bank_accounts')
            ->where('user_id',$request->user_id)
            ->first();
        if($bankAccounts){
            if($bankAccounts->status ==1){
                $addressProofStatus = 2;
            }else {
                $addressProofStatus = 1;
            }
        }

        $data = array();
        $data['email_verified'] = $emailStatus;
        $data['documents_verified'] = $documentsStatus;
        $data['address_verified'] = $addressProofStatus;
        $data['paytm_verified'] = $paytmStatus;

        return $data;
    }
    // Add Money
    public function addMoney(Request $request){

        $myArr = [];
        $user = User::find($request->user_id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'deposit_amount' => 'required',
            'transaction_id' => 'required',
            'payment_mode' => 'required',
            'payment_status' => 'required'
        ]);


        // Return Error Message
        if ($validator->fails()) {
            $error_msg  =   [];
            foreach ( $validator->messages()->all() as $key => $value) {
                array_push($error_msg, $value);
            }

           return Response::json(array(
                    'code' => 201,
                    'status' => false,
                    'message' => $error_msg
                )
            );
        }

        Log::channel('payment_info')->info($request->all());

        if($user){
            $check_user = Hash::check($user->id,$user->validate_user);

            if($check_user){
                $wallet     = Wallet::where('user_id',$user->id)->where('payment_type',3)->first();
                
                $message    = "Amount not added successfully";
                $status     = false;
                $code       = 201;

                $msg = "$user->name has added amount $request->deposit_amount using INR $request->payment_mode";

                $helper = new Helper;
                $send_status = $helper->notifyToAdmin('Fund Deposit',$msg);
                
                if($wallet){
                    $deposit_amount = (float) $request->amount;
                }else{
                    $wallet =  new Wallet; 
                    $deposit_amount = (float) $request->amount;
                }

                if($wallet){ 
                    \DB::beginTransaction();

                    $data['method']     = 'deposit';
                    $data['user_id']    = $request->user_id;
                    $data['amount']     = $deposit_amount;
                    $data['content']    = json_encode($request->all());

                    \DB::table('payment_logs')->insert($data);

                    $wallet->amount         =  $wallet->amount+$request->deposit_amount;
                    $wallet->payment_type   =  3;
                    $wallet->user_id        =  $user->id;
                    $wallet->validate_user  =  Hash::make($user->id);
                    $wallet->deposit_amount = $wallet->amount;
                    $wallet->payment_type_string =  'Deposit';
                    
                    $wallet->save();

                    $myBlance = Wallet::where('user_id',$wallet->user_id)
                                ->whereIn('payment_type',[2,3,4])->sum('amount');

                    $myArr['wallet_amount']   = (float) $myBlance??0;
                    $myArr['user_id']         = (float)$wallet->user_id;

                    $transaction = new WalletTransaction;
                    $transaction->user_id        =  $request->user_id;
                    $transaction->amount         =  $request->deposit_amount;
                    $transaction->transaction_id =  $request->transaction_id??time();
                    $transaction->payment_mode   =  $request->payment_mode??'online';
                    $transaction->payment_status =  $request->payment_status??'pending';
                    $transaction->payment_details =  json_encode($request->all());
                    $transaction->payment_type =  3;
                    $transaction->payment_type_string =  'Deposit';
                    $transaction->save();

                    $message    = "Amount added successfully";
                    $status     = true;
                    $code       = 200;
                    \DB::commit();
                }
                return response()->json(
                    [
                        "status"=>$status,
                        "code"=>$code,
                        "message" =>$message,
                        "walletInfo"=>$myArr
                    ]
                );
            }else{
                return response()->json(
                    [
                        "status"=>false,
                        "code"=>201,
                        "message" => "user is not valid",
                        "walletInfo"=>$myArr
                    ]
                );
            }

        }else{
            return response()->json(
                [
                    "status"=>false,
                    "code"=>201,
                    "message" => "User is invalid",
                    "walletInfo"=>$myArr
                ]
            );
        }
    }

    public function WinningPrizeDistribution(Request $request)
    {  
        $match_id = $request->match_id;  
        $get_join_contest = JoinContest::where('match_id',  $match_id)
          ->get();
          
        $get_join_contest->transform(function ($item, $key)   {
            
            $ct = CreateTeam::where('match_id',$item->match_id)
                            ->where('user_id',$item->user_id)
                            ->where('id',$item->created_team_id)
                            ->first();
            
            $user = User::where('id',$item->user_id)->select('id','first_name','last_name','user_name','email','profile_image','validate_user','phone','device_id','name')->first();
             
            $team_id    =   $item->created_team_id;
            $match_id   =   $item->match_id;
            $user_id    =   $item->user_id;
            $rank       =   $item->ranks; 
            $team_name  =   $item->team_count;
            $points     =   $item->points;
            $contest_id =   $item->contest_id;

            $contest    =  CreateContest::with('contestType','defaultContest')
                              ->with(['prizeBreakup'=>function($q) use($rank,$points,$contest_id  )
                                {
                                  $q->where('rank_from','>=',$rank);
                                  $q->orwhere('rank_upto','<=',$rank)
                                  ->where('rank_from','>=',$rank); 
                                }
                              ]
                            )
                          ->where('match_id',$item->match_id)
                          ->where('id',$item->contest_id) 
                          ->where('is_cancelled',0) 
                          ->get() 
                          ->transform(function ($contestItem, $ckey) use($team_id,$match_id,$user_id,$rank,$team_name,$points, $contest_id,$item)  {
                            // check wether rank is repeated
                            
                            $rank_repeat = $this->checkReaptedRank($rank, $match_id,$contest_id);
                            //get average amount in case of repeated rank
                            $rank_amount = $this->getAmountPerRank($rank,$match_id,$contestItem->default_contest_id,$rank_repeat);
                              
                            $update_join_contest = JoinContest::find($item->id);
                            $update_join_contest->winning_amount = $rank?$rank_amount:0;
                            $update_join_contest->save();
                            return $contestItem;

                           }); 
        });
        
        return  ['winningAmount'=>'updated'];
    }
    public function prizeDistribution(Request $request)
    {  
        $match_id = $request->match_id;  
        $get_join_contest = JoinContest::where('match_id',  $match_id)
          ->where('winning_amount','>',0)  
          ->get();

        $get_join_contest->transform(function ($item, $key)   {
            
            $ct = CreateTeam::where('match_id',$item->match_id)
                            ->where('user_id',$item->user_id)
                            ->where('id',$item->created_team_id)
                            ->first();
            
            $user = User::where('id',$item->user_id)->select('id','first_name','last_name','user_name','email','profile_image','validate_user','phone','device_id','name')->first();
             
            $team_id    =   $item->created_team_id;
            $match_id   =   $item->match_id;
            $user_id    =   $item->user_id;
            $rank       =   $item->ranks; 
            $team_name  =   $item->team_count;
            $points     =   $item->points;
            $contest_id =   $item->contest_id;

           // $item->createdTeam = $ct;
            $item->user = $user;
            $item->team_id = $team_id;
            $item->match_id = $match_id;
            $item->user_id = $user_id;
            $item->rank = $rank;
            $item->team_name = $team_name;
            $item->createdTeam = $ct; 

            $contest = CreateContest::find($item->contest_id);

            if($item->contest==null){
            }else{
              //echo $rank.'-'.$match_id.'-'.$user_id.'-'.$team_id.'<br>';
            $prize_dist =  PrizeDistribution::updateOrCreate(
                          [
                            'match_id'        => $match_id,
                            'user_id'         => $user_id,
                            'created_team_id' => $team_id,
                            'team_name'       => $team_name,
                            'contest_id'       => $item->contest_id
                          ],
                          [
                            'points'          => $points,
                            'match_id'        => $match_id,
                            'user_id'         => $user_id,
                            'created_team_id' => $team_id,
                            'rank'            => $rank,
                            'contest_id'        => $item->contest_id,

                            'team_name'        => $item->team_name,
                            'user_name'        => $item->user->user_name,
                            'name'             => $item->user->first_name??$item->user->name,
                            'mobile'           => $item->user->phone,
                            'email'            => $item->user->email,
                            'device_id'        => $item->user->device_id,
                            'contest_name'     => $item->contest->contest_type??null,
                            'entry_fees'       => $item->contest->entry_fees,
                            'total_spots'      => $item->contest->total_spots,
                            'filled_spot'      => $item->contest->filled_spot,

                            'first_prize'        => $item->contest->first_prize,
                            'default_contest_id'=> $item->contest->default_contest_id,
 
                            'prize_amount'      => $item->winning_amount,
                            'contest_type_id'   => $item->contest->contest_type??null,
                            'captain'           => $item->createdTeam->captain,
                            'vice_captain'      => $item->createdTeam->vice_captain,
                            'trump'             => $item->createdTeam->trump,
                            'match_team_id'     => $item->createdTeam->team_id,
                            'user_teams'        => $item->createdTeam->teams

                          ]
                        ); 
            }
        });
         
        $prize_distributions = PrizeDistribution::where('match_id',$match_id)
            ->get();

        $match_id = $request->match_id;  
        $dist_status = $cid = \DB::table('matches')->where('match_id',$match_id)->first();
        
        if($dist_status && $dist_status->current_status==1){
            return  Redirect::to(route('match','prize=true'));
        }

        $puser = PrizeDistribution::where('match_id',$match_id)->pluck('user_id')->toArray();
        $device_id = User::whereIn('id',$puser)->pluck('device_id')->toArray();
        if(count($device_id)){
            $data = [
                'action' => 'notify' ,
                'title' => 'Prize is distributed for '.$cid->short_title,
                'message' => 'Check your wallets!'
            ];
            $this->sendNotification($device_id,$data);
            $data['entity_id'] = $match_id;
            $data['message_type'] = 'notify';
                
            \DB::table('user_notifications')->insert($data);
            
        }    
        $prize_distributions->transform(function($item,$key) use($match_id){
              $cid = \DB::table('matches')
                    ->where('match_id',$match_id)
                    ->first();

            //$subject = "You won prize for match - ".$cid->short_title??null;
            if($item->prize_amount > 0){

                $prize_amount = PrizeDistribution::where('match_id',$item->match_id)
                           ->where('user_id',$item->user_id)
                           ->where('contest_id',$item->contest_id)
                           ->where('created_team_id',$item->created_team_id)
                           ->where('team_name',$item->team_name)
                           ->sum('prize_amount');

                $wallet_amount_c =  Wallet::where(
                            [
                                'user_id'       => $item->user_id,
                                'payment_type'  => 4
                            ])->first();
                if($wallet_amount_c){
                  $prize_amount = $wallet_amount_c->amount+$prize_amount;
                }
                $wallets = Wallet::updateOrCreate(
                            [
                                'user_id'       => $item->user_id,
                                'payment_type'  => 4
                            ],
                            [
                                'user_id'       =>  $item->user_id,
                                'validate_user' =>  Hash::make($item->user_id),
                                'payment_type'  =>  4,
                                'payment_type_string' => 'prize',
                                'amount'        =>  $prize_amount,
                                'prize_amount'  =>  $prize_amount,
                                'prize_distributed_id' => $item->id
                            ]
                        );

                $walletsTransaction = WalletTransaction::updateOrCreate(
                            [
                                'user_id'               => $item->user_id,
                                'prize_distributed_id'  => $item->id
                            ],
                            [
                                'user_id'           =>  $item->user_id, 
                                'payment_type'      =>  4,
                                'payment_type_string' => 'prize',
                                'amount'            =>  $item->prize_amount,
                                'prize_distributed_id' => $item->id,
                                'payment_mode'      =>  'sportsfight',
                                'payment_details'   =>  json_encode($item),
                                'payment_status'    =>  'success',
                                'transaction_id'    =>  time().date('ymdhis').$item->user_id
                            ]
                        );

               
                $item->user_id = $item->user_id;
                $item->email = $item->email;
            }   
            return $item;
        });
         $match_id = $request->match_id; 
        \DB::table('matches')->where('match_id',$match_id)->update(['current_status'=>1]);
        return  Redirect::to(route('match','prize=true'));
    }
    public function checkReaptedRank($rank, $match_id,$contest_id){
        $rank = JoinContest::where('match_id',$match_id)
                            ->where('contest_id',$contest_id)
                            ->where('ranks',$rank)
                            ->count();
        return $rank; 
    }
    /**
    *@var match_id
    *@var contest_id
    *@var rank
    *Description get Amount as per Rank
    */
    public function getAmountPerRank($rank,$match_id=null,$contest_id=null,$repeat_rank=1)
    {   
        $rank_from = $rank; 
        $rank_to   =  $rank+($repeat_rank-1);
        $cid =  $contest_id; 
        
        $rank_id =0 ;// \DB::table('prize_breakups')->where('default_contest_id',$cid)->whereBetween('rank_upto',[$rank,$rank_to])->count();
        $amt = [];
        $count  =1;
        for($i=$rank_from; $i<=$rank_to; $i++){

            $sum_amt = \DB::table('prize_breakups')
                ->where('default_contest_id',$cid)
                ->where('rank_from','<=',$i)
                ->where('rank_upto','>=',$i)
                ->sum('prize_amount');
            if($sum_amt==0){
                $sum_amt = \DB::table('prize_breakups')
                ->where('default_contest_id',$cid)
                ->where('rank_from','=',$i)
                ->where('rank_upto','>=',1)
                ->sum('prize_amount');
            }
            $amt[] = $sum_amt;
        } 
        
        $prize_amount = array_sum($amt)/$repeat_rank;
        
        return $prize_amount;
        /*
        $rank_prize  = \DB::table('prize_breakups')
                        ->where(function($q) use ($rank,$cid,$rank_to){
                            $q->where('rank_upto','>=',$rank_to);
                            $q->where('rank_from','<=',$rank_to);
                            $q->where('default_contest_id',$cid);

                        })
                        ->orwhere(function($q) use ($rank_from,$rank_to,$cid){
                            $q->where('rank_from','>=',$rank_from);
                            $q->where('rank_from','<=',$rank_to);
                            $q->where('default_contest_id',$cid);
                        });
                       
                        if($rank_id==0){
                          $amt  =  $rank_prize->sum('prize_amount')??0;
                          $prizeBreakup = $amt/$repeat_rank;
                        }else{
                            $amt =  $rank_prize->sum('prize_amount')??0;
                            if($rank_to==8){
                                dd($amt);
                            }
                            $prizeBreakup = $amt/$repeat_rank;
                        }
           // $prizeBreakup=  $rank_prize->avg('prize_amount')??0;
        if($rank_prize){
            return $prizeBreakup;    
        }else{
            return $prizeBreakup=0;
        } */
    }
    /*getScore*/
    public function getScore(Request $request){

        //$this->updatePointsAndPlayerByMatchId($request);
        //$this->updateUserMatchPoints($request);
        //$this->prizeDistribution($request);

        $score = Matches::with(['teama' => function ($query) {
            $query->select('match_id', 'team_id', 'name','short_name','scores_full','scores','overs');
        }])->with(['teamb' => function ($query) {
                $query->select('match_id', 'team_id', 'name','short_name','scores_full','scores','overs');
            }])
            ->where('match_id',$request->match_id)
            ->select('match_id','title','short_title','status','status_str','result','status_note')
            ->first();
            $match_id = $request->match_id;
            $match_info = $this->setMatchStatusTime($match_id);
          //  dd($match_info);
            return response()->json(
            [
                'system_time'=>time(),
                'match_status' => $match_info['match_status']??null,
                'match_time' => $match_info['match_time']??null,
                "status"=>true,
                "code"=>200,
                "message" => "Match Score",
                "scores"=>$score
            ]
        );
    }


    public function cloneMyTeam(Request $request){

        $clone_team =   CreateTeam::where('id',$request->team_id)->where('user_id',$request->user_id)->first();
        
        $total_team = CreateTeam::where('match_id',$clone_team->match_id)
                            ->where('user_id',$request->user_id)
                            ->count();
        $total_team_count = "T".($total_team+1);
        
        $data = null;
        if($clone_team){
            $clone_team2  = new CreateTeam;

            $clone_team2->match_id      =   $clone_team->match_id;
            $clone_team2->user_id       =   $clone_team->user_id;
            $clone_team2->contest_id    =   $clone_team->contest_id;
            $clone_team2->team_id       =   $clone_team->team_id;
            $clone_team2->teams         =   $clone_team->teams;
            $clone_team2->captain       =   $clone_team->captain;
            $clone_team2->vice_captain  =   $clone_team->vice_captain;
            $clone_team2->trump         =   $clone_team->trump;

            $clone_team2->team_count    =   $total_team_count;
            $clone_team2->team_join_status =   $clone_team->team_join_status;
            $clone_team2->rank          =   $clone_team->rank;
            $clone_team2->edit_team_count =   $clone_team->edit_team_count;

            $clone_team2->save();

            $data = ['created_team_id'=> $clone_team2->id];
        }

        return response()->json(
            [
                "status"=>true,
                "code"=>200,
                "message" => "team created",
                "response"=>$data
            ]
        );
    }

    public function uploadImages(Request $request)
    {
        if ($request->file('imagefile')) {

            $photo = $request->file('imagefile');
            $destinationPath = storage_path('uploads');
            $photo->move($destinationPath, time().$photo->getClientOriginalName());
            $photo_name = time().$photo->getClientOriginalName();

            $data = [
                "success"=>"1",
                "msg"=>"Image uplaoded successfully",
                "imageurl"=>url('storage/uploads/'. $photo_name)
            ];

        }
        else
        {
            $data=array("successd"=>"0", "msg"=>"Image Type Not Right");
        }
        return $data;
    }


    public function createImage($base64,$userId=null,$documentsType)
    {   
        try{
            if($base64){
                $image = base64_decode($base64);
                $image_name= time().'.jpg';
                    
                if($documentsType=='profile'){
                    $path = storage_path() . "/image/profile/" . $image_name;
                    file_put_contents($path, $image); 
                    $url = url::to(asset('storage/image/profile/'.$image_name));
                    $user = User::find($userId);
                    if($user){
                        $user->profile_image = $url;
                        $user->save();
                    }

                    return $url;
                    
                }else{
                    $path = storage_path() ."/image/bank_docs/". date("Y-m-d")."/".$userId."/". $documentsType."/". $image_name;

                    file_put_contents($path, $image); 

                    return url::to(asset('storage/'."/image/bank_docs/". date("Y-m-d")."/".$userId."/". $documentsType."/". $image_name));
                }
                
            }else{
                
                return false; 
            }
 
            
        }catch(Exception $e){
            return false;
        }
        
    }


    public function uploadbase64Image(Request $request)
    {
        $userId = $request->get('user_id');
        $documentsType = $request->get('documents_type');
        $bin = base64_decode($request->get('image_bytes'));
        $im = imageCreateFromString($bin);
        if (!$im) {
            die('Base64 value is not a valid image');
            }

        $image_name= time().'.jpg';
        $storagePath = "";
        $internalPath = "";
        if(isset($userId) && isset($documentsType) && $documentsType!='profile'){
                $internalPath = "/image/bank_docs/". date("Y-m-d")."/".$userId."/". $documentsType."/";

                $storagePath = storage_path() .$internalPath ;
                
                if(!File::isDirectory($storagePath)){
                    File::makeDirectory($storagePath, 0777, true, true);
                }

                $url =  $this->createImage($request->get('image_bytes'),$userId,$documentsType);
        }else {
             $internalPath  = "/image/".$documentsType."/";
             $storagePath = storage_path() .  $internalPath;

            $url =  $this->createImage($request->get('image_bytes'),$userId,$documentsType);
        }
        //echo "storagePath".$storagePath;

        // $path = public_path('upload/itsolutionstuff.com');

        if(!File::isDirectory($storagePath)){
            File::makeDirectory($storagePath, 0777, true, true);
        }

        //dd('done');

        //$imagePath = $storagePath.$image_name;
        //echo "\nImage Path ".$imagePath;
       // imagepng($im, $imagePath, 0);
        $urls =$url; // url::to(asset("/storage".$internalPath.$image_name));
        return response()->json(
            [
                "status" =>true,
                'image_url'   => $urls,
                "message"=> "image uploaded successfully"
            ]
        );

    }

    public function sendNotification($token, $data){
     
        $serverLKey = 'AIzaSyAFIO8uE_q7vdcmymsxwmXf-olotQmOCgE';
        $fcmUrl = 'https://fcm.googleapis.com/fcm/send';

       $extraNotificationData = $data;

       if(is_array($token)){
            $fcmNotification = [
               'registration_ids' => $token, //multple token array
              // 'to' => $token, //single token
               //'notification' => $notification,
               'data' => $extraNotificationData
            ];
       }else{
            $fcmNotification = [
           //'registration_ids' => $tokenList, //multple token array
           'to' => $token, //single token
           //'notification' => $notification,
           'data' => $extraNotificationData
        ];
        }
       

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

    public function notifyToAdmin(){
        $user_email = [env('admin1_email','manoj.i.prasad@gmail.com'),env('admin2_email','kroy.aws@gmail.com')];

        $user = User::whereIn('email',$user_email)->get();
        foreach ($user as $key => $result) {
            $data = [
                'action' => 'notify' ,
                'title' => 'New documents uploaded' ,
                'message' => ''
            ];
            
            try{
               // $helpr = new Helper; 
                $this->sendNotification($result->device_id,$data);
            }catch(\ErrorException $e){
               // return false;
            }
            
        }
    }
    // Add Money
    public function saveDocuments(Request $request){

        $myArr = [];
        $user = User::find($request->user_id);

        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'documentType' => 'required'
        ]);

        // Return Error Message
        if ($validator->fails()) {
            $error_msg  =   [];
            foreach ( $validator->messages()->all() as $key => $value) {
                array_push($error_msg, $value);
            }

            return Response::json(array(
                    'code' => 201,
                    'status' => false,
                    'message' => $error_msg
                )
            );
        }

      //  Log::channel('document_info')->info($request->all());

        if($user){
            $documentType = $request->documentType;

            $helper = new Helper;

            $msg = "$user->name has uploaded $documentType";

            $helper->notifyToAdmin('🗎 Document uploaded 🗎',$msg);

            /*if($is_exist){
                    \DB::table('verify_documents')
                            ->where('user_id',$request->user_id)
                            ->where('doc_type','pancard')
                            ->update($data);
                } else{
                     \DB::table('verify_documents')->insert($data);
                }*/

            if($documentType=='pancard'){
                $data = array();
                $data['user_id'] = $request->user_id;
                $data['doc_type'] = $documentType;
                $data['doc_number'] = $request->panCardNumber;
                $data['doc_name'] = $request->panCardName;
                $data['doc_url_front'] = $request->pancardDocumentUrl;
                $data['status']  =1;
                \DB::table('verify_documents')->updateOrInsert(['user_id' => $request->user_id,'doc_type'=>$documentType],$data);
               
            }elseif($documentType=='adharcard'){
                $data = array();
                $data['user_id'] = $request->user_id;
                $data['doc_type'] = $documentType;
                $data['doc_number'] = $request->panCardNumber;
                $data['doc_name'] = $request->panCardName;
                $data['doc_url_front'] = $request->aadharCardDocumentUrlFront;
                $data['doc_url_back'] = $request->aadharCardDocumentUrlBack;
                $data['status']  =1;

                \DB::table('verify_documents')->updateOrInsert(['user_id' => $request->user_id,'doc_type'=>$documentType],$data);
               
            }elseif($documentType=='paytm'){
                $data = array();
                $data['user_id'] = $request->user_id;
                $data['doc_type'] = $documentType;
                $data['doc_number'] = $request->paytmNumber;
                $data['status']  =1;
                \DB::table('verify_documents')->updateOrInsert(['user_id' => $request->user_id,'doc_type'=>$documentType],$data);
                
            }else
                if($documentType=='passbook'){
                    $data = array();
                    $data['user_id'] = $request->user_id;
                    $data['bank_name'] = $request->bankName;
                    $data['account_name'] = $request->accountHolderName;
                    $data['account_number'] = $request->accountNumber;
                    $data['ifsc_code'] = $request->ifscCode;
                    $data['account_type'] = $request->accountType;
                    $data['bank_passbook_url'] = $request->bankPassbookUrl;
                    $data['status']  =1;
                    \DB::table('bank_accounts')->updateOrInsert(['user_id' => $request->user_id],$data);
                  
                }
            return response()->json(
                [
                    "status"=>true,
                    "code"=>200,
                    "message" => "Document updated successfully"
                ]
            );
        }else{
            return response()->json(
                [
                    "status"=>false,
                    "code"=>201,
                    "message" => "User is invalid"
                ]
            );
        }
    }


    public function updateProfile(Request $request){

        $myArr = [];
        $user = User::find($request->user_id);


        $validator = Validator::make($request->all(), [
            'user_id' => 'required',
            'city' => 'required',
            'dateOfBirth' => 'required',
            'email' => 'required',
            'gender' => 'required',
            'mobile_number' => 'required',
            'name' => 'required',
            'pinCode' => 'required',
            'state' => 'required'
        ]);


        // Return Error Message
        if ($validator->fails()) {
            $error_msg  =   [];
            foreach ( $validator->messages()->all() as $key => $value) {
                array_push($error_msg, $value);
            }

            return Response::json(array(
                    'code' => 201,
                    'status' => false,
                    'message' => $error_msg
                )
            );
        }

        Log::channel('update_profile')->info($request->all());

        if($user){
            $data = array();
            $data['user_id'] = $request->user_id;
            $data['city'] = $request->city;
            $data['dateOfBirth'] = $request->dateOfBirth;
            $data['gender'] = $request->gender;
            $data['pinCode'] = $request->pinCode;
            $data['state'] = $request->state;

            \DB::table('users')
                ->update($data)
                ->where('user_id',$request->user_id)
                ->where('email',$request->email);
            return response()->json(
                [
                    "status"=>true,
                    "code"=>200,
                    "message" => "Document updated successfully"
                ]
            );
        }else{
            return response()->json(
                [
                    "status"=>false,
                    "code"=>201,
                    "message" => "User is invalid"
                ]
            );
        }
    }
    /*Player sell percetages*/
    public function playerAnalytics(Request $request){

        $teams = $request->teams;
        if($teams){
            $data['match_id'] = $request->match_id;
            $data['created_team_id'] = $request->created_team_id;
            $data['captain'] = $request->captain;
            $data['vice_captain'] = $request->vice_captain;
            $data['trump'] = $request->trump;
            $data['user_id'] = $request->user_id;
            \DB::table('player_analytics')
                    ->where('created_team_id',$request->created_team_id)
                    ->where('user_id',$request->user_id)
                    ->delete();

            foreach ($teams as $key => $result) {
                $data['player_id'] = $result;
                
                \DB::table('player_analytics')
                        ->insert($data);
            }

            return ['Player details added'];
        }
    }

    /*getMyPlayedMatches*/

    public function getMyPlayedMatches(Request $request)
    {
         $join_contest =\DB::table('join_contests')->where('user_id',285)
                    ->get();
    }

    public function matchInfo($request, $method=null){
        $data['match_id']   = $request->match_id??null;
        $data['method']     = $method;
        $data['content']    = json_encode($request->all());

        \DB::table('match_contents')->insert($data);
    }

    /*captureScreenTime*/
    public function captureScreenTime(Request $request){
        $user_id = $request->user_id;
        $screen_name = $request->screen_name;

        $start_time = date('Y-m-d h:i:s');
        $end_time   = date('Y-m-d h:i:s');

        $data['user_id']        =  $user_id;
        $data['screen_name']    =  $screen_name??null;
        $data['start_time']     =  $start_time;

        $last_id = \DB::table('capture_screen_times')->insertGetId($data);
        
        $id =  \DB::table('capture_screen_times') //->where('id', '<=', $last_id)
            ->orderBy('id', 'desc')
            ->skip(1)
            ->take(1)
            ->first();
        if($id){
            \DB::table('capture_screen_times')
                    ->where('id',$id->id)
                    ->update(
                        [
                            'end_time'=>$end_time
                        ]
                    );    
        }    
        return response()->json(
                [
                    "status"=>true,
                    "code"=>200,
                    "message" => "Screen captured"
                ]
            );

    }
    /*Playing history*/
    public function getPlayingMatchHistory(Request $request){

        $user_id = $request->user_id;

        $user = User::where('id',$user_id)->get('id as user_id');
        $user->transform(function($item, $key){

            $join_contest = JoinContest::where('user_id',$item->user_id);
            $total_contest_joined = $join_contest->count();
            $total_unique_contest = $join_contest->groupBy('contest_id')->count();
            
            $total_match_played = JoinContest::where('user_id',$item->user_id)
                    ->select(\DB::raw('count(*)'))
                    ->groupBy('match_id')->get()->count();
            //->groupBy('created_team_id')
            $total_team =  JoinContest::where('user_id',$item->user_id)
                          //  ->select(\DB::raw('count(*)'))
                            ->get()->count();

            $total_match_win = $prize = \DB::table('prize_distributions')
                        ->where('user_id',$item->user_id)
                        ->where('prize_amount','>', 0)
                        ->groupBy('match_id')    
                        ->pluck('match_id')->count();

            $item->total_team_joined    = $total_team;   
            $item->total_match_played   = $total_match_played;
            $item->total_contest_joined = $total_contest_joined;
            $item->total_unique_contest = $total_unique_contest;
            $item->total_match_win = $total_match_win;
            return $item;  
        });  
        if(isset($user) && isset($user[0])){
             return response()->json(
                [
                    "status"=>true,
                    "code"=>200,
                    "message" => "Record Found",
                    "response" => $user[0]
                ]
            );
        } else{
            return response()->json(
                [
                    "status"=>false,
                    "code"=>201,
                    "message" => "No record found"
                ]
            );
        } 
    }

    public function verification(Request $request){    
        $user = User::find($request->user_id);

        if($user){
           $verify_documents =  \DB::table('verify_documents')->where('user_id',$user->id)->get();
           $bank_accounts =  \DB::table('bank_accounts')->where('user_id',$user->id)->first();
           
            foreach ($verify_documents as $key => $vd) {
                $s = "Pending";
                
                if($vd->status==1){
                    $s="Pending";
                }
                elseif($vd->status==2){
                    $s="Approved";
                }
                elseif($vd->status==3){
                    $s="Rejected";
                } 

                if($vd->doc_type=='paytm'){  
                    $status['paytm'][] = [
                    'status' =>  $vd->status, 
                    'message' => $s,
                    'data' => $vd
               ] ;

                }else{
                    $status['documents'][] = [
                    'status' =>  $vd->status,
                    'message' => $s,
                    'data' => $vd
               ] ;
                } 
            } 
            if(isset($bank_accounts)){
                
                if($bank_accounts->status==1){
                  $s = "Pending";  
                }
                elseif($bank_accounts->status==2){
                  $s = "Approved";  
                }
                elseif($bank_accounts->status==3){
                  $s = "Rejected";  
                }else{
                  $s = "Not uploaded";  
                }

                $status['bank_accounts'][] = [
                'status' =>  $bank_accounts->status,
                'message' => $s,
                'data' => $bank_accounts
           ] ;

            return response()->json(
                [
                    "status"=>true,
                    "code"=>200,
                    "message" => "verification status",
                    "response" => $status
                ]
            );

            } 
            
        }else{
            return response()->json(
                [
                    "status"=>false,
                    "code"=>201,
                    "message" => "Verification is pending"
                ]
            );
        }
    }
    /*
    Automate Create Contest
    contest will create as its full
    */
    public function automateCreateContest(){
        //return false;
        $contest = CreateContest::whereColumn('total_spots','filled_spot')
           // ->where('total_spots','>',50)
            ->where('is_cloned','!=',1)
            ->where('entry_fees','>',0)
            ->where('total_spots','!=',30)
            ->where('total_spots','!=',20)
           /* ->where('total_spots','>',20)
            ->where('total_spots','!=',3)
            
            ->where('total_spots','!=',2)*/
            ->get();
        //->where('entry_fees','>',0)
        $match_id = $contest->pluck('match_id')->toArray();
        $match = Matches::whereIn('match_id',$match_id)->where('status',1)->get(['match_id']);

        $match->transform(function($item,$key)use($contest){
            $contest_copy = $contest->where('match_id',$item->match_id)->first();

            $contest_copy->is_cloned = 1;
            $contest_copy->save();
            $contest_copy = $contest_copy->toArray();
            $contest_copy['filled_spot'] = 0;
            $contest_copy['is_cloned'] = 0;
            $contest_copy['is_full'] = 0;
            \DB::table('create_contests')->insert($contest_copy);
            $item->contest = $contest_copy;
            return $item;
        });
        return "Contest cloned";          

    }
    public  function getPlaying11()
    {   sleep(5);
        $matches = Matches::whereIn('status',[1,3])
                   ->whereDate('date_start',\Carbon\Carbon::today())
                    ->get(['match_id','timestamp_start','status']);
                
        foreach ($matches as $key => $match) {
            $match_id = $match->match_id;

            $t1 = $match->timestamp_start;
            $t2 = time();
            //time diff
            $td = round((($t1 - $t2)/60),2);
            $p11 = TeamASquad::where(
                        [
                            'match_id'=>$match_id
                        ]
                    )->where('playing11','true')->count();

            if($td>0 && $td<=60){
                if($p11){
                    $this->isLineUp($match_id);
                }
            }else{
                continue;
            }

            if($p11){
                if($match->status==1){
                    $match_obj = Matches::firstOrNew(
                        [
                            'match_id'=>$match_id
                        ]
                    );
                    if($match_obj->status==3){
                        continue;   
                    }

                    $match_obj->status =  3;
                    $match_obj->save();
                    continue;
                }
                continue;
            }
            # code...
            try{
                $token =  $this->token;
                $path = $this->cric_url.'matches/'.$match_id.'/squads/?token='.$token;

                $data = $this->getJsonFromLocal($path);
            }catch(\ErrorException $e){
                continue;
            }
            // update team a players
            $teama = $data->response->teama;
            if(isset($teama)){
                foreach ($teama->squads as $key => $squads) {
                    $teama_obj = TeamASquad::firstOrNew(
                        [
                            'team_id'=>$teama->team_id,
                            'player_id'=>$squads->player_id,
                            'match_id'=>$match_id
                        ]
                    );

                    $teama_obj->playing11 =  $squads->playing11;
                    $teama_obj->role =  $squads->role;
                    $teama_obj->save();
                }
            }   
                
            $teamb = $data->response->teamb;
            if(isset($teamb)){
                foreach ($teamb->squads as $key => $squads) {

                $teamb_obj = TeamBSquad::firstOrNew([
                    'team_id'=>$teamb->team_id,
                    'player_id'=>$squads->player_id,
                    'match_id'=>$match_id
                ]);

                $teamb_obj->playing11 =  $squads->playing11;
                $teamb_obj->role =  $squads->role;
                $teamb_obj->save();
                }   
            }
            
        }
        return ['playing11 updated'];
    }
    public function isLineUp($match_id=null){

        $matches = Matches::where('match_id',$match_id)
                   ->whereDate('date_start',\Carbon\Carbon::today())
                        ->get()
                        ->transform(function($item,$key){
                            
                            $t1 = $item->timestamp_start;
                            $t2 = time();
                            //time diff
                            $td = round((($t1 - $t2)/60),2);    

                           // dd($item->match_id);
                            $lineup = \DB::table('team_a_squads')->where('match_id',$item->match_id)
                                ->where('playing11',"true")->count();
                            
                            $device_id = User::whereNotNull('device_id')->pluck('device_id')->toArray();
                                                                  
                            if($td>0 && $td%5==0){
                                    $data = [
                                        'action' => 'notify' ,
                                        'title' => "🏏 $item->short_title  🕚 🏆🏆",
                                        'message' => 'Contest is filling fast. Create your team and join the contest. Hurry up!!'
                                    ];
                                    $this->sendNotification($device_id, $data);
                                
                            }
                            //&& $td%5==0
                            if($lineup || $td > 0 ){ 
                                $td = (int)$td;
                                if($td>30){
                                    $msg = "$td minute left. Create, Join or edit  your team";
                                }else{
                                    $msg = "Last $td minute left.Create, Join or edit  your team. Hurry Up!!";
                                }

                                $data = [
                                    'action' => 'notify' ,
                                    'title' => "🏏 $item->short_title  🕚 🏆🏆",
                                    'message' => $msg
                                ];
                               
                                $this->sendNotification($device_id, $data);
                                return $item; 
                            }    
                                    
                        }); 


        return 'Matches lined up';
    }
    /*Match auto cancel if not filled*/
    public function matchAutoCancel(){
        sleep(5);
        $cancel_match = Matches::where('status',3)
                       ->whereDate('date_start',\Carbon\Carbon::today())
                       ->get()
                        ->transform(function($item,$key){

                            $t1 = $item->timestamp_start;
                            $t2 = time();
                            //time diff
                            $td = round((($t1 - $t2)/60),2);    
                        if($td<=0){
                            $contests = CreateContest::where('match_id',$item->match_id)
                                        ->where('total_spots','>',0)
                                        ->where('is_cancelled',0)
                                        ->get()
                                        ->transform(function($item,$key){
                                           
                                    $total_winning_prize = $item->total_winning_prize;
                                    $total_amount_recvd = $item->filled_spot*$item->entry_fees;
                                   // dd($item->entry_fees);
                                    if($item->entry_fees!=0 && $total_winning_prize > $total_amount_recvd && $item->total_winning_prize!=0
                                        ){
                                        //&& $item->entry_fees!=5
                                        $match_id = $item->match_id;
                                        $contest_id = $item->id;
                                        $c =$this->cancelContest($match_id,$contest_id);
                                    }
                            });
                            $item->total_cancel = $contests->count();
                        }
                        return $item;
                    });
        $c = $cancel_match->first();
        if($c){
            return [$c->total_cancel??0 .' Contest is Cancelled successfully']; 
        }else{
            return ['No Contest Cancelled successfully']; 
        }
       
    }

    public function cancelContest($match_id=null,$contest_id=null){
         
        $request = new Request;
        
        if($match_id && $contest_id){
            $JoinContest = JoinContest::whereHas('user')->with('contest')
                        ->where('match_id',$match_id)
                        ->where('contest_id',$contest_id)
                        ->get()
                        ->transform(function($item,$key){
                        $cancel_contest = CreateContest::find($item->contest_id);
                       
                        if($item->cancel_contest==0){
                            \DB::beginTransaction();  
                            $cancel_contest->is_cancelled = 1;
                            $cancel_contest->save();

                            if(isset($item->contest) && $item->contest->entry_fees){
                                
                                $transaction_id = $item->match_id.$item->contest_id.$item->created_team_id.'-'.$item->user_id;

                                $wt =    WalletTransaction::firstOrNew(
                                        [
                                           'user_id' => $item->user_id,
                                           'transaction_id' => $transaction_id
                                        ]
                                    );
                                $wt->user_id            = $item->user_id;   
                                $wt->amount             = $item->contest->entry_fees;  
                                $wt->payment_type       = 7;  
                                $wt->payment_type_string = "Refunded";
                                $wt->transaction_id     = $transaction_id;
                                $wt->payment_mode       = 'Sportsfight';    
                                $wt->payment_status     = "success";
                                $wt->debit_credit_status = "+";   
                                $wt->save();


                                $wallet = Wallet::firstOrNew(
                                        [
                                           'user_id' => $item->user_id,
                                           'payment_type' => 4
                                        ]
                                    );

                                $wallet->user_id        =  $item->user_id;
                                $wallet->amount = $wallet->amount+$item->contest->entry_fees;
                                $wallet->deposit_amount = $wallet->amount+$item->contest->entry_fees;
                                $wallet->save();
                            }

                            \DB::commit();  

                            $item->cancel_message = 'Contest Cancelled' ;
                            return $item;
                        }else{
                            $item->cancel_message = 'Already Cancelled' ; 
                            return $item; 
                        }
                    });               
        
        if($JoinContest->count()==0 and $contest_id){
           
          //  foreach ($request->cancel_contest as $key => $value) {
                $cancel_contest = CreateContest::find($contest_id);
                $cancel_contest->is_cancelled = 1;
                $cancel_contest->save();
          //  }

           return  ['Selected contest is cancelled'];

        }

        
        $match      = Matches::where('match_id',$match_id)->first();
        $contest    = CreateContest::find($contest_id);

        $join_contest_user = JoinContest::where('match_id',$match_id)
                            ->where('contest_id',$contest_id)
                            ->where('cancel_contest',0)
                            ->pluck('user_id')
                            ->toArray();
                           
        $device_id  = User::whereIn('id',$join_contest_user)
                        ->pluck('device_id')
                        ->toArray();

        $data = [
                    'action' => 'notify' ,
                    'title' => "Contest Cancel | $match->short_title" ,
                    'message' => $match->short_title. " Contest of  $contest->entry_fees Rupess entry is cancelled"
                ];
                
        $this->sendNotification($device_id, $data);

        $JoinContest = JoinContest::where('match_id',$match_id)
                        ->where('contest_id',$contest_id)
                        ->get()
                        ->transform(function($item,$key){

                            $cancel_contest = JoinContest::find($item->id);
                            $cancel_contest->cancel_contest=1;
                            $cancel_contest->save(); 
                        });

        return [$JoinContest->count() . ' Contest Cancelled successfully'];
        }else{
            return ['No Contest selected for cancellation']; 
        }
    }
    /*
    withdraw_status = 0 Pending
    withdraw_status = 1 Requested
    withdraw_status = 2 In progress
    withdraw_status = 3 Success
    withdraw_status = 4 Rejected
    */
    public function withdrawAmount(Request $request){

        $user = $request->user_id;

        $verify_documents = \DB::table('verify_documents')
                ->where('user_id',$user)
                ->where('status',2)
                ->count();

        if($verify_documents && $verify_documents<2){
            $msg = "Document approval pending";
            return response()->json(
                [
                    "status"=>false,
                    "code"=>201,
                    "message" => $msg 
                ]
                );
        }

        $user = User::find($request->user_id);
        if($user && $request->withdraw_amount){
            
            $withdraw_amount = $request->withdraw_amount;
            $wallet = Wallet::where('user_id',$user->id)
                            ->whereIn('payment_type',[2,3,4])
                            ->get();
                            
            $referral   = $wallet->where('payment_type',2)->first()->amount??0;
            //$deposit    = $wallet->where('payment_type',3)->first()->amount??0;
            $prize      = $wallet->where('payment_type',4)->first()->amount??0;
           
            $access = false;

            if($withdraw_amount<200){
                return response()->json(
                [
                    "status"=>false,
                    "code"=>201,
                    "message" => "Minimum withdrawal amount 200 INR" 
                ]
                );
            }

            if($prize>=200 && $prize >= $withdraw_amount){
                
                $amt  = $prize-$withdraw_amount;
                $prize = $wallet->where('payment_type',4)->first();
                $tota_balance = $prize->amount;
                $prize->amount = $amt;
                $access = true;

            }elseif ($referral>=200 && $referral >= $withdraw_amount){
                
                $amt    = $referral-$withdraw_amount;
                $prize  = $wallet->where('payment_type',2)->first();
                $tota_balance = $prize->amount;
                $prize->amount = $amt;
                $access = true;

            }else{
                return response()->json(
                [
                    "status"=>false,
                    "code"=>201,
                    "message" => "You don't have sufficient balance to withdraw"
                ]
                );
            } 

            if($access){
                if($prize){
                    $prize->total_withdrawal_amount = $withdraw_amount;
                }

                \DB::beginTransaction();
                $prize->save();
                $wdl = Wallet::firstOrNew([
                        'user_id' => $user->id,
                        'payment_type' => 5
                    ]);
                $wdl->payment_type_string = 'withdraw';
                $wdl->validate_user = Hash::make($user->id);
                
                $wdl->amount = $wdl->amount+$withdraw_amount;
                $wdl->save();

                $wt = new WalletTransaction;
                $wt->amount = $withdraw_amount;
                $wt->user_id = $user->id;
                $wt->payment_type = 5;
                $wt->payment_type_string = 'withdraw';
                $wt->payment_mode = 'sf';
                $wt->payment_details = json_encode($request->all());
                $wt->payment_status  = 'request';
                $wt->transaction_id = time().'WDL'.$user->id;
                $wt->withdraw_status = 1;
                $wt->payment_status = 'Pending';
                $wt->debit_credit_status = "-";
                $wt->save();
                \DB::commit();
            }

            $msg = "Hi Admin, $user->name has requested withdrawal amount $withdraw_amount. His total balance is $tota_balance";
            $helper = new Helper;
            $helper->notifyToAdmin('₹ Withdrawal Request ₹',$msg);

            return response()->json(
                [
                    "status"=>true,
                    "code"=>200,
                    "message" => "Withdraw request submitted successfully!"
                ]
            );

        }else{
            return response()->json(
                [
                    "status"=>false,
                    "code"=>201,
                    "message" => "Withdrawal amount can't be null"
                ]
            );
        }
    }
}