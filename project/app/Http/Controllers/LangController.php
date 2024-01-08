<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Request;
use App;
use Auth;
use App\Vendors;
use App\UserProfile;

class LangController extends Controller
{
    public function change(Request $request)
    {
        App::setLocale($request->lang);
        session()->put('locale', $request->lang);
        return redirect()->back();
    }

    // Nik
    public function checkOTP(Request $request, $guard = null)
    {
        $otp = $_POST['otp1']."".$_POST['otp2']."".$_POST['otp3']."".$_POST['otp4'];
        if(Auth::guard('profile')->check()){
        	$guard = "profile";
        }elseif (Auth::guard('vendor')->check()) {
        	$guard = "vendor";
        }else{
            if($request->isMethod('post') && ( !empty(session('verifyProfileId')) || !empty(session('verifyVendorId')) )) {
                if(!empty(session('verifyProfileId'))){
                    $id = session('verifyProfileId');
                    $user = UserProfile::where('id',$id)->where('otp',$otp)->first();
                    if(!empty($user)){
                        Auth::guard('profile')->loginUsingId($user->id);
                        $request->session()->forget('verifyProfileId');
                        return redirect('/home');
                    }else{
                        return back()->withErrors(['otp.required', 'OTP doesn\'t match']);
                    }
                }elseif(!empty(session('verifyVendorId'))) {
                    $id = session('verifyVendorId');
                    $user = Vendors::where('id',$id)->where('otp',$otp)->first();
                    if(!empty($user)){
                        Auth::guard('vendor')->loginUsingId($user->id);
                        $request->session()->forget('verifyVendorId');
                        return redirect(route('vendor.dashboard'));
                    }else{
                        return back()->withErrors(['otp.required', 'OTP doesn\'t match']);
                    }
                }
            }
            return back()->withErrors('You Are Not Log In');
        }
    }

    public function checkOTPWithCheckout(Request $request, $guard = null){
        if(Auth::guard('profile')->check()){
            $guard = "profile";
        }
        else{
            if ($request->isMethod('post') && ( !empty(session('verifyProfileId')) || !empty(session('verifyVendorId')) )) {
                if(!empty(session('verifyProfileId'))){
                    $id = session('verifyProfileId');
                    $user = UserProfile::where('id',$id)->where('otp',$request->otp)->first();
                    if(!empty($user)){
                        Auth::guard('profile')->loginUsingId($user->id);
                        $request->session()->forget('verifyProfileId');
                        return redirect('/checkout');
                    }else{
                        return back()->withErrors(['otp.required', 'OTP doesn\'t match']);
                    }
                }
            }
            return back()->withErrors('You Are Not Log In');
        }
    }
}
