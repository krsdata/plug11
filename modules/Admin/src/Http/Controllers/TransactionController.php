<?php
namespace Modules\Admin\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests;
use Illuminate\Http\Request;
use Modules\Admin\Http\Requests\ProductRequest;
use Modules\Admin\Models\User;
use Modules\Admin\Models\Category;
use Modules\Admin\Models\Product;
use Modules\Admin\Models\Transaction;
use Input;
use Validator;
use Auth;
use Paginate;
use Grids;
use HTML;
use Form;
use Hash;
use View;
use URL;
use Lang;
use Session;
use Route;
use Crypt;
use App\Http\Controllers\Controller;
use Illuminate\Http\Dispatcher; 
use Modules\Admin\Helpers\Helper as Helper; 
use App\Helpers\FCMHelper;
use Response;
use App\Models\Wallet;
use App\Models\WalletTransaction;

/**
 * Class AdminController
 */
class TransactionController extends Controller {
    /**
     * @var  Repository
     */

    /**
     * Displays all admin.
     *
     * @return \Illuminate\View\View
     */
     public function __construct()
    {
        $this->middleware('admin');
        View::share('viewPage', 'transaction');
        View::share('sub_page_title', 'Document');
        View::share('helper', new Helper);
        View::share('heading', 'Withdraw Request');
        View::share('route_url', route('transaction'));
        $this->record_per_page = Config::get('app.record_per_page');
    }
    protected $categories;

    /*
     * Dashboard
     * */

    public function index(WalletTransaction $transaction, Request $request) 
    { 

        $page_title = 'Payment Withdraw';
        $page_action = 'View Transaction'; 
        $msg = null;
        
        $search = Input::get('search'); 
        $user = User::where('email','LIKE',"%$search%")
                            ->orWhere('name','LIKE',"%$search%")
                            ->get('id')->pluck('id');
       // dd($user);
        if ((isset($search) && !empty($search))) { 
               
            $transaction = $transaction->where(function ($query) use ($search,$user) {
                if (!empty($search) && !empty($user)) {
                   $query->whereIn('user_id', $user);
                }
            })
            ->where('withdraw_status',1)
            ->select("*",
                        \DB::raw('(CASE 
                        WHEN withdraw_status = 1 THEN "New Request"
                        WHEN withdraw_status = 2 THEN "Initiated"
                        WHEN withdraw_status = 3 THEN "Payment Hold"
                        WHEN withdraw_status = 4 THEN "Payment Rejected"
                        WHEN withdraw_status = 5 THEN "Payment Released"
                        ELSE "New Request" 
                        END) AS withdraw_status'))
            ->orderBy('id','desc')->Paginate($this->record_per_page);
            $transaction->transform(function($item, $Key){
                            $item->withdraw_amount = WalletTransaction::where('withdraw_status',1)
                                ->where('payment_type',5)
                                ->where('user_id',$item->user_id)
                                ->sum('amount');

                            $item->total_balance = round(Wallet::whereIn('payment_type',[2,4])
                                ->where('user_id',$item->user_id)
                                ->sum('amount'),2);

                            $user = User::find($item->user_id);
                            
                            if($user){
                                $item->name     =  $user->name;    
                                $item->email    =  $user->email;
                                $item->user_id    =  $user->id;      
                            }else{
                                $item->name     =  "";    
                                $item->email    =  "";
                                $item->user_id    =  "";
                            }
                            return $item;    
                        });

                        
        } else {   

            $transaction = WalletTransaction::where('payment_type',5)
                        ->orderBy('id','desc')
                        ->select("*",
                        \DB::raw('(CASE 
                        WHEN withdraw_status = 1 THEN "New Request"
                        WHEN withdraw_status = 2 THEN "Initiated"
                        WHEN withdraw_status = 3 THEN "Payment Hold"
                        WHEN withdraw_status = 4 THEN "Payment Rejected"
                        WHEN withdraw_status = 5 THEN "Payment Released"
                        ELSE "New Request" 
                        END) AS withdraw_status'))->Paginate($this->record_per_page);
                        
                        $transaction->transform(function($item, $Key){
                            $item->withdraw_amount = WalletTransaction::where('withdraw_status',1)
                                ->where('payment_type',5)
                                ->where('user_id',$item->user_id)
                                ->sum('amount');

                            $item->total_balance = round(Wallet::whereIn('payment_type',[2,4])
                                ->where('user_id',$item->user_id)
                                ->sum('amount'),2);

                            $user = User::find($item->user_id);
                            
                            if($user){
                                $item->name     =  $user->name;    
                                $item->email    =  $user->email;
                                $item->user_id    =  $user->id;      
                            }else{
                                $item->name     =  "";    
                                $item->email    =  "";
                                $item->user_id    =  "";
                            }
                            return $item;    
                        });

        }
        //return $transaction;
        return view('packages::payments.index', compact('transaction', 'page_title', 'page_action','msg'));
   
    }

    /*
     * create  method
     * */

    public function create(Transaction $product) 
    {
        $page_title = 'Transaction';
        $page_action = 'Create Transaction';
        $sub_category_name  = Product::all();
        $category   = Category::all();
        $cat = [];
        foreach ($category as $key => $value) {
             $cat[$value->category_name][$value->id] =  $value->sub_category_name;
        } 

         $categories =  Category::attr(['name' => 'product_category','class'=>'form-control form-cascade-control input-small'])
                        ->selected([1])
                        ->renderAsDropdown(); 
        return view('packages::product.create', compact('categories','cat','category','product','sub_category_name', 'page_title', 'page_action'));
     }

    /*
     * Save Group method
     * */

    public function store(Request $request, Transaction $transaction) 
    {
        $transaction = Transaction::find($request->payment_id);   
        
        if($transaction){
            $user     = User::find($transaction->user_id);
            $adminUser  = User::find(env('DEFAULT_USER_ID'));
          
            $registatoin_ids=array();

            $registatoin_ids[]= $user->notification_id;
            $registatoin_ids[]= $adminUser->notification_id;
            
            $type = "Android";
            $message["title"] = "Order is Ready ";
            $message["action"] = "notify";
            $message["message"] = "Your order id ".$transaction->order_id." is ready to download";
            $transaction->status = 5;
            $transaction->request_status = 2;
            $transaction->remarks = $request->remarks;
            $transaction->save();

            $fcmHelper = new FCMHelper;
            $fcmHelper->send_notification($registatoin_ids,$message,$type);
        }
        
        
        return Redirect::to(route('payments'))
                            ->with('flash_alert_notice', 'Payment Done');
    }
    /*
     * Edit Group method
     * @param 
     * object : $category
     * */

    public function edit(Transaction $transaction) {

        $page_title = 'Transaction';
        $page_action = 'Show Transaction'; 
        

        return view('packages::product.edit', compact( 'categories','product', 'page_title', 'page_action'));
    }

    public function update(ProductRequest $request, Transaction $transaction) 
    {
           
         
        return Redirect::to(route('transaction'))
                        ->with('flash_alert_notice', 'Transaction was  successfully updated !');
    }
    /*
     *Delete User
     * @param ID
     * 
     */
    public function destroy(Transaction $Transaction) {
        
        Transaction::where('id',$product->id)->delete();

        return Redirect::to(route('transaction'))
                        ->with('flash_alert_notice', 'Transaction was successfully deleted!');
    }

    public function show(Product $product) {
        
    }

}
