<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;
use DB;

class MaterialController extends Controller{

    public function getMaterial(Request $request) {
        return view('admin.materialadd');
    }

    public function addMaterial(Request $request)
    {
        $materialname = $_POST['material_name'];
        $materiallist = DB::table('lens_material')
            ->select('name')
            ->distinct()
            ->where('name', $materialname)
            ->get();
        
        if(isset($materiallist[0])){
            echo json_encode(array("status" => 404, 'msg' => 'This Lens Material Already Stored !!')); 
        }
        else{
            DB::table('lens_material')->insert(
                    array(
                        'status'     =>   '1', 
                        'name'=> $materialname, 
                        
                    )
            );
            echo json_encode(array("status" => 200, 'msg' => ' LensMaterial Insert SuccessFully !!')); 
        }
        // $model = new Material();
        // $model->name = $request->material_name;
        // $model->status = 1;
        // $mat = $model->save();
        // if($mat){
        //     $msg = 'color is Successfully Add !!';
        // }else{
        //     $msg = 'Something went wrong !!';
        // }
        // $request->session()->flash('message', $msg);
        // return redirect('admin/productsetting');
    }

    public function deleteMaterial(Request $request, $id){
        $matdel = Material::find($id);
        $matdel->delete();
        $request->session()->flash('message', 'color Successfully Deleted !!');
        return redirect('admin/productsetting');
    }

    public function editMaterial($id)
    {
        $material  = Material::find($id); // Assuming you have a Material model
        return view('admin.materialedit',compact('material'));
    }
    
    public function updatematerial(Request $request, $id)
    {
        $material = Material::findOrFail($id);
    
        // Check if the brand already exists
        $materiallist = Material::where('name', $request->input('material_name'))->get();
    
        if (!$materiallist->isEmpty()) {
            return response()->json(['status' => 404, 'msg' => 'This Lens Material Already Stored !!']);
        }
    
        $material->name = $request->input('material_name');
        $material->save();
    
        return response()->json(['status' => 'success', 'msg' => 'Lens Material updated successfully']);
    }
}
