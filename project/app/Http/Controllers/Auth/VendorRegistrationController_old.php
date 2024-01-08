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

class VendorRegistrationController extends Controller
{

    protected $redirectTo = '/dashboard';


    public function __construct()
    {
        $this->middleware('guest:vendor');
    }


    public function showRegistrationForm()
    {
        $countries = Country::get(["Name", "id"]);
        return view('registervendor',compact('countries'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $input = $request->all();
        $files = $request->file('addressproof');
        
        $base_path = explode("/", base_path());
        $base_path[count($base_path)-1] = 'assets';
        $base_path = implode("/", $base_path);
        $target_path = $base_path."/images/vendor/";
      
        if($files)
        {
            $file= $request->file('addressproof');
            $filename= random_int(111111, 999999).$file->getClientOriginalName();
            $_FILES['addressproof']['name'] = $filename;
            $file-> move($target_path."addressproof", $filename);
        }
        event(new Registered($user = $this->create($input)));
        return response()->json(['status'=>'success', 'msg'=>'Registration Completed Successfully. You will Notify in Email when your Account is Active.']);
    }









    //     $input = $request->all();

    //     if ($request->hasFile('addressproof')) {
    //             $file = $request->file('addressproof');
    //             $file_extension = $file->getClientOriginalName();
    //             $destination_path = 'assets/images/vendor';
    //             $filename = $file_extension;
    //             $request->file('addressproof')->move($destination_path, $filename);
    //             $input['addressproof'] = $filename;
    //         }

    //     // if ($file = $request->file('addressproof')){
            
    //     //     $filename = time().$request->file('addressproof')->getClientOriginalName();
    //     //     $file->move('assets/images/vendor',$filename);
    //     //  }

    //      event(new Registered($user = $this->create($input)));


    //     //$this->guard()->login($user);

    //     //return $this->registered($request, $user)
    //         //?: redirect(route('vendor.dashboard'));
    //     return redirect()->back()
    //         ->with('message','Registration Completed Successfully. You will notify in email when your account is active.');
    // }

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('vendor');
    }

    protected function registered(Request $request, $user)
    {
        //
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required', 'regex:/[0-9]([0-9]|-(?!-))+/',
            'shop_name' => 'required',
            'addressproof' => 'mimes:jpeg,png,pdf|required|max:10000',
            'email' => 'required|email|max:255|unique:vendor_profiles',
            'phone' => 'required|regex:/^[0-9]{10}+$/',
            'password' => ['required', 
            'min:6', 
            'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/', 
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
    
    public function fetchState(Request $request)
    {
        $data['states'] = State::where("CountryId", $request->country_id)->get(["Name", "id"]);
        return response()->json($data);
    }
    
    public function fetchCity(Request $request)
    {
        $data['cities'] = City::where("StateId", $request->state_id)->get(["Name", "id"]);                
        return response()->json($data);
    }
}
