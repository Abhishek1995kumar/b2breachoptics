<?php

namespace App\Http\Controllers\Auth;

use App\UserProfile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;
use Mail;
class ProfileResetPassController extends Controller
{
    //Show Forgot Password Form
    public function showForgotForm(){
        return view('forgotform');
    }

    //Reset Users Profile Password
    public function resetPass(Request $request)
    {
        //Nik Here
        $user['email'] = $request->email;
        $email_id = $user['email'];
          
        if($email_id != '')
        {
           $result_email =  DB::table('user_profiles')->where('email' ,"=", $email_id);
           $email_count = $result_email->count();
           if($email_count > 0)
           {
              
            $data['email_id'] = $email_id;
             
                Mail::send('forgotpassword', $data, function ($message) use ($user){
                    $message->to($user['email']);
                    $message->subject('Password Reset');
                });
                Session::flash('success','Check Your Mail.');
                return redirect(route('user.login'));
           }
           else{
            Session::flash('error','Please Enter Correct Email Id...');
            return redirect(route('user.forgotpass'));
           }
        }

        // if (UserProfile::where('email', '=', $request->email)->count() > 0) {
        //     // user found
        //     $user = UserProfile::where('email', '=', $request->email)->firstOrFail();
        //     $autopass = str_random(8);
        //     $input['password'] = Hash::make($autopass);

        //     $user->update($input);
        //     $subject = "Reset Password Request";
        //     $msg = "Your New Password is : ".$autopass;

        //     mail($request->email,$subject,$msg);
        //     Session::flash('success', 'Your Password Reseted Successfully. Please Check your email for new Password.');
        //     return redirect(route('user.forgotpass'));

        // }else{
        //     // user not found
        //     Session::flash('error', 'No Account Found With This Email.');
        //     return redirect(route('user.forgotpass'));
        // }
        
        
        //  $user['email'] = $request->email;
        // $email_id = $user['email'];
          
        // if($email_id != '')
        // {
        //   $result_email =  DB::table('user_profiles')->where('email' ,"=", $email_id);
        //   $email_count = $result_email->count();
        //   if($email_count > 0)
        //   {
              
        //     $data['email_id'] = $email_id;
             
        //         Mail::send('forgotpassword', $data, function ($message) use ($user){
        //             $message->to($user['email']);
        //             $message->subject('Password Reset');
        //         });
        //         Session::flash('success','Check Your Mail.');
        //         return redirect(route('user.login'));
        //   }
        //   else{
        //     Session::flash('error','Please Enter Correct Email Id...');
        //     return redirect(route('user.forgotpass'));
        //   }
        // }
        
    }

    public function password_reset(Request $request)
    {
        // print_r("hello");die();
        $email_id = $_GET['email_id'];
        $result = DB::table('user_profiles')->where('email' ,"=", $email_id);
        // print_r($result);die();
        $email_count = $result->count();
    
        if($email_count > 0)
        {
            $all_result = DB::select("SELECT * FROM user_profiles WHERE email = '$email_id'");
            
            $email = $all_result[0]->email;
            // print_r($email);die();
            return view('password_reset',compact('email'));
        }else{
            return redirect(route('user.login'));
        }    
    }
    
    public function test(Request $request)
    {
        $email   = $_POST['email'];
        $con_password = $_POST['confirm_pass'];
        $con_password = Hash::make($con_password);
    
        if($_POST['first_pass'] != $_POST['confirm_pass'])
        {
            return response()->json(['status'=>'Error', 'Msg' =>"Password Mismatch"]);
        }else{
            DB::enableQueryLog();
           $password_reset =  DB::table('user_profiles')->where('email', $email)->update(array('password' => $con_password)); 
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
