<?php

namespace App\Http\Controllers;

use App\Material;
use Illuminate\Http\Request;

class MaterialController extends Controller{

    public function getMaterial(Request $request) {
        return view('admin.materialadd');
    }

    public function addMaterial(Request $request)
    {
        $model = new Material();
        $model->name = $request->material_name;
        $model->status = 1;
        $mat = $model->save();
        if($mat){
            $msg = 'color is Successfully Add !!';
        }else{
            $msg = 'Something went wrong !!';
        }
        $request->session()->flash('message', $msg);
        return redirect('admin/productsetting');
    }

    public function deleteMaterial(Request $request, $id){
        $matdel = Material::find($id);
        $matdel->delete();
        $request->session()->flash('message', 'color Successfully Deleted !!');
        return redirect('admin/productsetting');
    }
}
