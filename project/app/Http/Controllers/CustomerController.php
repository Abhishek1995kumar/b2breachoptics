<?php

namespace App\Http\Controllers;


use App\UserProfile;
use App\newprojectdetails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;
use DB;
use Mail;
class CustomerController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $newprojectdetails = newprojectdetails::where('status', 0)->get();
       $pending_customer =  DB::table('user_profiles')->where('status', 0)->selectRaw('count(status)')->get();
       $customers = UserProfile::where('status', 0)->orwhere('status', 2)->get();
      
        return view('admin.customers',compact('customers','newprojectdetails','pending_customer'));
    }

    public function pending()
    {   
        $customers = DB::table('user_profiles')
        ->select('user_profiles.*','b2b_citymaster.name as city')
        ->leftjoin('b2b_citymaster','b2b_citymaster.id','=','user_profiles.city')
        ->where('user_profiles.status','0')
        ->orderBy('user_profiles.id', 'DESC')
        ->get();
        return view('admin.customerpending',compact('customers'));
    }

    public function accept($id)
    {
        if(count(array_intersect(['U', 'A'], session()->get('role')['role_actions']['pc'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $customer = UserProfile::findOrFail($id);
        $status['status'] = '1';
        $customer->update($status);
        
        return response()->json(['status'=>'success', 'msg' => 'Customer Accepted Successfully']);
    }

    public function reject($id)
    {
        if(count(array_intersect(['U', 'A'], session()->get('role')['role_actions']['pc'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $vendor = UserProfile::findOrFail($id);
        $status['status'] = '2';
        $vendor->update($status);
        return response()->json(['status'=>'success', 'msg' => 'Customer Inactive Successfully']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function create(Request $request)
    {
        $id=$request->id;
        $logindetails=$request->title;
         $cost=$request->cost;
        // print_r($logindetails);
        // die();
        $vendor = UserProfile::findOrFail($id);
       
        // $logindetailsstatus['logindetailsstatus'] = $logindetails;
        
        // $vendor->update($logindetailsstatus);
         $updatedata['logindetailsstatus'] = $logindetails;
        $updatedata['costpriceshow'] = $cost;
        
        $vendor->update($updatedata);
         $data1= DB::table('user_profiles')->select('*')->where('id',$id)->first();
        
        $data= json_decode(json_encode($data1), true);
          
        $emp = ['id' =>$data['id'],'name' =>$data['name'],'phone' =>$data['phone'], 'password' => $data['password'], 'email' => $data['email'],'logindetailsstatus' => $data['logindetailsstatus']];
        
        $erp_resp = $this->erpsave($emp);
        
        $ci_id = (int)$erp_resp;
        
        $data1 = DB::table('user_profiles')->where('id', $data['id'])->update(['ci_id'=>$ci_id]);
       
       
    }
    
     public function savecostprice(Request $request)
    {
        $id=$request->id;
         $cost=$request->cost;
        //  print_r($cost);
        //  die();
        $vendor = UserProfile::findOrFail($id);
        $updatedata['costpriceshow'] = $cost;
        $vendor->update($updatedata);
        //  $data1= DB::table('user_profiles')->select('*')->where('id',$id)->first();
        
        // $data= json_decode(json_encode($data1), true);
          
        // $emp = ['id' =>$data['id'],'name' =>$data['name'],'phone' =>$data['phone'], 'password' => $data['password'], 'email' => $data['email'],'logindetailsstatus' => $data['logindetailsstatus']];
        
        // $erp_resp = $this->erpsave($emp);
        
        // $ci_id = (int)$erp_resp;
        
        // $data1 = DB::table('user_profiles')->where('id', $data['id'])->update(['ci_id'=>$ci_id]);
       
       
    }
    
     public function erpsave($emp)
    {   
        
        $logindetails =$emp['logindetailsstatus'];
         $id =$emp['id'];
        if($logindetails=="Eyevam")
        {
            // $api_url = "https://b2berp.optical-hut.com/api/save";
                $api_url = "https://eyevam.in/api/save";
            $client = curl_init($api_url);
            curl_setopt($client, CURLOPT_POST, true);
            curl_setopt($client, CURLOPT_POSTFIELDS, $emp);
            // print_r($emp);
            // die();
            curl_setopt($client, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($client);
            curl_close($client); 
           // $response = json_decode($response, true);
            // //return Redirect::to('http://www.google.com');    
            // print_r($response); die();    
            return $response;
        }
        elseif($logindetails=="Joshua")
        {
           //$api_url = "http://uat.eyevam.in//api/save";  
              $api_url = "https://joshuainternational.in/api/save"; 
                $client = curl_init($api_url);

                curl_setopt($client, CURLOPT_POST, true);

                curl_setopt($client, CURLOPT_POSTFIELDS, $emp);

                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($client);

                curl_close($client);

                echo $response;
            return $response;
        }
        elseif($logindetails=="Optical Hut")
        {
            
           //$api_url = "http://uat.eyevam.in//api/save";  
              $api_url = "http://erp.optical-hut.com//api/save"; 
            //   print_r($emp);
            //   die();
                $client = curl_init($api_url);

                curl_setopt($client, CURLOPT_POST, true);

                curl_setopt($client, CURLOPT_POSTFIELDS, $emp);

                curl_setopt($client, CURLOPT_RETURNTRANSFER, true);

                $response = curl_exec($client);

                curl_close($client);

                echo $response;
            return $response;
        }
        else
        {
     
        $vendor = UserProfile::findOrFail($id);
       
        $logindetailsstatus['logindetailsstatus'] = $logindetails;
        
        $vendor->update($logindetailsstatus);
        }
         
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(count(array_intersect(['V'], session()->get('role')['role_actions']['ac'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        $customer1 = UserProfile::findOrFail($id);
        // $orderdetails = DB::table('orders')->select('pay_amount','booking_date')->where('id',$customers->id)->orderBy('id','asc')->get();
        // $productsdetails = DB::table('products')->select('*')->where('id',$id)->first();
        
        // $customid = $customer->id;
        
        $orderdetail = DB::table('orders')
            ->join('user_profiles', 'orders.customerid', '=', 'user_profiles.id')
            ->where('orders.customerid','=',$id)
            ->join('products','orders.products','=','products.id')
            ->join('b2b_citymaster','b2b_citymaster.id','=','user_profiles.city')
            ->where('orders.customerid','=',$id)
            ->select('user_profiles.*','orders.booking_date','orders.pay_amount','products.title','b2b_citymaster.name as city')
            ->orderBy('booking_date', 'DESC')
            ->get();
      
        $customer = DB::table('user_profiles')
                    ->where('user_profiles.id','=',$id)
                    ->leftjoin('b2b_citymaster','b2b_citymaster.id','=','user_profiles.city')
                    ->leftjoin('b2b_statemaster','b2b_statemaster.id','=','user_profiles.state')
                    ->select('user_profiles.*','b2b_citymaster.name as city','b2b_statemaster.Name as state')
                    ->get();
       
        return view('admin.customerdetails',compact('customer','orderdetail','customer1'));
    }

     

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function email($id)
    {
        $customer = UserProfile::findOrFail($id);
        return view('admin.sendemail', compact('customer'));
    }

    public function sendemail(Request $request)
    {
        $id = $request->id;
        $customer = UserProfile::findOrFail($id);
        // unlink('assets/images/customer_document/id_proof/'.$customer->id_proof);
        // unlink('assets/images/customer_document/shop_act_licence/'.$customer->shop_act_lic);
        // unlink('assets/images/customer_document/udyam_certificate/'.$customer->udyam_cert);
        
        $customer->delete();
        
        $user['email'] = $request->to;
        $user['subject'] = $request->subject;
        $user['message'] = $request->message;
        
        $email_id = $user['email'];
        $sub =  $user['subject'];
        $message = $user['message'];
        if($email_id != '')
        {
            $data['email_id'] = $email_id;
            $data['subject'] = $sub;
            $data['message'] = $message;
            $data['body'] = $message;
            
            $body = $user['message'];
           
            Mail::send('userconform_mail', $data, function ($message) use ($user)
            {
                $message->to($user['email']);
                $message->subject($user['subject']);
                // $message->setBody("<h1>$body</h1>");
            });
            Session::flash('success','Check Your Mail.');
            return redirect('admin/customers')->with('message','Email Send Successfully');
        }
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(count(array_intersect(['U', 'D'], session()->get('role')['role_actions']['pc'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        $id = $request->id;
        $customer = UserProfile::findOrFail($id);
        $customer->delete();
        return response()->json(['status'=>'success', 'message'=>'Customer Delete Successfully.']);
    }
            
    public function get_active_customer_details(Request $request)
    {
        if(count(array_intersect(['V', 'U', 'A', 'C', 'P'], session()->get('role')['role_actions']['pc'])) == 0 &&
            count(array_intersect(['V', 'U', 'A', 'C', 'P'], session()->get('role')['role_actions']['ac'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;

        $newprojectdetails = newprojectdetails::where('status', 0)->get();
        
        $order_details_total = $this->get_active_customer_data(false, $search_term, $other_configs);
        $order_details_count = $this->get_active_customer_data(true, $search_term, $other_configs);
        
        $data = array();
        $i = 1;
        
        foreach($order_details_total as $row => $vals) {
            

            // $start++;
            $nestedData = array();
            $actionButton = '';
            $costpermission = '';
            $selectproject = '';
            $status = '';
            // $nestedData[] = $start;
            
            $actionButton .= "<a href='javascript:void(0)' onclick='viewCustomer(".$vals->id.")' class='btn btn-primary btn-xs'><i class='fa fa-check'></i> View Details </a> &nbsp;";

            $actionButton .= "<a href='javascript:void(0)' onclick='sendMail(".$vals->id.")' class='btn btn-primary btn-xs'><i class='fa fa-send'></i> Send Email</a> &nbsp;";

            $actionButton .= "<button type='button' class='btn btn-success' onclick='submitProject(" . $vals->id . ", event)'>Submit</button>";

            // $actionButton .= "<a href='javascript:void(0)' onclick='removeCustomer(".$vals->id.")' class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Remove </a>";
            
            $costpermission =   "<select  id='cost-dropdown' class='form-control'>
                                        <option value='".$vals->costpriceshow."' selected>".$vals->costpriceshow."</option>
                                        <option value='Yes'> Yes</option>
                                        <option value='No'> No</option>
                                    </select>
                                    <br>
              <button type='button' class='btn btn-success' onclick='submitcostprice(" . $vals->id . ", event)'>Submit</button>";
            $selectproject .= "<select  id='country-dropdown' class='form-control'>";
                                if($vals->logindetailsstatus != ''){
            $selectproject .= "<option value='".$vals->logindetailsstatus."' selected>".$vals->logindetailsstatus."</option>";
                                }
                                else{
            $selectproject .= "<option value=''> Select Project</option>";
                                }
                            foreach($newprojectdetails as $data1){ 
            $selectproject .= "<option value='".$data1->projectname ."'>" .$data1->projectname. "</option>";
                            }
            $selectproject .= "</select>";

            // if($vals->status == 1){
            //     $status = "<button type='button' class='btn btn-success' style='outline:none; border: none;'><a href='admin/customer/reject/" . $vals->id . "' style='text-decoration:none; color: #fff;'>Active</a></button>";
            // }
            // elseif($vals->status == 2){
            //     $status = "<button type='button' class='btn btn-primary' style='outline:none; border: none;'><a href='admin/customer/accept/" . $vals->id . "' style='text-decoration:none; color: #fff;'>Inactive</a></button'";
            // }
            // else{
            //     //
            // }
            if($vals->status == '1'){
                $status = "<button type='button' class='btn btn-success' style='outline:none; border: none;'><a onclick='rejectCustomer(" . $vals->id . ")' href='javascript:void(0)' style='text-decoration:none; color: #fff;'>Active</a></button>";
            }
            else if($vals->status == 2){
                $status = "<button type='button' class='btn btn-primary' style='outline:none; border: none;'><a onclick='acceptCustomer(" . $vals->id . ")' href='javascript:void(0)' style='text-decoration:none; color: #fff;'>Inactive</a></button'";
            }
            else{
                //
            }

            $nestedData[] = $vals->name;
            $nestedData[] = $vals->phone;
            $nestedData[] = $vals->alternate_phone;
            $nestedData[] = $vals->email;
            $nestedData[] = $vals->address;
            $nestedData[] = $vals->state;
            $nestedData[] = $vals->city;
            $nestedData[] = $vals->zip;
            $nestedData[] = $vals->bank_name;
            $nestedData[] = $vals->acc_no;
            $nestedData[] = $vals->ifsc_code;
            $nestedData[] = $vals->bussiness_name;
            $nestedData[] = $vals->gst_no;
            $nestedData[] = $costpermission;
            $nestedData[] = $selectproject;
            $nestedData[] = $status;
            $nestedData[] = $actionButton;

           
            $data[] = $nestedData;
        }
        
        $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $order_details_count,
            'recordsFiltered' => $order_details_count,
            'data' => $data,
        );

        echo json_encode($output);
    }
    
    public function get_active_customer_data($count, $search_term = '', $other_configs, $condition = false)
    {
        $result = [];
         
       $data =  DB::table('user_profiles as up')
            ->leftjoin('b2b_citymaster as c', 'up.city', 'c.Id')
            ->leftJoin('b2b_statemaster as s', 'up.state', 's.id')
            ->select('up.*','c.Name as city', 's.Name as state')
            ->whereIn('status', ['1', '2'])
            ->orderBy('up.created_at','desc');
            
        if(isset($search_term) && $search_term !="") {
            $data->where(function($query) use ($search_term, $other_configs){
                    $query->where('up.name', 'like', '%' . $search_term . '%');
                    $query->orwhere('up.email', 'like', '%' . $search_term . '%');
                    $query->orwhere('up.phone', 'like', '%' . $search_term . '%');
                    $query->orwhere('up.address', 'like', '%' . $search_term . '%');
                    $query->orwhere('up.city', 'like', '%' . $search_term . '%');
                });
        }
        
        if(!$count && $other_configs['length']){
            $data->limit($other_configs['length']);
            $data->offset($other_configs['offset']);
        }
        
        $result = $data->get();

        if($count){
            return count($result);
        }
        else {
            return $result;
        }
    }

    public function customerexportExcel(Request $request){
        //print_r($_POST());die();
        $result = [];
        $data =  DB::table('user_profiles as up')
            ->select('up.*','c.Name as city')
            ->leftjoin('b2b_citymaster as c', 'up.city', 'c.Id')
            ->leftjoin('b2b_statemaster as s', 'up.state', 's.id')
            ->whereIn('status', ['1', '2']);
            $result = $data->get();
            return $result;
            //print_r($data);die();
    }
}
