<?php

namespace App\Http\Controllers;

use App\Color;
use App\Shape;
use App\frame_color;
use App\frame_material;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class ProductsettingController extends Controller 
{
    
    public function createshape()
    {
        return view('admin.shapeadd');
    }
    
    public function shapeAdd(Request $request)
    {
        $request_shape = $_POST['name'];
        
        $list = DB::table('frame_shape')
                ->select('name')
                ->distinct()
                ->where('name', $request_shape)
                ->get();
                
        if(isset($list[0]) && $request_shape == $list[0]->name)
        {
            echo json_encode(array("status" => 404, 'msg' => 'This Name Shape All Ready Store !!')); 
        }else{
            DB::table('frame_shape')->insert(
                 array(
                        'status'     =>   '1', 
                        'name'   =>   $request_shape
                 )
            );
           echo json_encode(array("status" => 200, 'msg' => 'Shape Insert SuccessFully !!')); 
        }
    }
    
    public function shape_delete(Request $request, $id)
    {
        $shape = shape::find($id);
        $shape->delete();
        return redirect('admin/productsetting');
        // echo json_encode(array("status" => 200, 'msg' => 'Successfully Deleted !!')); 
    }
    
    public function createframecolor()
    {
        return view('admin.framecoloradd');
    }
    
    public function framecolorAdd(Request $request)
    {
        $request_shape = $_POST['name'];
        
        $list = DB::table('frame_color')
                ->select('name')
                ->distinct()
                ->where('name', $request_shape)
                ->get();
                
        if(isset($list[0]) && $request_shape == $list[0]->name)
        {
            echo json_encode(array("status" => 404, 'msg' => 'This Name Frame Color All Ready Store !!')); 
        }else{
            DB::table('frame_color')->insert(
                 array(
                        'status'     =>   '1', 
                        'name'   =>   $request_shape
                 )
            );
           echo json_encode(array("status" => 200, 'msg' => 'Frame Color Insert SuccessFully !!')); 
        }
    }
    
    public function frame_delete(Request $request, $id)
    {
        $frame_color = frame_color::find($id);
        $frame_color->delete();
        return redirect('admin/productsetting');
        // echo json_encode(array("status" => 200, 'msg' => 'Successfully Deleted !!')); 
    }
    
    public function createframematerial()
    {
        return view('admin.framematerial');
    }
    public function framematerialAdd(Request $request)
    {
        $request_material = $_POST['name'];
        
        $list = DB::table('frame_material')
                ->select('name')
                ->distinct()
                ->where('name', $request_material)
                ->get();
                
        if(isset($list[0]) && $request_material == $list[0]->name)
        {
            echo json_encode(array("status" => 404, 'msg' => 'This Name Frame Material All Ready Store !!')); 
        }else{
            DB::table('frame_material')->insert(
                 array(
                        'status'     =>   '1', 
                        'name'   =>   $request_material
                 )
            );
           echo json_encode(array("status" => 200, 'msg' => 'Frame Material Insert SuccessFully !!')); 
        }
    }
    public function frame_material_delete(Request $request, $id)
    {
        $frame_material = frame_material::find($id);
        $frame_material->delete();
        return redirect('admin/productsetting');
        // echo json_encode(array("status" => 200, 'msg' => 'Successfully Deleted !!')); 
    }
}
