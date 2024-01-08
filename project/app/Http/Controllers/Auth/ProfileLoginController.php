<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Services\ProfileAbstractImplement;
use App\UserProfile;
use Illuminate\Support\Facades\Hash;
use DB;
use Mail;

class ProfileLoginController extends Controller
{

    public function __construct()
    {
        $this->middleware('guest:profile');
    }

    public function showLoginFrom(){
        return view('userlogin');
    }

    /*NIK*/
    public function login(ProfileAbstractImplement $profile, Request $request)
    {
        session()->forget('verifyProfileId');
        session()->forget('verifyVendorId');
            
        $user                       = UserProfile::where('email',$request->email)->first();
        $password                   = $request->password;
        
        $hide_email = $profile->userProfileLogin($user, $password, $request);

        return response()->json(['status'=>'otp', 'msg'=>'The OTP  Password Was Sent To The Following Recipient ..'.$hide_email ,'data'=>$hide_email]);
    }
    
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required', 'password' => 'required',
        ]);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        $errors = [$this->username() => trans('auth.failed')];

        if ($request->expectsJson()) {
            return response()->json($errors, 422);
        }

        return redirect()->back()
            ->withInput($request->only($this->username()))
            ->withErrors($errors);
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'phone';
        // return 'email';
    }
    
     public function updateopticalCiToken($data)
    {
        if(!empty($data) && !empty($data['ci_id']) && !empty($data['token']))
        {
            $data['secret'] = '#$#DFF#$##$#';
            $api_url = "https://erp.optical-hut.com/api/updateLaravelLoginToken";
            $client = curl_init($api_url);
            curl_setopt($client, CURLOPT_POST, true);
            curl_setopt($client, CURLOPT_POSTFIELDS, $data);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);
        
            curl_close($client);
            
            $response = json_decode($response, true);
        }
    }

}
