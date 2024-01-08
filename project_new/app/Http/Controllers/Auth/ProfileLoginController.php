<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
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


    // public function otpintegrate()
    // {
    //     return view('submitotp');
    // }


    public function sendMessage($email, $Msg){
       
        if($email != '')
        {
            
          $result_email =  DB::table('user_profiles')->where('email' ,"=", $email);
           
          $email_count = $result_email->count();
          if($email_count > 0)
          {
            $data['email'] = $email;
            $data['msg'] = $Msg;
        
                Mail::send('otp', $data, function ($message) use ($email){
                    $message->to($email);
                    $message->subject('OTP VERIFICATION CODE');
                });
                return redirect(route('user.login'));
          }
          else{
            Session::flash('error','Please Enter Correct Email Id...');
            return redirect(route('user.forgotpass'));
          }
        }
        // $Password='Goodday@1';
        // $SenderID='ELRICA';
        // $UserID='elricaglobal';
        
        // $Password       ='elricanet';
        // // print_r($Password);die();
        // $SenderID       ='ELRICA';
        // $UserID         ='elricanet';
        // $YourAuthKey    = '92ZHPxzLHambU';
        // $TemplateID='1707162192375363078';
        // $EntityID='1701161735338698800';
        // $ch='';
        // $url = 'http://nimbusit.net/api/pushsms?user='.$UserID.'&authkey='.$YourAuthKey.'&sender='.$SenderID.'&mobile='.$Phno.'&text='.urlencode($Msg).'&entityid='.$EntityID.'&templateid='.$TemplateID;
        // // $url='http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID='.$UserID.'&Password='.$Password.'&SenderID='.$SenderID.'&Phno='.$Phno.'&Msg='.urlencode($Msg).'&EntityID='.$EntityID.'&TemplateID='.$TemplateID;
        // $ch = curl_init($url);
        // curl_setopt($ch,CURLOPT_URL,$url);
        // curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);

        // $output=curl_exec($ch);
        // curl_close($ch);
        // return $output;
    }
           

    public function generateOTP(Request $request){
        $user = UserProfile::where('email',$request->email)->first();
        $otp = mt_rand(1000,9999);
        $user->otp = $otp;
        $user->save();
        
        $Msg= 'Thank you for registering with us. Your verification code is '.$otp.' ELRICA';
         
        $response = $this->sendMessage($user->email,$Msg);
        // echo json_encode(['status'=>'success']);
    }
    // $user = UserProfile::where('email',$request->email)->first(); 
    //http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID=elricaglobal&Password=fkei2983FK&SenderID=ELRICA&Phno=9819790406&Msg=Thank%20you%20for%20registering%20with%20us.%20Your%20verification%20code%20is%2012%20ELRICA&EntityID=1701161735338698800&TemplateID=1707162192375363078
    
    //http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID=#USSERID#&Password=#Password#&SenderID=#SENDERID#&Phno=#PHONE#&Msg=#MSG#&EntityID=#EntityID#&TemplateID=#TEMPLATEID#
    // Auth::guard('profile')->attempt(['email' => $request->email,'password' => $request->password], false)


    /*NIK*/
    public function login(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die();
        session()->forget('verifyProfileId');
        session()->forget('verifyVendorId');
            
        $user                       = UserProfile::where('email',$request->email)->first();
        $password                   = $request->password;
        $redirectRoute              = route('verifyOTP');
        $redirectRouteForCheckout   = route('verifyOTPWithCheckout');
        
      
        if(!empty($request->checkout) && $request->checkout == 'true'){
              
            $redirectRoute = route('verifyOTPWithCheckout');
        }
       
        if ( (!empty($user) && !empty($user->email)) &&  (Hash::check($password, $user->password))  ){
            /*if(auth()->user()->otp != $request->otp){
                Auth::logout();
            }*/
        
            if ($user->status == '0') {
                return response()->json(['status'=>'not_approve', 'msg'=>'Your Account Is Not Approve..']);
            }
            if ($user->status == '2') {
                return response()->json(['status'=>'not_active', 'msg'=>'Your Account Is Not Active..']);
            }
            
            session(['verifyProfileId'=>$user->id]);
            $this->generateOTP($request);
            $user->login_token = str_random(32);
            $user->save();
            
            if($user->logindetailsstatus=="Eyevam")
            {
                $this->updateErpCiToken(['token' => $user->login_token, 'ci_id' => $user->ci_id]);
            }
           
            if($user->logindetailsstatus=="Joshua")
            {
                $this->updatejoshCiToken(['token' => $user->login_token, 'ci_id' => $user->ci_id]);
            }
          
            $hide_email = $user->email;
            return response()->json(['status'=>'otp', 'msg'=>'The OTP  Password Was Sent To The Following Recipient ..'.$hide_email ,'data'=>$hide_email]);
        }
    // print_r("testing2");die();
        if ($user != $request->email) 
        {
            return response()->json(['status'=>'email', 'msg'=>'The Username Or Password You Entered Is Incorrect.']);
        }
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


    public function updateErpCiToken($data)
    {
        if(!empty($data) && !empty($data['ci_id']) && !empty($data['token']))
        {
            $data['secret'] = '#$#DFF#$##$#';
            $api_url = "https://eyevam.in/api/updateLaravelLoginToken";
            $client = curl_init($api_url);
            curl_setopt($client, CURLOPT_POST, true);
            curl_setopt($client, CURLOPT_POSTFIELDS, $data);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);
        
            curl_close($client);
            
            $response = json_decode($response, true);
        }
    }
    
    public function updatejoshCiToken($data)
    {
        if(!empty($data) && !empty($data['ci_id']) && !empty($data['token']))
        {
            $data['secret'] = '#$#DFF#$##$#';
            $api_url = "https://joshuainternational.in/api/updateLaravelLoginToken";
            $client = curl_init($api_url);
            curl_setopt($client, CURLOPT_POST, true);
            curl_setopt($client, CURLOPT_POSTFIELDS, $data);
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);
        
            curl_close($client);
            
            $response = json_decode($response, true);
        }
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
