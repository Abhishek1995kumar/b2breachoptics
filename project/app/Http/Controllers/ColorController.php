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
        $colorlensname = $_POST['color_name'];
        $colorlenslist = DB::table('lens_color')
            ->select('name')
            ->distinct()
            ->where('name', $colorlensname)
            ->get();
        
            if(isset($colorlenslist[0])){
            echo json_encode(array("status" => 404, 'msg' => 'This Color Lens Already Stored !!')); 
        }
        else{
            DB::table('lens_color')->insert(
                array(
                    'status'     =>   '1', 
                    'name'=> $colorlensname, 
                    
                )
            );
            echo json_encode(array("status" => 200, 'msg' => ' Color Lens Insert SuccessFully !!')); 
        }
        // $color = new Color();
        // $color->name = $request->color_name;
        // $color->status = 1;
        // $col = $color->save();
        // $cid = $color->id;
        // if($col){
        //     $msg = 'color is Successfully Add !!';
        // }else{
        //     $msg = 'Something went wrong !!';
        // }
        // $request->session()->flash('message', $msg);
        // return redirect('admin/productsetting');
    }

    public function deleteColor(Request $request, $id){
        $col = Color::find($id);
        $col->delete();
        $request->session()->flash('message', 'color Successfully Deleted !!');
        return redirect("admin/productsetting");
    }

    public function editlenscolor($id){
        $colorlens = Color::find($id);
        return view('admin.lenscoloredit',compact('colorlens'));
    }

    public function updatecolorlens(Request $request, $id)
    {
        $colorlens = Color::findOrFail($id);
        $colorlenslists = Color::where('name', $request->input('color_name'))->get();
        if (!$colorlenslists->isEmpty()) {
            return response()->json(['status' => 404, 'msg' => 'This Color Lens Already Stored !!']);
        }
        $colorlens->name = $request->input('color_name');
        $colorlens->save();
        return response()->json(['status' => 'success', 'msg' => 'Color Lens updated successfully']);
    }
    
    public function getContactColor()
    {
        return view('admin.contactlenscoloradd');
    }
    
    public function contactColorAdd(Request $request)
    {
        $contactcolorlensname = $_POST['name'];
        $contactcolorlenslist = DB::table('contact_lens_color')
            ->select('name')
            ->distinct()
            ->where('name',  $contactcolorlensname)
            ->get();
        
            if(isset($contactcolorlenslist[0])){
            echo json_encode(array("status" => 404, 'msg' => 'This Contact Lens Color Already Stored !!')); 
        }
        else{
            DB::table('contact_lens_color')->insert(
                array(
                    'status'     =>   '1', 
                    'name'=> $contactcolorlensname , 
                    
                )
            );
            echo json_encode(array("status" => 200, 'msg' => ' Contact Lens Color Insert SuccessFully !!')); 
        }
    }
    
    public function deleteContactColor(Request $request, $id)
    {
        $color = ContactLensColor::find($id);
        $color->delete();
        $request->session()->flash('message', 'Color Successfully Deleted !!');
        return redirect("admin/productsetting");
    }
    
    public function editcontactlenscolor($id)
    {
        $contactlenscolor  = ContactLensColor::find($id); // Assuming you have a Material model
        return view('admin.contactlenscoloredit',compact('contactlenscolor'));
    }
    
    public function updatecontactlenscolor(Request $request, $id)
    {

        $contactcolorlens = ContactLensColor::findOrFail($id);
            
        // Check if the brand already exists
        $contactcolorlenslists = ContactLensColor::where('name', $request->input('name'))->get();

        if (!$contactcolorlenslists->isEmpty()) {
            return response()->json(['status' => 404, 'msg' => 'This Contact Lens Color Already Stored !!']);
        }

        $contactcolorlens->name = $request->input('name');
        $contactcolorlens->save();

        return response()->json(['status' => 'success', 'msg' => ' Contact Lens Color updated successfully']);
    }
}
