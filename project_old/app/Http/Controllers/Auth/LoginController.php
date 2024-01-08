<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Validators;
use App\User;
use Hash;
use DB;
use session;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }

    public function showLoginForm(){
        return view('admin.index');
    }
    
    public function login(Request $request){
        $this->validate($request, [
            'email' => 'required|email|exists:admin,email',
            'password' => 'required',
        ], [
            'email.exists' => 'This email doesn"t exist in records',
        ]);

        $userauth = DB::table('admin')->where('email', $request->email)->get()->first();
        if($userauth->status != 0){
            $data = $request->only('email', 'password');
            if( Auth::guard('web')->attempt($data)){
                $user = Auth::user()->role;
                if($user != '' && $user){
                    $perm_detail = DB::table('role_permissions as rp')
                                ->select('rp.*', 'rpl.*')
                                ->leftjoin('role_permissions_list as rpl', 'rp.id', 'rpl.rol_perm_id')
                                ->where('role_id', $user)
                                ->get();
                }

                if(isset($perm_detail)){
                    foreach($perm_detail[0] as $val => $key){
                        if(strpos($val, 'actions') !== false){
                            
                            $title = array();
                            if($val != '') $title = explode('_actions', $val);
                            else unset($title);
    
                            if($title[0] != '') {
                                $action[$title[0]] = ( ($key != '') ? explode(',',$key) :  '');
                            }
                        }
                    }
                }
                $session_data['role_actions'] = ( (!empty($action)) ? $action : '' );

                $session_data['manual_orders'] = ( (!empty($perm_detail[0]->manual_orders)) ? $perm_detail[0]->manual_orders : '' );
                $session_data['return_orders'] = ( (!empty($perm_detail[0]->return_orders)) ? $perm_detail[0]->return_orders : '' );
                $session_data['cancelled_orders'] = ( (!empty($perm_detail[0]->cancelled_orders)) ? $perm_detail[0]->cancelled_orders : '' );
                $session_data['products'] = ( (!empty($perm_detail[0]->products)) ? $perm_detail[0]->products : '' );
                $session_data['vendors'] = ( (!empty($perm_detail[0]->vendors)) ? $perm_detail[0]->vendors : '' );
                $session_data['customers'] = ( (!empty($perm_detail[0]->customers)) ? $perm_detail[0]->customers : '' );
                $session_data['manage_category'] = ( (!empty($perm_detail[0]->manage_category)) ? $perm_detail[0]->manage_category : '' );
                $session_data['blog'] = ( (!empty($perm_detail[0]->blog)) ? $perm_detail[0]->blog : '' );
                $session_data['slider_settings'] = ( (!empty($perm_detail[0]->slider_settings)) ? $perm_detail[0]->slider_settings : '' );
                $session_data['page_settings'] = ( (!empty($perm_detail[0]->page_settings)) ? $perm_detail[0]->page_settings : '' );
                $session_data['social_settings'] = ( (!empty($perm_detail[0]->social_settings)) ? $perm_detail[0]->social_settings : '' );
                $session_data['general_settings'] = ( (!empty($perm_detail[0]->general_settings)) ? $perm_detail[0]->general_settings : '' );
                $session_data['subscribers'] = ( (!empty($perm_detail[0]->subscribers)) ? $perm_detail[0]->subscribers : '' );
                $session_data['manage_roles'] = ( (!empty($perm_detail[0]->manage_roles)) ? $perm_detail[0]->manage_roles : '' );
                $session_data['payment_overview'] = ( (!empty($perm_detail[0]->payment_overview)) ? $perm_detail[0]->payment_overview : '' );
                $session_data['report'] = ( (!empty($perm_detail[0]->report)) ? $perm_detail[0]->report : '' );
                

                $id = Auth::user()->id;
                $username = Auth::user()->username;
                $email = Auth::user()->email;
                $role = Auth::user()->role;

                $data = array(
                    'id' => $id,
                    'username' => $username,
                    'email' => $email,
                    's_role' => 'r_'.$role,
                    'role_actions' =>$session_data['role_actions'],
                    'manual_orders' => $session_data['manual_orders'],
                    'return_orders' => $session_data['return_orders'],
                    'cancelled_orders' => $session_data['cancelled_orders'],
                    'products' => $session_data['products'],
                    'vendors' => $session_data['vendors'],
                    'customers' => $session_data['customers'],
                    'manage_category' => $session_data['manage_category'],
                    'blog' => $session_data['blog'],
                    'slider_settings' => $session_data['slider_settings'],
                    'page_settings' => $session_data['page_settings'],
                    'social_settings' => $session_data['social_settings'],
                    'general_settings' => $session_data['general_settings'],
                    'subscribers' => $session_data['subscribers'],
                    'manage_roles' => $session_data['manage_roles'],
                    'payment_overview' => $session_data['payment_overview'],
                    'report' => $session_data['report'],

                    'loggedin' => TRUE
                );

                $request->session()->put('role', $data);

                if($request->session()->get('role') != ""){
                    DB::table('admin')->where('email', $request->email)->update(['login_status' => 1]);
                }
                else{
                    DB::table('admin')->where('email', $request->email)->update(['login_status' => 0]);
                }
                
                return redirect()->route('admin.dashboard');
            }
            else{
                return redirect('admin')->with('error', 'incorrect password');
            }
        }
        else{
            return redirect('admin')->with('error', 'You are not autherised to login');
        }
    }

    public function logout(Request $request)
    {
        if(Auth::guard('profile')->check() || Auth::guard('vendor')->check()){
            $this->guard()->logout();
    
            $request->session()->invalidate();
    
            return redirect('homepage');
        }
        else{
            DB::table('admin')->where('id', Auth::user()->id)->update(['login_status'=>'0']);
            $this->guard()->logout();

            $request->session()->invalidate();

            return redirect('admin');
        }
    }
}
