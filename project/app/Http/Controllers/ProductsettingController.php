<?php

namespace App\Http\Controllers;

use App\Color;
use App\Shape;
use App\frame_color;
use App\frame_shape;
use App\frame_material;
use App\Contactlens_packeging;
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

    public function editshape($id)
    {
        $shape = frame_shape::findOrFail($id); // Assuming you have a Shape model

        return view('admin.shapeedit', compact('shape'));
    }

    public function shapeUdate(Request $request, $id)
    {
        
        $shape = frame_shape::findOrFail($id);
    
        // Check if the brand already exists
        $frameshapelist = frame_shape::where('name', $request->input('name'))->get();
    
        if (!$frameshapelist->isEmpty()) {
            return response()->json(['status' => 404, 'msg' => 'This Shape Already Stored !!']);
        }
    
        $shape->name = $request->input('name');
        $shape->save();
    
        return response()->json(['status' => 'success', 'msg' => 'Shape updated successfully']);
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
    
    public function editframcolor($id){
        //return view('admin.framecoloredit');
        $framecolor = frame_color::findOrFail($id); // Assuming you have a Shape model
        return view('admin.framecoloredit', compact('framecolor'));
    }

    public function framecolorUdate(Request $request, $id)
    {
        $framecolor = frame_color::findOrFail($id);
    
        // Check if the brand already exists
        $framecolorlist = frame_color::where('name', $request->input('name'))->get();
    
        if (!$framecolorlist->isEmpty()) {
            return response()->json(['status' => 404, 'msg' => 'This Frame color Already Stored !!']);
        }
    
        $framecolor->name = $request->input('name');
        $framecolor->save();
    
        return response()->json(['status' => 'success', 'msg' => 'Frame color updated successfully']);
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
    
    public function editframematerial($id){
        //return view('admin.framematerialedit');
        $framematerial = frame_material::findOrFail($id); // Assuming you have a Shape model
        return view('admin.framematerialedit', compact('framematerial'));
       
    }

    public function framematerialUdate(Request $request, $id)
    {
        $framematerial = frame_material::findOrFail($id);
    
    // Check if the brand already exists
    $framrmateriallist = frame_material::where('name', $request->input('name'))->get();

    if (!$framrmateriallist->isEmpty()) {
        return response()->json(['status' => 404, 'msg' => 'This Frame Material Already Stored !!']);
    }

    $framematerial->name = $request->input('name');
    $framematerial->save();

    return response()->json(['status' => 'success', 'msg' => 'Frame Material Updated Successfully']);

    }
    
    public function getLensCoating()
    {
        return view('admin.lenscoating');
    }
    
    public function addLensCoating(Request $request)
    {
        
        $request_coating = $_POST['name'];
        
        $list = DB::table('lens_coating')
                ->select('name')
                ->where('name', $request_coating)
                ->get();
                
                
        if(isset($list[0]))
        {
            echo json_encode(array("status" => 404, 'msg' => 'This Lens Coating Name All Ready Store !!')); 
        }else{
            DB::table('lens_coating')->insert(
                 array(
                        'status'     =>   '1', 
                        'name'   =>   $request_coating
                 )
            );
            echo json_encode(array("status" => 200, 'msg' => ' Lens Coating Insert SuccessFully !!')); 
        }
    }
    
    public function deleteLensCoating(Request $request, $id)
    {
        DB::table('lens_coating')->where('id', $id)->delete();
        return redirect('admin/productsetting');
    }
    
    public function getLensIndex(Request $request)
    {
        return view('admin.lensindex');
    }
    
    public function addLensIndex(Request $request)
    {
        
        $request_index = $_POST['name'];
        
        $list = DB::table('lens_index')
                ->select('name')
                ->where('name', $request_index)
                ->get();
                
        if(isset($list[0]))
        {
            echo json_encode(array("status" => 404, 'msg' => 'This Lens Index Name All Ready Store !!')); 
        }else{
            DB::table('lens_index')->insert(
                 array(
                        'status'     =>   '1', 
                        'name'   =>   $request_index
                 )
            );
            echo json_encode(array("status" => 200, 'msg' => 'Lens Index Insert SuccessFully !!')); 
        }
    }
    
    public function deleteLensIndex(Request $request, $id)
    {
        DB::table('lens_index')->where('id', $id)->delete();
        return redirect('admin/productsetting');
    }
    
    public function getLensTechnology(Request $request)
    {
        return view('admin.lenstechnology');
    }
    
    public function addLensTechnology(Request $request)
    {
        
        $request_technology = $_POST['name'];
        
        $list = DB::table('lens_technology')
                ->select('name')
                ->where('name', $request_technology)
                ->get();
                
        if(isset($list[0]))
        {
            echo json_encode(array("status" => 404, 'msg' => 'This Lens Technology Name All Ready Store !!')); 
        }else{
            DB::table('lens_technology')->insert(
                 array(
                        'status'     =>   '1', 
                        'name'   =>   $request_technology
                 )
            );
            echo json_encode(array("status" => 200, 'msg' => 'Lens Technology Insert SuccessFully !!')); 
        }
    }
    
    public function deleteLensTechnology(Request $request, $id)
    {
        DB::table('lens_technology')->where('id', $id)->delete();
        return redirect('admin/productsetting');
    }
    
    
    public function createpackaging()
     {
        return view('admin.addcontactpackaging');
     }

    public function packagingAdd(Request $request)
    {
        $request_packaging = $request->input('name'); // Use Laravel request object instead of $_POST

        // Check if a record with the same name already exists
        $existingRecord = DB::table('contactlens_packeging')
            ->where('name', $request_packaging)
            ->first(); // Use first() to retrieve the first matching record

        if ($existingRecord) {
            // Record with the same name already exists
            return response()->json(["status" => 404, 'msg' => 'Contact Lens Packaging Already Stored!!']);
        } else {
            // Insert a new record
            DB::table('contactlens_packeging')->insert([
                'status' => '1',
                'name' => $request_packaging
            ]);

            return response()->json(["status" => 200, 'msg' => 'Contact Lens Packaging Inserted Successfully!!']);
        }
    }


    public function contactlenspackaging_delete(Request $request, $id){
        $packagedel = Contactlens_packeging::find($id);
        $packagedel->delete();
        $request->session()->flash('message', 'Contactlens Packaging Successfully Deleted !!');
        return redirect('admin/productsetting');
    }


    public function editcontactlenspackaging($id)
    {
        //return view('admin.framematerialedit');
        $contactlenspackaging = Contactlens_packeging::findOrFail($id); // Assuming you have a Shape model
        return view('admin.editcontactpackaging', compact('contactlenspackaging'));
    }



    public function contactpackagingUdate(Request $request, $id)
    {
        $contactlenspackaging = Contactlens_packeging::findOrFail($id);
    
        // Check if the brand already exists
        $packaginglist = Contactlens_packeging::where('name', $request->input('name'))->get();

        if (!$packaginglist->isEmpty()) {
            return response()->json(['status' => 404, 'msg' => 'Contactlens Packaging Already Stored !!']);
        }

        $contactlenspackaging->name = $request->input('name');
        $contactlenspackaging->save();

        return response()->json(['status' => 'success', 'msg' => 'Contactlens Packaging Updated Successfully']);

    }
}
