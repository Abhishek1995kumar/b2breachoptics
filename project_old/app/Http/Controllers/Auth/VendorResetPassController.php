<?php

namespace App\Http\Controllers\Auth;

use App\UserProfile;
use App\Vendors;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;
use Mail;
class VendorResetPassController extends Controller
{
    //Show Forgot Password Form
    public function showForgotForm()
    {
        return view('forgotvendor');
    }

    //Reset Users Profile Password
    public function resetPass(Request $request)
    {
        $user['email'] = $request->email;
        $email_id = $user['email'];
        if($email_id != '')
        {
           $result_email =  DB::table('vendor_profiles')->where('email' ,"=", $email_id);
           $email_count = $result_email->count();
           if($email_count > 0)
           {
            $data['email_id'] = $email_id;
            // print_r($data['email_id']);die();
                Mail::send('vendor_forgotpassword', $data, function ($message) use ($user){
                    $message->to($user['email']);
                    $message->subject('Password Reset');
                });
                Session::flash('success','Check Your Mail.');
                return redirect(route('vendor.login'));
           }
           else{
            Session::flash('error','Please Enter Correct Email Id...');
            return redirect(route('vendor.forgotpass'));
           }
        
        }
    }
        
        
        
        
        
        // Old Code
        // if (Vendors::where('email', '=', $request->email)->count() > 0) {
        //     // user found
        //     $user = Vendors::where('email', '=', $request->email)->firstOrFail();
        //     $autopass = str_random(8);
        //     $input['password'] = Hash::make($autopass);

        //     $user->update($input);
        //     $subject = "Reset Password Request";
        //     $msg = "Your New Password is : ".$autopass;

        //     mail($request->email,$subject,$msg);
        //     Session::flash('success', 'Your Password Reseted Successfully. Please Check your email for new Password.');
        //     return redirect(route('vendor.forgotpass'));

        // }else{
        //     // user not found
        //     Session::flash('error', 'No Account Found With This Email.');
        //     return redirect(route('vendor.forgotpass'));
        // }
        // }

    public function password_reset(Request $request)
    {
        $email_id = $_GET['email_id'];
        $result = DB::table('vendor_profiles')->where('email' ,"=", $email_id);
        $email_count = $result->count();
    
        if($email_count > 0)
        {
            $all_result = DB::select("SELECT phone FROM vendor_profiles WHERE email = '$email_id'");
            $phone = $all_result[0]->phone;
            return view('vendor_password_reset',compact('phone'));
        }else{
            return redirect(route('user.login'));
        }    
    }
    
    public function Password_set(Request $request)
    {
        $user_mobile   = $_POST['mobile'];
        $con_password = $_POST['confirm_pass'];
        $con_password = bcrypt($con_password);
    
        if($_POST['first_pass'] != $_POST['confirm_pass'])
        {
            return response()->json(['status'=>'Error', 'Msg' =>"Password Mismatch"]);
        }else{
            // DB::enableQueryLog();
            $password_reset =  DB::table('vendor_profiles')->where('phone', $user_mobile)->update(array('password' => $con_password)); 
            // print_r(DB::getQueryLog());
        
           if($password_reset == '')
           {
                print_r("hello");
           }else{
                return response()->json(['status'=>'success', 'Msg' =>"Password Reset Successfully"]);
           }
        }
    }


}
