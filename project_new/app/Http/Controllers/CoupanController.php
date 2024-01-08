<?php

namespace App\Http\Controllers;

use App\Coupan;
use App\UserProfile;
use Illuminate\Http\Request;
use DB;
use Session;
use Validator;
use Illuminate\Validation\Rule;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xls;
use PhpOffice\PhpSpreadsheet\IOFactory;
use Carbon\Carbon;

class CoupanController extends Controller {

    public function index(){
        $coupan['data'] = Coupan::all();
        return view('admin.coupanList', $coupan);
    }


    public function getCoupan(Request $request, $id='') {

        if($id>0){
            $result['users'] = UserProfile::all();
            $arr=Coupan::where(['id'=>$id])->get();
            $result['id']=$arr['0']->id;
            $result['userid']=$arr['0']->userid;
            $result['coupon_description']=$arr['0']->coupon_description;
            $result['coupan_amount']=$arr['0']->coupan_amount;
            $result['start_date']=$arr['0']->start_date;
            $result['coupan_code']=$arr['0']->coupan_code;
            $result['b2b_code']=$arr['0']->b2b_code;
            $result['coupan_type']=$arr['0']->coupan_type;
            $result['validity']=$arr['0']->validity;
            $result['validitytype']=$arr['0']->validitytype;
            $result['min_purchase_amount']=$arr['0']->min_purchase_amount;
            $result['uses_period']=$arr['0']->uses_period;
        }else {
            $result['users'] = UserProfile::all();
            $result['id']='';
            $result['userid'] ='';
            $result['coupon_description'] ='';
            $result['coupan_amount'] ='';
            $result['start_date'] ='';
            $result['coupan_code'] ='';
            $result['b2b_code'] = '';
            $result['coupan_type'] = '';
            $result['validity'] = '';
            $result['validitytype'] = '';
            $result['min_purchase_amount'] = '';
            $result['uses_period'] = '';
        }
        return view('admin/coupan', $result);
    }

    public function addCoupan(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'coupan_amount' => 'required',
            'start_date' => 'required',
            'coupan_type' => 'required',
            'validity' => 'required',
        ]);

        if($validator->fails()){
            return $validator;
        }
        else
        {
            $coupan = new Coupan;
            $coupan->id = $request->input('id');
            $coupan->userid = $request->input('userid');
            $coupan->coupan_amount = $request->input('coupan_amount');
            $coupan->start_date = $request->input('start_date');
            $coupan->coupan_code = $request->input('coupan_code');
            $coupan->b2b_code = $request->input('b2b_code');
            $coupan->coupan_type = $request->input('coupan_type');
            $coupan->validity = $request->input('validity');
            $coupan->validitytype = $request->input('validitytype');
            $coupan->coupon_description = $request->input('coupon_description');
            $coupan->min_purchase_amount = $request->input('min_purchase_amount');
            if($request->coupon_uses == 'S'){
                $coupan->uses_period = 1;
            }
            else{
                $coupan->uses_period = $request->input('uses_period');
            }

            $coupan->save();
            $coupId = $coupan->id;
            Session::flash('message', 'New Coupan Added Successfully.');
            return redirect('admin/coupan');
        }
    }

    
    public function deleteCoupan(Request $request, $id) {
        $del_data=Coupan::find($id);
        $del_data->delete();
        $delId = $del_data->id;
        $request->session()->flash('message', "Coupan-$delId Successfully Deleted !!");
        return response()->json(['status'=> 'success', 'message'=>"Coupan-$delId Successfully Deleted !!"]);
    }

    

    public function status(Request $request, $status, $id)
    {
        $model=Coupan::find($id);
        $model->status=$status;
        if($status==1){
            $model->save();
            $cid = $model->id;
            $request->session()->flash('message', "Coupan-$cid Successfully Active !!");
        }else{
            $model->save();
            $cid = $model->id;
            $request->session()->flash('message', "Coupan-$cid Successfully Deactive !!");
        }
        return redirect("admin/coupan");
    }

    // Import Data
    

    // Import Data 
    public function importCoupan(Request $request)
    {
        $array = $request->coupon;
        
        if(count($array) > 0)
        {
            $error = '';
            $message = '';
            $already_exist_coupon = [];
            foreach($array as $key => $val)
            {
                if(Coupan::where('coupan_code', '=', $val[0])->exists())
                {
                    array_push($already_exist_coupon, $val[0]);
                    continue;
                }
                else
                {
                    $coupan = new Coupan();
                    $coupan->coupan_code =  $val[0];
                    $coupan->coupon_description = $val[1];
                    $coupan->coupan_amount = $val[2];
                    $coupan->coupan_type =  $val[3];
                    $coupan->start_date =  $val[4];
                    $coupan->validity =  $val[5];
                    // $coupan->start_date =  date('Y-m-d', strtotime($val->StartDate));
                    $coupan->min_purchase_amount =  $val[6];
                    $coupan->uses_period =  $val[7];
                    $coupan->b2b_code =  "RCH-".$val[0];
                    $coupan->save();
                }
            }
            if(count($already_exist_coupon)>0)
            {
                $message = ' New Coupan Added Successfully.';
                $error = " and ".implode(",",$already_exist_coupon)." Coupon Already Exist";
            }
            else
            {
                $message = ' New Coupan Added Successfully.';
            }
            Session::flash('message', $message.$error);
            return response()->json(['status'=>'success', 'message'=> $message.$error]);
        }
    }


    public function exportSheet($coupanData){
        ini_set('max_execution_time', 0);
        ini_set('memory_limit', '4000M');
        try {
            $spreadSheet = new Spreadsheet();
            $spreadSheet->getActiveSheet()->getDefaultColumnDimension()->setWidth(10);
            $spreadSheet->getActiveSheet()->fromArray($coupanData);

            $spreadData = new Xls($spreadSheet);
            header('Content-Type: application/vnd.ms-excel');
            header('Content-Disposition: attachment; filename="coupon.xlsx"');
            header('Cache-Control: max-age=0');
            ob_end_clean();
            $spreadData->save('php://output');
            exit();
        }
        catch (Exception $e){
            return ;
        }
    }

    public function excelData(){
        $data = DB::table('coupans')->orderBy('id', 'desc')->get();
        $data_array[] = array("userid", "coupan_amount", "start_date", "coupan_code", "b2b_code", "coupan_type", "validity");
        foreach($data as $data_item){
            $arr_data[] = array(
                "userid"=> $data_item->userid,
                "coupan_amount"=> $data_item->coupan_amount,
                "start_date"=> $data_item->start_date,
                "coupan_code"=> $data_item->coupan_code,
                "b2b_code"=> $data_item->b2b_code,
                "coupan_type"=> $data_item->coupan_type,
                "validity"=> $data_item->validity,
            );
        }
        $this->exportSheet($arr_data);
    }

    public function export_sample_coupon_excel(Request $request)
    {
        $coupons = Coupan::select('*')->orderBy('id', 'desc')->limit(1)->get();
        $exportData = [
            ['Coupon Code', 'Coupon Description', 'Coupon Amount', 'Coupon Type', 'Start Date', 'Validity', 'Min Purchase Amount', 'Uses Period'],
        ];

        foreach($coupons as $key => $value)
        {
            $rowData = [
                $value['coupan_code'] ? $value['coupan_code'] : '-',
                $value['coupon_description'] ? $value['coupon_description'] : '-',
                $value['coupan_amount'] ? $value['coupan_amount'] : '-',
                $value['coupan_type'] ? 'P or L' : '-',
                $value['start_date'] ? $value['start_date'] : '-',
                $value['validity'] ? $value['validity'].' Days' : '-',
                $value['min_purchase_amount'] ? $value['min_purchase_amount'] : '-',
                $value['uses_period'] ? $value['uses_period'] : '-',
            ];
            $exportData[] = $rowData;
        }

        return $exportData;
    }

    public function export_coupon_excel(Request $request)
    {
        $coupons = Coupan::select('*')->get()->toArray();
        $exportData = [
            ['Coupon Code', 'Coupon Description', 'Coupon Amount', 'Coupon Type', 'Start Date', 'End Date', 'Validity', 'Min Purchase Amount', 'Uses Period', 'Status'],
        ];

        foreach($coupons as $key => $value)
        {
            if($value['status'] == 0){
                $status = 'Deactive';
            }
            else{
                $status = 'Active';
            }

            $end_date = '';
            $validity = '';
            $end_date = Carbon::parse($value['start_date'])->addDays($value['validity']);
            // $validity = $end_date->diffInDays(Carbon::parse($value['start_date'])).' Days';

            $rowData = [
                $value['coupan_code'] ? $value['coupan_code'] : '-',
                $value['coupon_description'] ? $value['coupon_description'] : '-',
                $value['coupan_amount'] ? $value['coupan_amount'] : '-',
                $value['coupan_type'] ? $value['coupan_type'] == 'L' ? 'Lumsum' : 'Percentage' : '-',
                $value['start_date'] ? $value['start_date'] : '-',
                $value['validity'] ? $end_date->toDateString() : '-',
                $value['validity'] ? $value['validity'].' Days' : '-',
                $value['min_purchase_amount'] ? $value['min_purchase_amount'] : '-',
                $value['uses_period'] ? $value['uses_period'] : '-',
                $status,
            ];
            $exportData[] = $rowData;
        }

        return $exportData;
    }
}