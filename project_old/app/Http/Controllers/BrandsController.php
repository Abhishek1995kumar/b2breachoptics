<?php

namespace App\Http\Controllers;

use App\Brands;
use App\LensColor;
use App\Material;
use App\ContactLensColor;
use App\frame_shape;
use App\frame_color;
use App\frame_material;
use Illuminate\Http\Request;

class BrandsController extends Controller{
    
    public function index() {
        $brands = Brands::all();
        $materials = Material::all();
        $lenscolors = LensColor::all();
        $contactcolors = ContactLensColor::all();
        $shape = frame_shape::all();
        $frame_color = frame_color::all();
        $frame_material = frame_material::all();
       
        return view('admin.productsetting', compact('brands', 'materials','frame_material','lenscolors', 'contactcolors','shape','frame_color'));
    }

    public function getBrand(){
        return view('admin.brandadd');
    }

    public function addBrand(Request $request)
    {
        $model = new Brands();
        $model->name = $request->brand_name;
        $model->status = 1;
        $bid = $model->save();
        if($bid){
            $msg = 'color is Successfully Add !!';
        }else{
            $msg = 'Something went wrong !!';
        }
        $request->session()->flash('message', $msg);
        return redirect('admin/productsetting');
    }

    public function deleteBrand(Request $request, $id){
        $matdel = Brands::find($id);
        $matdel->delete();
        $request->session()->flash('message', 'brand Successfully Deleted !!');
        return redirect('admin/productsetting');
    }

}