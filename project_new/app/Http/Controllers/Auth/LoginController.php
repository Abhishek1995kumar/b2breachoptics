<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Http\Controllers\Auth\PermissionSetController;
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
    
    use PermissionSetController;

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

                $data = $this->loginPermission($user);
                
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
