<?php

namespace App\Services;

use Illuminate\Http\Request;
use DB;
use Mail;

abstract class ProfileAbstarct {

    abstract public function userProfileLogin($data, $password, $request);
    
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
}