<?php

namespace App\Http\Controllers;

use App\Brands;
use App\LensColor;
use App\Material;
use App\ContactLensColor;
use App\frame_shape;
use App\frame_color;
use App\frame_material;
use App\Contactlens_packeging;
use Illuminate\Http\Request;
use DB;

class BrandsController extends Controller{
    
    public function index() {
        $brands = Brands::all();
        $materials = Material::all();
        $lenscolors = LensColor::all();
        $lenscoatings = DB::table('lens_coating')->get();
        $lensindex = DB::table('lens_index')->get();
        $lenstechnology = DB::table('lens_technology')->get();
        $contactcolors = ContactLensColor::all();
        $shape = frame_shape::all();
        $frame_color = frame_color::all();
        $frame_material = frame_material::all();
        $contactlens_packagig=Contactlens_packeging::all();
       
        return view('admin.productsetting', compact('brands', 'materials','frame_material','lenscolors', 'contactcolors','shape','frame_color', 'lenscoatings', 'lensindex', 'lenstechnology', 'contactlens_packagig'));
    }

    public function getBrand(){
        $categories = DB::table('categories')->where('role', 'main')->get();
        return view('admin.brandadd', compact('categories'));
    }

    public function addBrand(Request $request)
    {
        $brandname = $_POST['brand_name'];
        $category_id = $_POST['category_id'];
        
        $brandlist = DB::table('brand_name')
            ->select('name')
            ->distinct()
            ->where('name', $brandname)
            ->where('category_id', $category_id)
            ->get();
        
        if (isset($brandlist[0]) && $brandname == $brandlist[0]->name && $category_id == $category_id) {
            echo json_encode(array("status" => 404, 'msg' => 'This Brand Already Stored !!')); 
        }
        else{
            DB::table('brand_name')->insert(
                    array(
                        'name'     =>  $brandname, 
                        'category_id'   =>   $category_id,
                        'status' => 1
                    )
            );
            echo json_encode(array("status" => 200, 'msg' => 'Brand Insert SuccessFully !!')); 
        }
        // $model = new Brands();
        // $model->name = $request->brand_name;
        // $model->category_id = $request->category_id;
        // $model->status = 1;
        // $bid = $model->save();
        // if($bid){
        //     $msg = 'color is Successfully Add !!';
        // }else{
        //     $msg = 'Something went wrong !!';
        // }
        // $request->session()->flash('message', $msg);
        // return redirect('admin/productsetting');
    }

    public function deleteBrand(Request $request, $id){
        $matdel = Brands::find($id);
        $matdel->delete();
        $request->session()->flash('message', 'brand Successfully Deleted !!');
        return redirect('admin/productsetting');
    }
    
    public function editbrand($id)
    {
        $categories = DB::table('categories')->where('role', 'main')->get();
        $brand = DB::table('brand_name')->where('id', $id)->first();
        //print_r($model);die();
        return view('admin.brandedit', compact('categories', 'brand'));
    }
        
    public function brandUpdate(Request $request, $id)
    {
        $brand = Brands::findOrFail($id);
        // Check if the brand already exists
        $brandlist = Brands::where('name', $request->input('brand_name'))
            ->where('category_id', $request->input('category_id'))
            ->get();
        if (isset($brandlist[0]) && $brandlist[0]->id !== $id) {
            return response()->json(['status' => 404, 'msg' => 'This Brand Already Exists']);
        }
        $brand->name = $request->input('brand_name');
        $brand->category_id = $request->input('category_id');
        $brand->save();
        return response()->json(['status' => 'success', 'msg' => 'Brand updated successfully']);
    }
}