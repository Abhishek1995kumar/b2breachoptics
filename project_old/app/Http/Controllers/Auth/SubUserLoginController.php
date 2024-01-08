<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\SubUserProfile;
use Illuminate\Support\Facades\Hash;
use DB;
class SubUserLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:subuser');
    }

    public function loginFrom(){
        return view('subuserlogin');
    }


    // public function otpintegrate()
    // {
    //     return view('submitotp');
    // }


    public function sendMessage($Phno, $Msg){
        $Password='Goodday@1';
        $SenderID='ELRICA';
        $UserID='elricaglobal';
        $TemplateID='1707162192375363078';
        $EntityID='1701161735338698800';
        $ch='';
        $url='http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID='.$UserID.'&Password='.$Password.'&SenderID='.$SenderID.'&Phno='.$Phno.'&Msg='.urlencode($Msg).'&EntityID='.$EntityID.'&TemplateID='.$TemplateID;
        $ch = curl_init($url);
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        $output=curl_exec($ch);
        curl_close($ch);
        return $output;
    }
           

    public function generateOTP(Request $request){
        $user = SubUserProfile::where('phone',$request->phone)->first();
        $otp = mt_rand(1000,9999);
        $user->otp = $otp;
        $user->save();
        $Msg= 'Thank you for registering with us. Your verification code is '.$otp.' ELRICA';
        $response = $this->sendMessage($user->phone,$Msg);
        // echo json_encode(['status'=>'success']);
    }
    // $user = UserProfile::where('email',$request->email)->first(); 
    //http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID=elricaglobal&Password=fkei2983FK&SenderID=ELRICA&Phno=9819790406&Msg=Thank%20you%20for%20registering%20with%20us.%20Your%20verification%20code%20is%2012%20ELRICA&EntityID=1701161735338698800&TemplateID=1707162192375363078
    
    //http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID=#USSERID#&Password=#Password#&SenderID=#SENDERID#&Phno=#PHONE#&Msg=#MSG#&EntityID=#EntityID#&TemplateID=#TEMPLATEID#
    // Auth::guard('profile')->attempt(['email' => $request->email,'password' => $request->password], false)


    public function sublogin(Request $request){
        $this->validate($request,[
            'phone' => 'required|numeric|digits:10',
            'password' => 'required'
            ]);
        $user = SubUserProfile::where('phone',$request->phone)->first();
        $password = $request->password;
        $redirectRoute = route('verifyOTP');
        $redirectRouteForCheckout = route('verifyOTPWithCheckout');
        if(!empty($request->checkout) && $request->checkout == 'true'){
            $redirectRoute = route('verifyOTPWithCheckout');
        }

        if ( (!empty($user) && !empty($user->phone)) &&  (Hash::check($password, $user->password))  ){
            /*if(auth()->user()->otp != $request->otp){
                Auth::logout();
            }*/
            session(['verifyProfileId'=>$user->id]);
            $this->generateOTP($request);
            return redirect()->intended($redirectRoute);
           
        }

        if ($user != $request->phone) {
           return redirect()->back()
                    ->with('error','Wrong Phone Number And Password...!');
        }
        //return redirect()->back()->withInput($request->only('email'));
        // return $this->sendFailedLoginResponse($request);
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




}
