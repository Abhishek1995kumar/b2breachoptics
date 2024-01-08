<?php

namespace App\Http\Controllers\Auth;

use App\Category;
use App\Http\Controllers\Controller;
use App\Profile;
use App\UserProfile;
use App\Vendors;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Country;
use App\State;
use App\City;
use DB;

class VendorRegistrationController extends Controller {

    protected $redirectTo = '/dashboard';


    public function __construct()  {
        $this->middleware('guest:vendor');
    }

    
    public function showRegistrationForm() {
        $countries = Country::get(["Name", "id"]);
        return view('registervendor',compact('countries'));
    }


    public function register(Request $request) {
        $input = $request->all();
        $files = $request->file('addressproof');
        
        $base_path = explode("/", base_path());
        $base_path[count($base_path)-1] = 'assets';
        $base_path = implode("/", $base_path);
        $target_path = $base_path."/images/vendor/addressproof";
      
        if($files) {
            $file= $request->file('addressproof');
            $filename= random_int(111111, 999999).$file->getClientOriginalName();
            $_FILES['addressproof']['name'] = $filename;
            $file-> move($target_path, $filename);
        }
        event(new Registered($user = $this->create($input)));
        return response()->json(['status'=>'success', 'msg'=>'Registration Completed Successfully. You will Notify in Email when your Account is Active.']);
    }


    protected function guard()
    {
        return Auth::guard('vendor');
    }

    protected function registered(Request $request, $user)
    {
        //
    }

    
    protected function validator(array $data) {
        return Validator::make($data, [
            'name' => ["required", "regex:/^[\w'\-,.][^0-9_!¡?÷?¿\\+=@#$%ˆ&*(){}|~<>;:[\]]{2,}$/"],
            'shop_name' => 'required',
            'addressproof' => 'mimes:jpeg,png,pdf|required|max:10000',
            'email' => ["required", "email", "max:70", "regex:/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/", "unique:vendor_profiles"],
            'phone' => 'required|regex:/^[0-9]{10}+$/',
            'password' => ['required', 'min:6', 'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/', 'confirmed'],
        ]);
    }
    

    protected function create(array $data) {
        return Vendors::create([
            'name'          =>  $data['name'],
            'phone'         =>  $data['phone'],
            'shop_name'     =>  $data['shop_name'],
            'mname'         =>  $data['mname'],
            'lname'         =>  $data['lname'],
            'areaandstreet' =>  $data['areaandstreet'],
            'landmark'      =>  $data['landmark'],
            'email'         =>  $data['email'],
            'password'      =>  Hash::make($data['password']),
            'address'       =>  $data['address'],
            'city'          =>  $data['city'],
            'state'         =>  $data['state'],
            'country'       =>  $data['country'],
            'zip'           =>  $data['zip'],
            'addressproof'  =>  $_FILES['addressproof']['name'],
        ]);
    }
    
    
    public function fetchState(Request $request) {
        $data['states'] = State::where("CountryId", $request->country_id)->get(["Name", "id"]);
        return response()->json($data);
    }
    
    
    public function fetchCity(Request $request) {
        $data['cities'] = City::where("StateId", $request->state_id)->get(["Name", "id"]);                
        return response()->json($data);
    }
}
