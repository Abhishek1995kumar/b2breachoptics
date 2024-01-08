<?php

namespace App\Http\Controllers\Auth;


use App\Category;
use App\Http\Controllers\Controller;
use App\Profile;
use App\UserProfile;
use App\SubUserProfile;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Country;
use App\State;
use App\City;

class SubUsersRegisterController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest:subuser');
    }

    public function showRegistration()
    {
        $countries = Country::get(["Name", "id"]);
        return view('subuserregister',compact('countries'));
    }

    /**
     * Handle a registration request for the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function childregister(Request $request)
    {
        $this->validator($request->all())->validate();

        $inputs = $request->all();
        
        event(new Registered($user = $this->create($request->all($inputs))));

        return $this->registered($request, $user)
            ?: redirect(route('subuser.details'));
    }

    // /**
    //  * Get the guard to be used during registration.
    //  *
    //  * @return \Illuminate\Contracts\Auth\StatefulGuard
    //  */
    protected function guard()
    {
        return Auth::guard('subuser');
    }

    protected function registered(Request $request, $user)
    {
        //
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'user_id' => 'required',
            'name' => 'required', 'regex:/[0-9]([0-9]|-(?!-))+/',
            'email' => 'required|email|max:255|unique:user_profiles',
            'phone' => 'required|regex:/^[0-9]{10}+$/|unique:user_profiles',
            'password' => ['required', 
               'min:6', 
               'regex:/^.*(?=.{3,})(?=.*[a-zA-Z])(?=.*[0-9])(?=.*[\d\x])(?=.*[!$#%@]).*$/', 
               'confirmed'],
        ]);
    }

    // /**
    //  * Create a new user instance after a valid registration.
    //  *
    //  * @param  array  $data
    //  * @return User
    //  */
    protected function create(array $data)
    {
        return UserProfile::create([
            'user_id' => $data['user_id'],
            'name' => $data['name'],
            'phone' => $data['phone'],
            'address' => $data['address'],
            'zip' => $data['zip'],
            'country' => $data['country'],
            'state' => $data['state'],
            'city' => $data['city'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'status' => 1,
            
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
}
