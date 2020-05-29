<?php
namespace Modules\Admin\Http\Controllers; 

use Modules\Admin\Http\Requests\LoginRequest;
use Modules\Admin\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ThrottlesLogins;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Illuminate\Http\Dispatcher; 
use Illuminate\Contracts\Encryption\DecryptException;
use App\Http\Requests\UserRequest;
use Auth,Input,Redirect,Response,Crypt,View,Session;
use Cookie,Closure,Hash,URL,Lang,Validator;
use App\Http\Requests;
use App\Helpers\Helper as Helper;
//use Modules\Admin\Models\User; 
use Modules\Admin\Models\Category;
use App\Models\Matches;
use App\Admin;
use Illuminate\Http\Request;
use App\User;
use App\Models\JoinContest;
use App\Models\CreateContest;
use App\Models\Competition;
use App\Models\Wallet;

/**
 * Class : AdminController
 */
class AdminController extends Controller { 
    /**
     * @var  Repository
     */ 
    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */ 
    protected $guard = 'admin';
    public function __construct()
    {  
        $this->middleware('admin');  
        View::share('heading','dashboard');
        View::share('route_url','admin');
        View::share('WebsiteTitle','Plug11');
    }
    public function keyFeature(Request $request){

        $page_title = "Key Feature";
        $page_action = "";

        //$match=Matches::with('joinContest')->whereRaw('Date(created_at) = CURDATE()-4')->paginate(6);

        $match=Matches::with('joinContest','create_contests','competition')->where('status',2)->paginate(6);
        $contest1=\DB::table('competitions')->get();
        $user1=\DB::table('users')->whereRaw('Date(created_at) = CURDATE()')->orderBy('created_at','desc')->paginate(10);

        $user2=\DB::table('users')->whereDate('created_at', '>=', date('2020-05-01'))->whereDate('created_at', '<=', date('2020-05-07'))->orderBy('created_at','desc')->paginate(10);

        $user3=\DB::table('users')->whereDate('created_at', '>=', date('2020-04-01'))->whereDate('created_at', '<=', date('2020-04-30'))->orderBy('created_at','desc')->paginate(10);

        $Total_dep=\DB::table('wallets')->whereRaw('Date(created_at) = CURDATE()')->SUM('deposit_amount');
        $Total_dep1=\DB::table('wallets')->whereDate('created_at', '>=', date('2020-05-01'))->whereDate('created_at', '<=', date('2020-05-07'))->SUM('deposit_amount');
        $Total_dep2=\DB::table('wallets')->whereDate('created_at', '>=', date('2020-04-01'))->whereDate('created_at', '<=', date('2020-04-30'))->SUM('deposit_amount');

        
        $Num_User=\DB::table('join_contests')->whereRaw('Date(created_at) = CURDATE()')->get();
        $Num_User1=\DB::table('join_contests')->whereRaw('Date(created_at) = CURDATE()-7')->get();
        $Num_User2=\DB::table('join_contests')->whereRaw('Date(created_at) = CURDATE()-30')->get();
        $Num_User3=\DB::table('join_contests')->whereRaw('Date(created_at) = CURDATE()-365')->get();

       
        //$match=Matches::whereDate('created_at', '=', date('Y-m-d'))->get();
    

        return view('packages::dashboard.keyFeature', compact('page_action','page_title','match','contest1','user1','user2','user3','Total_dep','Total_dep1','Total_dep2','Num_User','Num_User1','Num_User2','Num_User3'));


    }

     public function primarykpi(Request $request){

        $page_title = "Primary KPI";
        $page_action = "";

        return view('packages::dashboard.primarykpi', compact('page_action','page_title'));
    }

       public function secondarykpi(Request $request){

        $page_title = "Secondary KPI";
        $page_action = "";

        return view('packages::dashboard.secondarykpi', compact('page_action','page_title'));
    }

    /*
    * Dashboard
    **/
    public function index(Request $request) 
    { 
       // dd(Session::getId());
        $page_title = "";
        $page_action = "";
       
        $professor = User::where('role_type',1)->count();
         
        $user = User::count();
        $viewPage = "Admin";

        $users_count        =  User::count();
        $category_grp_count =  Category::where('parent_id',0)->count();
        $category_count     =  Category::where('parent_id','!=',0)->count();
        

        $match_1 = Matches::where('status',1)->count();
        $match_2 = Matches::where('status',2)->count();
        $match_3 = Matches::where('status',3)->count();
        $match = Matches::count();

        $contest_types = \DB::table('contest_types')->count();
        $banner = \DB::table('banners')->count();

        return view('packages::dashboard.index',compact('category_count','users_count','category_grp_count','page_title','page_action','viewPage','match_1','match_2','match_3','match','contest_types','banner'));
    }

   public function profile(Request $request,Admin $users)
   {
        $users = Admin::find(Auth::guard('admin')->user()->id);
        $page_title = "Profile";
        $page_action = "My Profile";
        $viewPage = "Admin";
        $method = $request->method();
        $msg = "";
        $error_msg = [];
        if($request->method()==='POST'){
            $messages = ['password.regex' => "Your password must contain 1 lower case character 1 upper case character one number"];

            $validator = Validator::make($request->all(), [
                'email' => 'required|email',
                'password' => 'min:6',
                'name' => 'required', 
        ]);
        /** Return Error Message **/
        if ($validator->fails()) {

            $error_msg  =   $validator->messages()->all(); 
           return view('packages::users.admin.index',compact('error_msg','method','users','page_title','page_action','viewPage'))->with('flash_alert_notice', $msg)->withInput($request->all());
        }
            $users->name= $request->get('name');
            $users->email= $request->get('email');
            if($request->get('password')!=null){
                $users->password=    Hash::make($request->get('password'));
            }
            $users->save();
            $method = $request->method();
            $msg = "Profile details successfully updated.";
        } 
       return view('packages::users.admin.index',compact('error_msg','method','users','page_title','page_action','viewPage'))->with('flash_alert_notice', $msg)->withInput($request->all());
       
     
   }
   public function errorPage()
   {
        $page_title = "Error";
        $page_action = "Error Page";
        $viewPage = "404 Error";
        $msg = "page not found";
        return view('packages::auth.page_not_found',compact('page_title','page_action','viewPage'))->with('flash_alert_notice', $msg);

   }  
}
