<?php

namespace App\Http\Controllers\Auth;


use App\Category;
use App\Http\Controllers\Controller;
use App\Profile;
use App\UserProfile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Country;
use App\State;
use App\City;
use DB;

class ProfileRegistrationController extends Controller
{

    protected $redirectTo = '/account';


    public function __construct()
    {
        $this->middleware('guest:profile');
    }


    public function showRegistrationForm()
    {
        $countries = Country::get(["Name", "id"]);
        return view('registeruser',compact('countries'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $this->validator($request->all())->validate();
        $base_path = explode("/", base_path());
        $base_path[count($base_path)-1] = 'assets';
        $base_path = implode("/", $base_path);
        $target_path = $base_path."/images/customer_document/";
       
        if($request->file('id_proof')){
            $file= $request->file('id_proof');
            $filename= random_int(111111, 999999).$file->getClientOriginalName();
            $_FILES['id_proof']['name'] = $filename;
            $file-> move($target_path."id_proof", $filename);
        }
        
        if($request->file('shop_act_lic')){
            $file= $request->file('shop_act_lic');
            $filename= random_int(111111, 999999).$file->getClientOriginalName();
            $_FILES['shop_act_lic']['name'] = $filename;
            $file-> move($target_path."shop_act_licence", $filename);
        }
        
        if($request->file('udyam_cert')){
            $file= $request->file('udyam_cert');
            $filename= random_int(111111, 999999).$file->getClientOriginalName();
            $_FILES['udyam_cert']['name'] = $filename;
            $file-> move($target_path."udyam_certificate", $filename);
        }
        if($request->file('aadhar_card')){
            $file= $request->file('aadhar_card');
            $filename= random_int(111111, 999999).$file->getClientOriginalName();
            $_FILES['aadhar_card']['name'] = $filename;
            $file-> move($target_path."aadhar_card", $filename);
        }
        event(new Registered($user = $this->create($request->all())));
        return response()->json(['status'=>'success', 'msg'=>'Registration Completed Successfully. You will Notify in Email when your Account is Active.']);
       
    }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('profile');
    }

    protected function registered(Request $request, $user)
    {
        //
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            // 'name' => 'required|regex:/^([A-Za-z]{3,16})([\s]{1})([ ]{0,1})([A-Za-z]{3,16})?([ ]{0,1})?([A-Za-z]{3,16})?([ ]{0,1})?([A-Za-z]{3,16})$/',
            'email' => 'required|email|max:255|unique:user_profiles',
            'phone' => 'required|regex:/^[0-9]{10}+$/',
            'password' => ['required', 
               'min:6', 
            //   'regex:/^(?=.[a-z])(?=.[A-Z])(?=.*\d)[a-zA-Z\d]{8,}$/', 
               'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return UserProfile::create([
            'name'              => $data['name'],
            'mname'             => $data['mname'],
            'lname'             =>$data['lname'],
            'phone'             => $data['phone'],
            'alternate_phone'   =>$data['alt_phone'],
            'email'             => $data['email'],
            'address'           => $data['address'],
            'address2'          =>$data['address2'],
            'country'           =>$data['country'],
            'state'             =>$data['state'],
            'city'              => $data['city'],
            'zip'               => $data['zip'],
            'bussiness_name'    =>$data['bussiness_name'],
            'bank_name'         =>$data['bank_name'],
            'acc_no'            =>$data['acc_no'],
            'ifsc_code'         =>$data['ifsc_code'],
            'password'          => Hash::make($data['password']),
            'status'            => '0',
            'gst_no'            => isset($data['gst_no']) ? $data['gst_no'] : 'NULL',
            'id_proof'          => $_FILES['id_proof']['name'],
            'shop_act_lic'      =>  $_FILES['shop_act_lic']['name'],
            'udyam_cert'        => isset($data['udyam_cert']) ?  $_FILES['udyam_cert']['name'] : 'NULL',
            'aadhar_card'       => isset($data['aadhar_card']) ?  $_FILES['aadhar_card']['name'] : 'NULL',
            
        ]);
    }
    
    public function fetchState(Request $request)
    {
        $data['states'] = State::where("CountryId", $request->country_id)
                                ->get(["Name", "id"]);
        return response()->json($data);
    }
    
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("StateId", $request->state_id)
                                    ->get(["Name", "id"]);                
        return response()->json($data);
    }
    
    public function Hidden_number(Request $request)
    {
        $phone = $_POST['phone'];
        return view('submitotp',compact('phone'));
    }
}