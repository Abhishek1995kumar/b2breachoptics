<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Vendors;
use Illuminate\Support\Facades\Hash;
use DB;
use Mail;

class VendorLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:vendor');
    }

    public function showLoginFrom(){
        return view('vendorlogin');
    }

    public function sendMessage($email, $Msg)
    {
        // //$Password='Goodday@1';
        // //$SenderID='ELRICA';
        // //$UserID='elricaglobal';
        // $Password       ='elricanet';
        // $SenderID       ='ELRICA';
        // $UserID         ='elricanet';
        // $TemplateID     ='1707162192375363078';
        // $EntityID       ='1701161735338698800';
        // $YourAuthKey    = '92ZHPxzLHambU';
        // $ch='';
        // $url = 'http://nimbusit.net/api/pushsms?user='.$UserID.'&authkey='.$YourAuthKey.'&sender='.$SenderID.'&mobile='.$Phno.'&text='.urlencode($Msg).'&entityid='.$EntityID.'&templateid='.$TemplateID;
        // //$url='http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID='.$UserID.'&Password='.$Password.'&SenderID='.$SenderID.'&Phno='.$Phno.'&Msg='.urlencode($Msg).'&EntityID='.$EntityID.'&TemplateID='.$TemplateID;
        // $ch = curl_init($url);
        // curl_setopt($ch,CURLOPT_URL,$url);
        // curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
        // $output=curl_exec($ch);
        // curl_close($ch);
        // return $output;
        
        // Nik
        if($email != '')
        {
          $result_email =  DB::table('vendor_profiles')->where('email' ,"=", $email);
          $email_count = $result_email->count();
          if($email_count > 0)
          {
            $data['email'] = $email;
            $data['msg'] = $Msg;
                Mail::send('otp', $data, function ($message) use ($email){
                    $message->to($email);
                    $message->subject('OTP VERIFICATION CODE');
                });
                return redirect(route('vendor.login'));
          }
          else{
            Session::flash('error','Please Enter Correct Email Id...');
            return redirect(route('vendor.forgotpass'));
          }
        }
    }
           //http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID='.$UserID.'&Password='.$Password.'&SenderID='.$SenderID.'&Phno='.$Phno.'&Msg='.urlencode($Msg).'&EntityID='.$EntityID.'&TemplateID='.$TemplateID
            //http://nimbusit.biz/api/SmsApi/SendSingleApi?UserID=elricaglobal&Password=fkei2983FK&SenderID=ELRICA&Phno=9819790406&Msg=Thank youfor your order with ID ab. We will update you with the status soon.ELRICA&EntityID=1701161735338698800&TemplateID=1707162192372219523 

    public function generateOTP(Request $request)
    {
        // $user = Vendors::where('phone',$request->phone)->first();
        // $otp = mt_rand(1000,9999);
        // $user->otp = $otp;
        // $user->save();
        // $Msg= 'Thank you for registering with us. Your verification code is '.$otp.' ELRICA';
        // $response = $this->sendMessage($user->phone,$Msg);
        // echo json_encode(['status'=>'success']);
        
        // Nik
        $user = Vendors::where('email',$request->email)->first();
        $otp = mt_rand(1000,9999);
        $user->otp = $otp;
        $user->save();
        $Msg= 'Thank you for registering with us. Your verification code is '.$otp.' ELRICA';
        $response = $this->sendMessage($user->phone,$Msg);
    }

    // Nik
    public function login(Request $request)
    {
        $user                       = Vendors::where('email',$request->email)->first();
        $password                   = $request->password;
        

        if((!empty($user)) &&  (Hash::check($password, $user->password))  ){
            if ($user->status == '0') {
                return response()->json(['status'=>'not_approve', 'msg'=>'Your Account Is Not Approve..']);
            }
            else if ($user->status == '3') {
                return response()->json(['status'=>'not_active', 'msg'=>'Your Account Is Not Active..']);
            }
            else if ($user->status == '4') {
                return response()->json(['status'=>'deactive', 'msg'=>'Your Account Deactivated Please Contact to Autherized Person..']);
            }
            else {
                Auth::guard('vendor')->loginUsingId($user->id);
                return response()->json(['status'=>'otp', 'msg'=>'The Vendor Login Successfully.']);
            }
        }
        else
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
    }




}
