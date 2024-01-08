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
            $result['coupan_amount']=$arr['0']->coupan_amount;
            $result['start_date']=$arr['0']->start_date;
            $result['coupan_code']=$arr['0']->coupan_code;
            $result['b2b_code']=$arr['0']->b2b_code;
            $result['coupan_type']=$arr['0']->coupan_type;
            $result['validity']=$arr['0']->validity;
        }else {
            $result['users'] = UserProfile::all();
            $result['id']='';
            $result['userid'] ='';
            $result['coupan_amount'] ='';
            $result['start_date'] ='';
            $result['coupan_code'] ='';
            $result['b2b_code'] = '';
            $result['coupan_type'] = '';
            $result['validity'] = '';
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
                if(Coupan::where('coupan_code', '=', $val[2])->exists())
                {
                    array_push($already_exist_coupon, $val[2]);
                    continue;
                }
                else
                {
                    $coupan = new Coupan();
                    $coupan->coupan_amount = $val[0];
                    $coupan->start_date =  $val[1];
                    // $coupan->start_date =  date('Y-m-d', strtotime($val->StartDate));
                    $coupan->coupan_code =  $val[2];
                    $coupan->b2b_code =  "RCH-".$val[2];
                    $coupan->coupan_type =  $val[3];
                    $coupan->validity =  $val[4];
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

}