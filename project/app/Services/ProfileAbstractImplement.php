<?php

namespace App\Services;


use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Hash;
use App\UserProfile;

class ProfileAbstractImplement extends ProfileAbstarct {

    final public function generateOTP(Request $request){
        $user = UserProfile::where('email',$request->email)->first();
        $otp = mt_rand(1000,9999);
        $user->otp = $otp;
        $user->save();
        
        $Msg= 'Thank you for registering with us. Your verification code is '.$otp.' ELRICA';
         
        $response = $this->sendMessage($user->email,$Msg);
    }

    final public function userProfileLogin($user, $password, $request)
    {
        $redirectRoute              = route('verifyOTP');
        $redirectRouteForCheckout   = route('verifyOTPWithCheckout');
        
        if(!empty($request->checkout) && $request->checkout == 'true'){
            $redirectRoute = route('verifyOTPWithCheckout');
        }

        if ( (!empty($user) && !empty($user->email)) &&  (Hash::check($password, $user->password))  ){
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
            return $hide_email;
        }

        if ($user != $request->email) 
        {
            return response()->json(['status'=>'email', 'msg'=>'The Username Or Password You Entered Is Incorrect.']);
        }
    }

}