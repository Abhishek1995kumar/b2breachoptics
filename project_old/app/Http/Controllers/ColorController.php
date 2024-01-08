<?php

namespace App\Http\Controllers;

use App\Color;
use App\ContactLensColor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;


class ColorController extends Controller {
    
    public function getColor(){
        return view('admin.coloradd');
    }

    public function addColor(Request $request)
    {
        $color = new Color();
        $color->name = $request->color_name;
        $color->status = 1;
        $col = $color->save();
        $cid = $color->id;
        if($col){
            $msg = 'color is Successfully Add !!';
        }else{
            $msg = 'Something went wrong !!';
        }
        $request->session()->flash('message', $msg);
        return redirect('admin/productsetting');
    }

    public function deleteColor(Request $request, $id){
        $col = Color::find($id);
        $col->delete();
        $request->session()->flash('message', 'color Successfully Deleted !!');
        return redirect("admin/productsetting");
    }
    
    public function getContactColor()
    {
        return view('admin.contactlenscoloradd');
    }
    
    public function contactColorAdd(Request $request)
    {
        $color = new ContactLensColor();
        $color->name = $request->name;
        $color->status = 1;
        $color->save();
        
        if($color){
            $msg = 'color is Successfully Add !!';
        }else{
            $msg = 'Something went wrong !!';
        }
        
        $request->session()->flash('message', $msg);
        return  redirect("admin/productsetting");
    }
    
    public function deleteContactColor(Request $request, $id)
    {
        $color = ContactLensColor::find($id);
        $color->delete();
        $request->session()->flash('message', 'Color Successfully Deleted !!');
        return redirect("admin/productsetting");
    }
}
