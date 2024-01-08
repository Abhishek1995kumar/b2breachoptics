<?php
namespace App\Http\Controllers;
use App\Category;
use App\Gallery;
use App\Product;
use App\ProductAttr;
use App\ProductGallery;
use App\Vendors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;
use Auth;

use Illuminate\Support\Str;

class AdminVendorProductController extends Controller {

    public function __construct(){
        $this->middleware('auth');
    }



    // Start Attribute Color 
    public function product_color_attr(Request $request){
        $newString = str_replace(' ', '-', $request->color);
        $newString = preg_replace('/[^A-Za-z0-9\-]/', '', $newString);
        $newString2 = preg_replace('/-+/', '-', $newString);
        if($_POST['product_id'] != '') {
            DB::enableQueryLog();
            if(!empty($_FILES['images']['name'][0])) {
                $files = $request->file('images');
                if ($files){
                    $count = 0;
                    foreach ($files as $file){
                        $data = explode('.', $file->getClientOriginalExtension());
                        $filepath = 'assets/images/product_attr';
                        $galleryData = new ProductGallery();
                        $image_name = $request->product_id.'_'.$newString2."_".uniqid().".".$data[0];
                        $file->move($filepath, $image_name);
                        $galleryData['pid'] = $request->product_id;
                        $galleryData['attr_imgs'] = $image_name;
                        $galleryData['color'] = $request->color;
                        $galleryData['attr_color_code'] = $request->attr_color_code;
                        $galleryData->save();
                    }
                    echo json_encode(array("status" => 200, 'msg' => 'Data Added !')); 
                }
            }  
        }else {
            echo json_encode(array("status" => 500, 'msg' => 'Server Error !')); 
        }
    }

    public function attr_color_fetch() {
        $list = array();
        $count = 0;
        if($_POST['product_id'] != ''){
            $list = ProductGallery::orderBy('id','desc')->where('pid', $_POST['product_id'])->get();
            $count = ProductGallery::orderBy('id','desc')->where('pid', $_POST['product_id'])->count();
        }
        $data = array();
        $no = $_POST['start'];
        $count_rows = 1;
        foreach ($list as $val) {
            $no++;
            $row = array();
            $row[] = $val->color;
            $row[] = $val->attr_color_code;
            $row[] = '<img width="50" height="50" src="'.url("assets/images/product_attr")."/".$val->attr_imgs.'">';
            $action_string = '<a type="button" name="delete" id="'.$val->id.'" href="javascript:void(0)" class="fa fa-trash delete_color"></a>';
            $row[] = $action_string;
            $row[] = $val->id;
            $data[] = $row;
            $count_rows++;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => $data,
        );
        echo json_encode($output);
    }

    public function attr_color_dropdown(Request $request) {
        $id = trim($request->id);
        $output = '<option value="">Select</option>';
        if(!empty($id)) {
             $list = DB::table('product_attr_gallery')
                ->select('color')
                ->distinct()
                ->where('pid', $id)
                ->get();
                
        DB::getQueryLog();
            foreach($list as $val) {
                $output .='<option value="'.$val->color.'">'.$val->color.'</option>';
            }
        }
        echo json_encode(array("status" => 200, 'data' => $output));
    }

    public function delete_attr_color(Request $request) {
        $gal = ProductGallery::where('id',$request->id);
        $gal->delete();
        echo json_encode(array("status" => 200, 'data' => 'Deleted Successfully !'));
    }

    public function updateColorValue(Request $request) {
        $data = $_POST['data'];
        if(isset($data['id']))
        {
            $id = $data['id'];
            $table_column_name = $data['table_column'];
            $value = $data['value'];
            $update_data = array(
                $table_column_name => $value
            );
            DB::enableQueryLog();
            DB::table('product_attr_gallery')
            ->where('id', $id) 
            ->update($update_data);
        }
        return response()->json(['status'=>'success', 'msg'=>'product attribute color name update successfully!!!']);
    } 
    
    
    public function fetch_attr_color_dropdown(Request $request){
        $id = trim($_POST['id']);
        $response = '<option value="">Select</option>';
        if($id != ""){
            $data = DB::table("product_attr_gallery")
                ->select("color")
                ->distinct()
                ->where("pid", $id)
                ->get();
            foreach($data as $key=>$val){
                $response .='<option value="'.$val->color.'">'.$val->color.'</option>';
            }
        }
        echo json_encode(array("status" => 200, 'data' => $response));
    }
    
        
    public function vendor_product_details(Request $request){
        if(in_array(['U','V','D','N'], session()->get('role')['role_actions']['pl'])){
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $id = $request->input('id');
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        $other_configs['length'] = $length; 
        $other_configs['offset'] = $start; 
        $category_id = $request->input('category_id');
        
        $total_product_data = $this->get_product_from_database(false, $search_term, $other_configs, $category_id);
        $product_count = $this->get_product_from_database(true, $search_term, $other_configs, $category_id);

        $data = array();
        foreach($total_product_data as $key=>$vals){
            $actionButton = '';
            $start++;
            $productData = array();
            $productData[] = $start;
            $id=$vals->id;
            if(in_array('U', session()->get('role')['role_actions']['pl'])){
                $actionButton = "<a href='" . url('admin/products/editVendorProduct') . '/'  . $id . "'  class='btn btn-primary btn-xs'><i class='fa fa-edit'></i> Edit</a>&nbsp&nbsp;";
            }
            
            if(in_array('U', session()->get('role')['role_actions']['pl'])){
                $actionButton .= "<a href='" . url('admin/products/vendor_product_view') . '/' . $id . "' class='btn btn-success btn-xs'><i class='fa fa-eye'></i> View</a>";
            }

            if (in_array('D', session()->get('role')['role_actions']['pl'])) {
                $actionButton .= "<a type='button' onclick='deleteProduct(event)' data='" . $id . "'  class='btn btn-danger btn-xs'><i class='fa fa-trash'></i> Delete</a>";
            }
            $productData[] = $vals->shop_name ? $vals->shop_name : " -- ";
            $productData[] = $vals->entry_by ? $vals->entry_by : " -- ";
            $productData[] = $vals->owner ? $vals->owner : " -- ";
            $productData[] = $vals->title ? $vals->title : " -- ";
            $productData[] = $vals->productsku ? $vals->productsku : " -- ";
            $productData[] = $vals->modelno ? $vals->modelno : " -- ";
            $productData[] = $vals->category ? $vals->category : " -- ";
            $productData[] = $vals->costprice ? $vals->costprice : " -- ";
            $productData[] = $vals->stock ? $vals->stock : " -- ";
            $productData[] = "<img style='max-width: 50px;' src='" . url('assets/images/products') . '/' . $vals->feature_image . "'>";
            $productData[] = $actionButton;
            $data[] = $productData;
        }

        $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $product_count,
            'recordsFiltered' => $product_count,
            'data' => $data,
        );
        echo json_encode($output);
    }

    public function get_product_from_database($count, $search_term='', $other_configs, $category_id){
        if(!in_array('PL', explode(',', session()->get('role')['products']))) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
    
        $response = [];
        if(isset($search_term) && $search_term !=""){
            $data = DB::table('products as p')
                    ->where(function($query) use ($search_term, $other_configs){
                        // $query->where('p.owner', $search_term );
                        // $query->orwhere('v.shop_name',  $search_term );
                        // $query->orwhere('p.entry_by',  $search_term );
                        // $query->orwhere('p.title', $search_term);
                        // $query->orwhere('p.productsku', $search_term );
                        // $query->orwhere('p.modelno', $search_term );
                        // $query->orwhere('p.feature_image', $search_term );
                        $query->where('p.owner', 'like', '%' . $search_term . '%');
                        $query->orwhere('v.shop_name', 'like', '%' . $search_term . '%');
                        $query->orWhere('p.entry_by', 'like', '%' . $search_term . '%');
                        $query->orWhere('p.title', 'like', '%' . $search_term . '%');
                        $query->orWhere('p.productsku', 'like', '%' . $search_term . '%');
                        $query->orWhere('p.modelno', 'like', '%' . $search_term . '%');
                        // $query->orWhere('p.price', 'like', '%' . $search_term . '%');
                        // $query->orWhere('p.stock', 'like', '%' . $search_term . '%');
                        $query->orWhere('p.feature_image', 'like', '%' . $search_term . '%');
                        $query->orwhere(function($join) use ($search_term, $other_configs){
                            $join->where('c.name',  $search_term );
                            $join->where('v.shop_name', $search_term );
                        });
                    })
                    ->select('v.shop_name', 'p.id','c.name as category','p.entry_by','p.productsku','p.modelno','p.title','p.owner','p.costprice','p.stock','p.feature_image')
                    ->leftjoin('vendor_profiles as v', 'v.id' , '=' , 'p.vendorid')
                    ->leftjoin('categories as c', 'c.id', '=', 'p.category')
                    ->where('p.approved','yes')
                    ->whereIn('p.status',['2', '3'])
                    ->where('p.owner','vendor')
                    ->orderBy('p.id', 'desc');
        }
        $data = DB::table('products as p')
                ->select('v.shop_name', 'p.id','c.name as category','p.vendor_name','p.entry_by','p.productsku','p.modelno','p.title','p.owner','p.costprice','p.stock','p.feature_image')
                ->leftjoin('vendor_profiles as v', 'v.id' , '=' , 'p.vendorid')
                ->leftjoin('categories as c', 'c.id', '=', 'p.category')
                ->where('p.approved','yes')
                ->whereIn('p.status',['1','2'])
                ->where('p.owner','vendor')
                ->orderBy('p.id', 'desc');
                
        if(!$count && $other_configs['length']){
            $data->limit($other_configs['length']);
            $data->offset($other_configs['offset']);
        }
        // dd($data);
        if($category_id){
            $data->where("p.category", $category_id);
        }
        $response = $data->get();
        if($count){
            return count($response);
        }else{
            return $response;
        }
    }
    
    public function getDownloadExcel(Request $request) {
        $category_id = $request->input('category_id');
       
        if (!in_array('PL', explode(',', session()->get('role')['products']))) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }

        $data = Product::where('category', $category_id);
        
        $data->where('owner', 'vendor');
        $result = $data->with(['getProductAttribute','getProductAttributeColor'])->get()->toArray();
        

        // Create an array to hold the data for export
        $exportData = [];

        if($result[0]['category'][0] == 53){
            $exportData = [
                ['Product SKU', 'Product Name', 'Main Categroy', 'Frame Shape', 'Frame Color', 'Gender', 'Brand Name', 'Model No.', 'Color Code', 'Seller Name',
                'Frame Material', 'Frame Width', 'Temple Material', 'Temple Color', 'Frame Type', 'Manufacturer', 'Warrenty Type',
                'Frame Dimention', 'Product Weight', 'Frame Height', 'Package Weight', 'Package Width', 'Package Length', 'Country Of Origin', 'HSN Code',
                'Selling Price', 'MRP', 'Product Cost', 'Product Stock', 'Product Tat', 'status'],
            ];
        }
        else if($result[0]['category'][0] == 58){
            $exportData = [
                ['Product SKU', 'Product Name', 'Main Categroy', 'Brand Name', 'Lens Type', 'Color Code', 'Seller Name', 'Lens Dia', 'Sphere', 'Axis',
                'Cylinder', 'Add Power', 'Lens Material', 'Lens Color', 'Lens Technology', 'Lens Index', 'Gravity', 'Coating', 'Coating Color',
                'Abbe Value', 'Focal Length', 'Manufacturer', 'Warrenty Type', 'Product Weight', 'Package Weight', 'Package Width', 'Package Length', 
                'Country Of Origin', 'HSN Code', 'Selling Price', 'MRP', 'Product Cost', 'Product Stock', 'Product Tat', 'status'],
            ];
        }
        else if($result[0]['category'][0] == 63){
            $exportData = [
                ['Product SKU', 'Product Name', 'Main Categroy', 'Frame Shape', 'Frame Color', 'Gender', 'Brand Name', 'Model No.', 'Color Code', 'Seller Name',
                'Frame Material', 'Frame Width', 'Temple Material', 'Temple Color', 'Frame Type', 'Lens Material', 'Lens Color', 'Lens Technology', 'Manufacturer',
                'Warrenty Type', 'Frame Dimention', 'Product Weight', 'Frame Height', 'Package Weight', 'Package Width', 'Package Length', 'Country Of Origin', 'HSN Code',
                'Selling Price', 'MRP', 'Product Cost', 'Product Stock', 'Product Tat', 'status'],
            ];
        }
        else if($result[0]['category'][0] == 72){
            $exportData = [
                ['Product SKU', 'Product Name', 'Main Categroy', 'Brand Name', 'Contact Lens Type', 'Model No.', 'Color Code', 'Seller Name', 'Diameter', 'Base Curve', 'Sphere Power (-)',
                'Sphere Power (+)', 'Axis', 'Cylinder', 'Add Power', 'Center Thickness', 'Contact Lens Material', 'Contact Lens Color', 'Usages Duration', 'Desposibilty', 'Packaging',
                'Manufacturer', 'Warrenty Type', 'Product Weight', 'Package Weight', 'Package Width', 'Package Length', 'Country Of Origin',
                'HSN Code', 'Selling Price', 'MRP', 'Product Cost', 'Product Stock', 'Product Tat', 'status'],
            ];
        }
        else if($result[0]['category'][0] == 82){
            $exportData = [
                ['Product SKU', 'Product Name', 'Main Categroy', 'Premium Type', 'Frame Shape', 'Frame Color', 'Gender', 'Brand Name', 'Model No.', 'Color Code', 'Seller Name',
                'Frame Material', 'Frame Width', 'Temple Material', 'Temple Color', 'Frame Type', 'Lens Material', 'Lens Color', 'Lens Technology', 'Manufacturer',
                'Warrenty Type', 'Frame Dimention', 'Product Weight', 'Frame Height', 'Package Weight', 'Package Width', 'Package Length', 'Country Of Origin', 'HSN Code',
                'Selling Price', 'MRP', 'Product Cost', 'Product Stock', 'Product Tat', 'status'],
            ];
        }
        else if($result[0]['category'][0] == 87 || $result[0]['category'][0] == 396){
            $exportData = [
                ['Product SKU', 'Product Name', 'Main Categroy', 'Brand Name', 'Net Quantity', 'Self Life', 'Color Code', 'Product Color', 'Manufacturer', 'Warrenty Type', 'Product Weight', 'Package Weight', 'Package Width', 'Package Length', 
                'Country Of Origin', 'HSN Code', 'Selling Price', 'MRP', 'Product Cost', 'Product Stock', 'Product Tat', 'status'],
            ];
        }
        else{
            //
        }
        
        foreach($result as $key => $value){
            $status = '';
            if ($value['status'] == 1) {
                $status = 'Active';
            } elseif ($value['status'] == 0) {
                $status = 'Deactive';
            } elseif ($value['status'] == 2) {
                $status = 'Approved';
            } elseif ($value['status'] == 3) {
                $status = 'Reject';
            }
            $categorys = $value['category'][0];
            $response = DB::select("SELECT name FROM categories WHERE id IN ($categorys)");
            
            if($value['category'][0] == 53){
                $rowData = [
                    $value['productsku'],
                    $value['title'] ? str_replace(',', ' ', $value['title']) : '-',
                    $value['category'] ? $response[0]->name : '-',
                    $value['shape'] ? $value['shape'] : '-',
                    $value['framecolor'] ? $value['framecolor'] : '-',
                    $value['gender'] ? str_replace(',', ' ', $value['gender']) : '-',
                    $value['brandname'] ? $value['brandname'] : '-',
                    $value['modelno'] ? $value['modelno'] : '-',
                    $value['colorcode'] ? $value['colorcode'] : '-',
                    $value['sellername'] ? $value['sellername'] : '-',
                    $value['framematerial'] ? $value['framematerial'] : '-',
                    $value['framewidth'] ? $value['framewidth'] : '-',
                    $value['templematerial'] ? $value['templematerial'] : '-',
                    $value['templecolor'] ? $value['templecolor'] : '-',
                    $value['frametype'] ? $value['frametype'] : '-',
                    $value['manufracturer'] ? $value['manufracturer'] : '-',
                    $value['warrentytype'] ? $value['warrentytype'] : '-',
                    $value['productdimension'] ? $value['productdimension'] : '-',
                    $value['weight'] ? $value['weight'] : '-',
                    $value['height'] ? $value['height'] : '-',
                    $value['packweight'] ? $value['packweight'] : '-',
                    $value['packwidth'] ? $value['packwidth'] : '-',
                    $value['packlength'] ? $value['packlength'] : '-',
                    $value['countryoforigin'] ? $value['countryoforigin'] : '-',
                    $value['hsncode'] ? $value['hsncode'] : '-',
                    $value['price'] ? $value['price'] : '-',
                    $value['previous_price'] ? $value['previous_price'] : '-',
                    $value['costprice'] ? $value['costprice'] : '-',
                    $value['stock'] ? $value['stock'] : '-',
                    $value['producttat'] ? $value['producttat'] : '-',
                    $status,
                ];
                $exportData[] = $rowData;
                if($value['get_product_attribute']){
                    foreach($value['get_product_attribute'] as $attr){
                        
                        $psku = $attr['product_sku'];
                        $attrcolor = $attr['attr_color'];
                        $response2 = DB::select("SELECT color, attr_color_code  FROM product_attr_gallery WHERE pid = '$psku' AND color = '$attrcolor'");
                    
                        $rowData = [
                            $attr['attr_sku'],
                            $value['title'] ? str_replace(',', ' ', $value['title']) : '-',
                            $value['category'] ? $response[0]->name : '-',
                            $value['shape'] ? $value['shape'] : '-',
                            $attr['attr_color'],
                            $value['gender'] ? str_replace(',', '/', $value['gender']) : '-',
                            $value['brandname'],
                            $value['modelno'],
                            $response2 ? $response2[0]->attr_color_code : '-',
                            $value['sellername'] ? $value['sellername'] : '-',
                            $value['framematerial'] ? $value['framematerial'] : '-',
                            $value['framewidth'] ? $value['framewidth'] : '-',
                            $value['templematerial'] ? $value['templematerial'] : '-',
                            $value['templecolor'] ? $value['templecolor'] : '-',
                            $value['frametype'] ? $value['frametype'] : '-',
                            $value['manufracturer'] ? $value['manufracturer'] : '-',
                            $value['warrentytype'] ? $value['warrentytype'] : '-',
                            $attr['attr_size'] ? $attr['attr_size'] : '-',
                            $value['weight'] ? $value['weight'] : '-',
                            $value['height'] ? $value['height'] : '-',
                            $value['packweight'] ? $value['packweight'] : '-',
                            $value['packwidth'] ? $value['packwidth'] : '-',
                            $value['packlength'] ? $value['packlength'] : '-',
                            $value['countryoforigin'] ? $value['countryoforigin'] : '-',
                            $value['hsncode'] ? $value['hsncode'] : '-',
                            $value['price'] ? $value['price'] : '-',
                            $attr['attr_mrp'] ? $attr['attr_mrp'] : '-',
                            $attr['attr_price'] ? $attr['attr_price'] : '-',
                            $attr['attr_qty'] ? $attr['attr_qty'] : '-',
                            $value['producttat'] ? $value['producttat'] : '-',
                            $status
                        ];
                        $exportData[] = $rowData;
                    }
                }
            }
            else if($value['category'][0] == 58){
                $rowData = [
                    $value['productsku'],
                    str_replace(',', ' ', $value['title']),
                    $value['category'] ? $response[0]->name : '-',
                    $value['brandname'] ? $value['brandname'] : '-',
                    $value['visioneffect'] ? $value['visioneffect'] : '-',
                    $value['colorcode'] ? $value['colorcode'] : '-',
                    $value['sellername'] ? $value['sellername'] : '-',
                    $value['diameterlens'] ? str_replace(',', ' ', $value['diameterlens']) : '-',
                    $value['sphere'] ? str_replace(',', ' ', $value['sphere']) : '-',
                    $value['axisnlens'] ? str_replace(',', ' ', $value['axisnlens']) : '-',
                    $value['cylinderlens'] ? str_replace(',', ' ', $value['cylinderlens']) : '-',
                    $value['addpower'] ? str_replace(',', ' ', $value['addpower']) : '-',
                    $value['lensmaterialtype'] ? $value['lensmaterialtype'] : '-',
                    $value['color'] ? $value['color'] : '-',
                    $value['lenstechnology'] ? str_replace(',', ' ', $value['lenstechnology']) : '-',
                    $value['lensindex'] ? $value['lensindex'] : '-',
                    $value['gravity'] ? $value['gravity'] : '-',
                    $value['coating'] ? str_replace(',', ' ', $value['coating']) : '-',
                    $value['coatingcolor'] ? $value['coatingcolor'] : '-',
                    $value['abbevalue'] ? $value['abbevalue'] : '-',
                    $value['focallength'] ? $value['focallength'] : '-',
                    $value['manufracturer'] ? $value['manufracturer'] : '-',
                    $value['warrentytype'] ? $value['warrentytype'] : '-',
                    $value['weight'] ? $value['weight'] : '-',
                    $value['packweight'] ? $value['packweight'] : '-',
                    $value['packwidth'] ? $value['packwidth'] : '-',
                    $value['packlength'] ? $value['packlength'] : '-',
                    $value['countryoforigin'] ? $value['countryoforigin'] : '-',
                    $value['hsncode'] ? $value['hsncode'] : '-',
                    $value['price'] ? $value['price'] : '-',
                    $value['previous_price'] ? $value['previous_price'] : '-',
                    $value['costprice'] ? $value['costprice'] : '-',
                    $value['stock'] ? $value['stock'] : '-',
                    $value['producttat'] ? $value['producttat'] : '-',
                    $status,
                ];
                $exportData[] = $rowData;
                if($value['get_product_attribute']){
                    foreach($value['get_product_attribute'] as $attr){
                        
                        $psku = $attr['product_sku'];
                        $attrcolor = $attr['attr_color'];
                        $response2 = DB::select("SELECT color, attr_color_code  FROM product_attr_gallery WHERE pid = '$psku' AND color = '$attrcolor'");
                    
                        $rowData = [
                            $attr['attr_sku'] ? $attr['attr_sku'] : '-',
                            
                            $value['title'] ? str_replace(',', ' ', $value['title']) : '-',
                            $value['category'] ? $response[0]->name : '-',
                            
                            $value['brandname'] ? $value['brandname'] : '-',
                            $value['visioneffect'] ? $value['visioneffect'] : '-',
                            
                            $response2 ? $response2[0]->attr_color_code : '-',
                            
                            $value['sellername'] ? $value['sellername'] : '-',
                            $value['diameterlens'] ? str_replace(',', ' ', $value['diameterlens']) : '-',
                            $value['sphere'] ? str_replace(',', ' ', $value['sphere']) : '-',
                            $value['axisnlens'] ? str_replace(',', ' ', $value['axisnlens']) : '-',
                            $value['cylinderlens'] ? str_replace(',', ' ', $value['cylinderlens']) : '-',
                            $value['addpower'] ? str_replace(',', ' ', $value['addpower']) : '-',
                            $value['lensmaterialtype'] ? $value['lensmaterialtype'] : '-',
                            
                            $attr['attr_color'] ? $attr['attr_color'] : '-',
                            
                            $value['lenstechnology'] ? str_replace(',', ' ', $value['lenstechnology']) : '-',
                            $value['lensindex'] ? $value['lensindex'] : '-',
                            $value['gravity'] ? $value['gravity'] : '-',
                            $value['coating'] ? str_replace(',', ' ', $value['coating']) : '-',
                            $value['coatingcolor'] ? $value['coatingcolor'] : '-',
                            $value['abbevalue'] ? $value['abbevalue'] : '-',
                            $value['focallength'] ? $value['focallength'] : '-',
                            $value['manufracturer'] ? $value['manufracturer'] : '-',
                            $value['warrentytype'] ? $value['warrentytype'] : '-',
                            $value['weight'] ? $value['weight'] : '-',
                            $value['packweight'] ? $value['packweight'] : '-',
                            $value['packwidth'] ? $value['packwidth'] : '-',
                            $value['packlength'] ? $value['packlength'] : '-',
                            $value['countryoforigin'] ? $value['countryoforigin'] : '-',
                            $value['hsncode'] ? $value['hsncode'] : '-',
                            $value['price'] ? $value['price'] : '-',
                            
                            $attr['attr_mrp'] ? $attr['attr_mrp'] : '-',
                            $attr['attr_price'] ? $attr['attr_price'] : '-',
                            $attr['attr_qty'] ? $attr['attr_qty'] : '-',
                            
                            $value['producttat'] ? $value['producttat'] : '-',
                            $status,
                        ];
                        $exportData[] = $rowData;
                    }
                }
            }
            else if($value['category'][0] == 63){
                $rowData = [
                    $value['productsku'],
                    str_replace(',', ' ', $value['title']),
                    $value['category'] ? $response[0]->name : '-',
                    $value['shape'] ? $value['shape'] : '-',
                    $value['framecolor'] ? $value['framecolor'] : '-',
                    $value['gender'] ? str_replace(',' , '/', $value['gender']) : '-',
                    $value['brandname'] ? $value['brandname'] : '-',
                    $value['modelno'] ? $value['modelno'] : '-',
                    $value['colorcode'] ? $value['colorcode'] : '-',
                    $value['sellername'] ? $value['sellername'] : '-',
                    $value['framematerial'] ? $value['framematerial'] : '-',
                    $value['framewidth'] ? $value['framewidth'] : '-',
                    $value['templematerial'] ? $value['templematerial'] : '-',
                    $value['templecolor'] ? $value['templecolor'] : '-',
                    $value['frametype'] ? $value['frametype'] : '-',
                    $value['lensmaterialtype'] ? $value['lensmaterialtype'] : '-',
                    $value['color'] ? $value['color'] : '-',
                    $value['lenstechnology'] ? str_replace(',', ' ', $value['lenstechnology']) : '-',
                    $value['manufracturer'] ? $value['manufracturer'] : '-',
                    $value['warrentytype'] ? $value['warrentytype'] : '-',
                    $value['productdimension'] ? $value['productdimension'] : '-',
                    $value['weight'] ? $value['weight'] : '-',
                    $value['height'] ? $value['height'] : '-',
                    $value['packweight'] ? $value['packweight'] : '-',
                    $value['packwidth'] ? $value['packwidth'] : '-',
                    $value['packlength'] ? $value['packlength'] : '-',
                    $value['countryoforigin'] ? $value['countryoforigin'] : '-',
                    $value['hsncode'] ? $value['hsncode'] : '-',
                    $value['price'] ? $value['price'] : '-',
                    $value['previous_price'] ? $value['previous_price'] : '-',
                    $value['costprice'] ? $value['costprice'] : '-',
                    $value['stock'] ? $value['stock'] : '-',
                    $value['producttat'] ? $value['producttat'] : '-',
                    $status,
                ];
                $exportData[] = $rowData;
                if($value['get_product_attribute']){
                    foreach($value['get_product_attribute'] as $attr){
                        
                        $psku = $attr['product_sku'];
                        $attrcolor = $attr['attr_color'];
                        $response2 = DB::select("SELECT color, attr_color_code  FROM product_attr_gallery WHERE pid = '$psku' AND color = '$attrcolor'");
                    
                        $rowData = [
                            $attr['attr_sku'] ? $attr['attr_sku'] : '-',
                            
                            str_replace(',', ' ', $value['title']),
                            $value['category'] ? $response[0]->name : '-',
                            $value['shape'] ? $value['shape'] : '-',
                            
                            $attr['attr_color'] ? $attr['attr_color'] : '-',
                            
                            $value['gender'] ? str_replace(',' , '|', $value['gender']) : '-',
                            $value['brandname'] ? $value['brandname'] : '-',
                            $value['modelno'] ? $value['modelno'] : '-',
                            
                            $response2 ? $response2[0]->attr_color_code : '-',
                            
                            $value['sellername'] ? $value['sellername'] : '-',
                            $value['framematerial'] ? $value['framematerial'] : '-',
                            $value['framewidth'] ? $value['framewidth'] : '-',
                            $value['templematerial'] ? $value['templematerial'] : '-',
                            $value['templecolor'] ? $value['templecolor'] : '-',
                            $value['frametype'] ? $value['frametype'] : '-',
                            $value['lensmaterialtype'] ? $value['lensmaterialtype'] : '-',
                            $value['color'] ? $value['color'] : '-',
                            $value['lenstechnology'] ? str_replace(',', ' ', $value['lenstechnology']) : '-',
                            $value['manufracturer'] ? $value['manufracturer'] : '-',
                            $value['warrentytype'] ? $value['warrentytype'] : '-',
                            
                            $attr['attr_size'] ? $attr['attr_size'] : '-',
                            
                            $value['weight'] ? $value['weight'] : '-',
                            $value['productdimension'] ? $value['productdimension'] : '-',
                            $value['height'] ? $value['height'] : '-',
                            $value['packweight'] ? $value['packweight'] : '-',
                            $value['packwidth'] ? $value['packwidth'] : '-',
                            $value['countryoforigin'] ? $value['countryoforigin'] : '-',
                            $value['packlength'] ? $value['packlength'] : '-',
                            $value['hsncode'] ? $value['hsncode'] : '-',
                            
                            $attr['attr_mrp'] ? $attr['attr_mrp'] : '-',
                            $attr['attr_price'] ? $attr['attr_price'] : '-',
                            $attr['attr_qty'] ? $attr['attr_qty'] : '-',
                            
                            $value['producttat'] ? $value['producttat'] : '-',
                            $status,
                        ];
                        $exportData[] = $rowData;
                    }
                }
            }
            else if($value['category'][0] == 72){
                $rowData = [
                    $value['productsku'],
                    str_replace(',', ' ', $value['title']),
                    $value['category'] ? $response[0]->name : '-',
                    $value['brandname'] ? $value['brandname'] : '-',
                    $value['lenstype'] ? $value['lenstype'] : '-',
                    $value['modelno'] ? $value['modelno'] : '-',
                    $value['colorcode'] ? $value['colorcode'] : '-',
                    $value['sellername'] ? $value['sellername'] : '-',
                    $value['diameter'] ? str_replace(',', ' ', $value['diameter']) : '-',
                    $value['basecurve'] ? str_replace(',', ' ', $value['basecurve']) : '-',
                    $value['powermin'] ? str_replace(',', ' ', $value['powermin']) : '-',
                    $value['powermax'] ? str_replace(',', ' ', $value['powermax']) : '-',
                    $value['axisnew'] ? str_replace(',', ' ', $value['axisnew']) : '-',
                    $value['cylindernew'] ? str_replace(',', ' ', $value['cylindernew']) : '-',
                    $value['addpower'] ? str_replace(',', ' ', $value['addpower']) : '-',
                    $value['centerthiknessnew'] ? $value['centerthiknessnew'] : '-',
                    $value['contactlensmaterialtype'] ? $value['contactlensmaterialtype'] : '-',
                    $value['lenscolor'] ? $value['lenscolor'] : '-',
                    $value['usagesduration'] ? $value['usagesduration'] : '-',
                    $value['disposability'] ? $value['disposability'] : '-',
                    $value['packaging'] ? str_replace(',', ' ', $value['packaging']) : '-',
                    $value['manufracturer'] ? $value['manufracturer'] : '-',
                    $value['warrentytype'] ? $value['warrentytype'] : '-',
                    $value['weight'] ? $value['weight'] : '-',
                    $value['packweight'] ? $value['packweight'] : '-',
                    $value['packwidth'] ? $value['packwidth'] : '-',
                    $value['packlength'] ? $value['packlength'] : '-',
                    $value['countryoforigin'] ? $value['countryoforigin'] : '-',
                    $value['hsncode'] ? $value['hsncode'] : '-',
                    $value['price'] ? $value['price'] : '-',
                    $value['previous_price'] ? $value['previous_price'] : '-',
                    $value['costprice'] ? $value['costprice'] : '-',
                    $value['stock'] ? $value['stock'] : '-',
                    $value['producttat'] ? $value['producttat'] : '-',
                    $status,
                ];
                $exportData[] = $rowData;
                if($value['get_product_attribute']){
                    foreach($value['get_product_attribute'] as $attr){
                        
                        $psku = $attr['product_sku'];
                        $attrcolor = $attr['attr_color'];
                        $response2 = DB::select("SELECT color, attr_color_code  FROM product_attr_gallery WHERE pid = '$psku' AND color = '$attrcolor'");
                    
                        $rowData = [
                            $attr['attr_sku'] ? $attr['attr_sku'] : '-',
                            
                            str_replace(',', ' ', $value['title']),'-',
                            $value['category'] ? $response[0]->name : '-',
                            $value['brandname'] ? $value['brandname'] : '-',
                            $value['lenstype'] ? $value['lenstype'] : '-',
                            $value['modelno'] ? $value['modelno'] : '-',
                            
                            $response2 ? $response2[0]->attr_color_code : '-',
                            
                            $value['sellername'] ? $value['sellername'] : '-',
                            $value['diameter'] ? str_replace(',', ' ', $value['diameter']) : '-',
                            $value['basecurve'] ? str_replace(',', ' ', $value['basecurve']) : '-',
                            $value['powermin'] ? str_replace(',', ' ', $value['powermin']) : '-',
                            $value['powermax'] ? str_replace(',', ' ', $value['powermax']) : '-',
                            $value['axisnew'] ? str_replace(',', ' ', $value['axisnew']) : '-',
                            $value['cylindernew'] ? str_replace(',', ' ', $value['cylindernew']) : '-',
                            $value['addpower'] ? str_replace(',', ' ', $value['addpower']) : '-',
                            $value['centerthiknessnew'] ? $value['centerthiknessnew'] : '-',
                            $value['contactlensmaterialtype'] ? $value['contactlensmaterialtype'] : '-',
                            
                            $attr['attr_color'] ? $attr['attr_color'] : '-',
                            
                            $value['usagesduration'] ? $value['usagesduration'] : '-',
                            $value['disposability'] ? $value['disposability'] : '-',
                            $value['packaging'] ? str_replace(',', ' ', $value['packaging']) : '-',
                            $value['manufracturer'] ? $value['manufracturer'] : '-',
                            $value['warrentytype'] ? $value['warrentytype'] : '-',
                            $value['weight'] ? $value['weight'] : '-',
                            $value['packweight'] ? $value['packweight'] : '-',
                            $value['packwidth'] ? $value['packwidth'] : '-',
                            $value['packlength'] ? $value['packlength'] : '-',
                            $value['countryoforigin'] ? $value['countryoforigin'] : '-',
                            $value['hsncode'] ? $value['hsncode'] : '-',
                            $value['price'] ? $value['price'] : '-',
                            
                            $attr['attr_mrp'] ? $attr['attr_mrp'] : '-',
                            $attr['attr_price'] ? $attr['attr_price'] : '-',
                            $attr['attr_qty'] ? $attr['attr_qty'] : '-',
                            $value['producttat'] ? $value['producttat'] : '-',
                            $status
                        ];
                        $exportData[] = $rowData;
                    }
                }
            }
            else if($value['category'][0] == 82){
                $rowData = [
                    $value['productsku'],
                    str_replace(',', ' ', $value['title']),
                    $value['category'] ? $response[0]->name : '-',
                    $value['premiumtype'] ? $value['premiumtype'] : '-',
                    $value['shape'] ? $value['shape'] : '-',
                    $value['framecolor'] ? $value['framecolor'] : '-',
                    $value['gender'] ? $value['gender'] : '-',
                    $value['brandname'] ? $value['brandname'] : '-',
                    $value['modelno'] ? $value['modelno'] : '-',
                    $value['colorcode'] ? $value['colorcode'] : '-',
                    $value['sellername'] ? $value['sellername'] : '-',
                    $value['framematerial'] ? $value['framematerial'] : '-',
                    $value['framewidth'] ? $value['framewidth'] : '-',
                    $value['templematerial'] ? $value['templematerial'] : '-',
                    $value['templecolor'] ? $value['templecolor'] : '-',
                    $value['frametype'] ? $value['frametype'] : '-',
                    $value['lensmaterialtype'] ? $value['lensmaterialtype'] : '-',
                    $value['color'] ? $value['color'] : '-',
                    $value['lenstechnology'] ? str_replace(',', ' ', $value['lenstechnology']) : '-',
                    $value['manufracturer'] ? $value['manufracturer'] : '-',
                    $value['warrentytype'] ? $value['warrentytype'] : '-',
                    $value['productdimension'] ? $value['productdimension'] : '-',
                    $value['weight'] ? $value['weight'] : '-',
                    $value['height'] ? $value['height'] : '-',
                    $value['packweight'] ? $value['packweight'] : '-',
                    $value['packwidth'] ? $value['packwidth'] : '-',
                    $value['packlength'] ? $value['packlength'] : '-',
                    $value['countryoforigin'] ? $value['countryoforigin'] : '-',
                    $value['hsncode'] ? $value['hsncode'] : '-',
                    $value['price'] ? $value['price'] : '-',
                    $value['previous_price'] ? $value['previous_price'] : '-',
                    $value['costprice'] ? $value['costprice'] : '-',
                    $value['stock'] ? $value['stock'] : '-',
                    $value['producttat'] ? $value['producttat'] : '-',
                    $status,
                ];
                $exportData[] = $rowData;
                if($value['get_product_attribute']){
                    foreach($value['get_product_attribute'] as $attr){
                        
                        $psku = $attr['product_sku'];
                        $attrcolor = $attr['attr_color'];
                        $response2 = DB::select("SELECT color, attr_color_code  FROM product_attr_gallery WHERE pid = '$psku' AND color = '$attrcolor'");
                    
                        $rowData = [
                            $attr['attr_sku'] ? $attr['attr_sku'] : '-',
                            
                            $value['title'] ? str_replace(',', ' ', $value['title']) : '-',
                            $value['category'] ? $response[0]->name : '-',
                            
                            $value['premiumtype'] ? $value['premiumtype'] : '-',
                            $value['shape'] ? $value['shape'] : '-',
                            
                            $attr['attr_color'] ? $attr['attr_color'] : '-',
                            
                            $value['gender'] ? $value['gender'] : '-',
                            $value['brandname'] ? $value['brandname'] : '-',
                            $value['modelno'] ? $value['modelno'] : '-',
                            
                            $response2 ? $response2[0]->attr_color_code : '-',
                            
                            $value['sellername'] ? $value['sellername'] : '-',
                            $value['framematerial'] ? $value['framematerial'] : '-',
                            $value['framewidth'] ? $value['framewidth'] : '-',
                            $value['templematerial'] ? $value['templematerial'] : '-',
                            $value['templecolor'] ? $value['templecolor'] : '-',
                            $value['frametype'] ? $value['frametype'] : '-',
                            $value['lensmaterialtype'] ? $value['lensmaterialtype'] : '-',
                            $value['color'] ? $value['color'] : '-',
                            $value['lenstechnology'] ? str_replace(',', ' ', $value['lenstechnology']) : '-',
                            $value['manufracturer'] ? $value['manufracturer'] : '-',
                            $value['warrentytype'] ? $value['warrentytype'] : '-',
                            
                            $attr['attr_size'] ? $attr['attr_size'] : '-',
                            
                            $value['weight'] ? $value['weight'] : '-',
                            $value['height'] ? $value['height'] : '-',
                            $value['packweight'] ? $value['packweight'] : '-',
                            $value['packwidth'] ? $value['packwidth'] : '-',
                            $value['packlength'] ? $value['packlength'] : '-',
                            $value['countryoforigin'] ? $value['countryoforigin'] : '-',
                            $value['hsncode'] ? $value['hsncode'] : '-',
                            $value['price'] ? $value['price'] : '-',
                            
                            $attr['attr_mrp'] ? $attr['attr_mrp'] : '-',
                            $attr['attr_price'] ? $attr['attr_price'] : '-',
                            $attr['attr_qty'] ? $attr['attr_qty'] : '-',
                            
                            $value['producttat'] ? $value['producttat'] : '-',
                            $status
                            
                        ];
                        $exportData[] = $rowData;
                    }
                }
            }
            else if($value['category'][0] == 87 || $value['category'][0] == 445){
                $rowData = [
                    $value['productsku'],
                    $value['title'] ? str_replace(',', ' ', $value['title']) : '-',
                    $value['category'] ? $response[0]->name : '-',
                    $value['brandname'] ? $value['brandname'] : '-',
                    $value['netquntity'] ? $value['netquntity'] : '-',
                    $value['shelflife'] ? $value['shelflife'] : '-',
                    $value['colorcode'] ? $value['colorcode'] : '-',
                    $value['productcolor'] ? $value['productcolor'] : '-',
                    $value['manufracturer'] ? $value['manufracturer'] : '-',
                    $value['warrentytype'] ? $value['warrentytype'] : '-',
                    $value['weight'] ? $value['weight'] : '-',
                    $value['packweight'] ? $value['packweight'] : '-',
                    $value['packwidth'] ? $value['packwidth'] : '-',
                    $value['packlength'] ? $value['packlength'] : '-',
                    $value['countryoforigin'] ? $value['countryoforigin'] : '-',
                    $value['hsncode'] ? $value['hsncode'] : '-',
                    $value['price'] ? $value['price'] : '-',
                    $value['previous_price'] ? $value['previous_price'] : '-',
                    $value['costprice'] ? $value['costprice'] : '-',
                    $value['stock'] ? $value['stock'] : '-',
                    $value['producttat'] ? $value['producttat'] : '-',
                    $status,
                ];
                $exportData[] = $rowData;
                if($value['get_product_attribute']){
                    foreach($value['get_product_attribute'] as $attr){
                        
                        $psku = $attr['product_sku'];
                        $attrcolor = $attr['attr_color'];
                        $response2 = DB::select("SELECT color, attr_color_code  FROM product_attr_gallery WHERE pid = '$psku' AND color = '$attrcolor'");
                    
                        $rowData = [
                            $attr['attr_sku'] ? $attr['attr_sku'] : '-',
                            
                            $value['title'] ? str_replace(',', ' ', $value['title']) : '-',
                            $value['category'] ? $response[0]->name : '-',
                            
                            $value['brandname'] ? $value['brandname'] : '-',
                            
                            $value['netquntity'] ? $value['netquntity'] : '-',
                            $value['shelflife'] ? $value['shelflife'] : '-',
                            
                            $response2 ? $response2[0]->attr_color_code : '-',
                            $attr['attr_color'] ? $attr['attr_color'] : '-',
                            
                            $value['manufracturer'] ? $value['manufracturer'] : '-',
                            $value['warrentytype'] ? $value['warrentytype'] : '-',
                            $value['weight'] ? $value['weight'] : '-',
                            $value['packweight'] ? $value['packweight'] : '-',
                            $value['packwidth'] ? $value['packwidth'] : '-',
                            $value['packlength'] ? $value['packlength'] : '-',
                            $value['countryoforigin'] ? $value['countryoforigin'] : '-',
                            $value['hsncode'] ? $value['hsncode'] : '-',
                            $value['price'] ? $value['price'] : '-',
                            
                            $attr['attr_mrp'] ? $attr['attr_mrp'] : '-',
                            $attr['attr_price'] ? $attr['attr_price'] : '-',
                            $attr['attr_qty'] ? $attr['attr_qty'] : '-',
                            
                            $value['producttat'] ? $value['producttat'] : '-',
                            $status
                        ];
                        $exportData[] = $rowData;
                    }
                }
            }
            else{
                //
            }
        }
        return $exportData;
    }
    
    // End Excel Sheet  
    // End Attribute Color
    
    
    // Create Vendor Product By Admin

    public function getVendorProduct() {
        if(!in_array('N', session()->get('role')['role_actions']['pl'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        // $vendor_na = DB::table("vendor_profiles")->where("status",2)->get()->toArray();
        $vendor_na = DB::select("SELECT * FROM `vendor_profiles` where status=2  ORDER BY `vendor_profiles`.`shop_name` DESC");
        $category = DB::select("SELECT * FROM `categories` where role='main'");
        $count_origin = DB::table("country_of_origin")->select("name")->get()->toArray();
        $frame_shap = DB::table("frame_shape")->where("status",1)->select("name")->get()->toArray();
        $frame_materi = DB::table("frame_material")->where("status",1)->select("name")->get()->toArray();
        $frame_col = DB::table("frame_color")->where("status",1)->select("name")->get()->toArray();
        $brand_na = DB::table("brand_name")->select("name")->get()->toArray();
        $lens_mate= DB::table("lens_material")->select("name")->get()->toArray();
        $package= DB::table("packaging")->get()->toArray();
        // $color_n = DB::table("color_name")->get()->toArray();
        $lenses_data = DB::table('lenses_data')->get()->toarray();
        $lens_tech = DB::select("SELECT * FROM `lens_technology` where status=1");
        $lens_ind = DB::table("lens_index")->where("status", 1)->get()->toArray();
        $len_typ = DB::table("lens_type")->where("status",1)->get()->toArray();
        $new_lens_tp = DB::table("contact_lens_type")->where("status",1)->get()->toArray();
        $frame_rim_t = DB::table("frame_rim_type")->where("status",1)->get()->toArray();
        $countryorigin = DB::table("country_of_origin")->get()->toArray();
        $gender = DB::table("gender")->get()->toArray();
        $lenscoating = DB::table('lens_coating')->get()->toarray();
        $contact_lens = DB::table('contact_lens_data')->get()->toarray();
        $disposability = DB::table('disposability')->get()->toarray();
        $lens_color = DB::table('lens_color')->get()->toarray();
        $contact_lens_color = DB::table('contact_lens_color')->get()->toarray();
        return view("admin.adminVendorProductAdd", compact("vendor_na","category","contact_lens", "lens_color", "disposability", "contact_lens_color", "lenscoating",
        "lenses_data", "count_origin", "frame_shap", "frame_materi", "frame_col","brand_na","lens_mate","package","lens_tech","lens_ind",
        "len_typ","new_lens_tp","frame_rim_t","countryorigin","gender"));
    }
    
    public function store(Request $request) {
        if(!in_array('N', session()->get('role')['role_actions']['pl'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $this->validate($request, [
            'photo' => 'required|mimes:jpeg,jpg,png,gif',
            'productsku' => 'required|max:255|unique:products',
            'title' => 'required|max:255',
            'mainid' => 'required|max:255',
            'previous_price' => 'required',
            'gallery.*' => 'image',
            'video' => 'mimes:mp4',
        ]);
        
        $form_data = $request->all();   // save form data in a variable
        $sub_catg = $request->input('subid');  
        $sub_new = implode(',', $sub_catg);    
        $child = $request->input('childid');
        $childnew = implode(',', $child);
        $vendId = $request->input('vendorid');
        $vendor = DB::table('vendor_profiles')->select('shop_name')->where('id',$vendId)->get();
        $vandor_name = $vendor[0]->shop_name;
        
        if($request->input('color') != '') {
            $color = $request->input('color');
        }else {
            $color = '';
        }
        
        if($request->input('framecolor') != '') {
            $framecolor = $request->input('framecolor');
        }else {
            $framecolor = '';
        }
        
        if($request->input('diameter') != '') {
            $dia = $request->input('diameter');
            $dianew = implode(',',$dia);
        }else {
            $dianew = '';
        }
        
        if($request->input('powermin') != '') {
            $powermin = $request->input('powermin');
            $powernewmin = implode(',',$powermin);
        } else {
            $powernewmin = '';
        }
        
        if($request->input('powermax') != '') {
            $powermax = $request->input('powermax');
            $powernewmax = implode(',',$powermax);
        }else {
            $powernewmax = '';
        }
        
        if($request->input('axisnew') != '') {
            $axis= $request->input('axisnew');
            $axisneww = implode(',',$axis);
        }else {
            $axisneww = '';
        }
        
        if($request->input('cylindernew') != '') {
            $cylinder = $request->input('cylindernew');
            $cylinderneww = implode(',',$cylinder);
        }else {
            $cylinderneww = '';
        }
        
        if($request->input('basecurve') != '') {
            $base = $request->input('basecurve');
            $basecurvenew = implode(',',$base);
        }else {
            $basecurvenew = '';
        }
        
        if($request->input('addpower') != '') {
            $addpowerr = $request->input('addpower');
            $addnew = implode(',',$addpowerr);
        }else {
            $addnew = '';
        }

        if($request->input('lenscolor') != '') {
            $lenscolor = $request->input('lenscolor');
        }else {
            $lenscolor = '';
        }
        
        if($request->input('axisnlens') != '') {
            $axislens= $request->input('axisnlens');
            $axisnlenseww = implode(',',$axislens);
        }else {
            $axisnlenseww = '';
        }
        
        if($request->input('cylinderlens') != '') {
            $cylinderlens = $request->input('cylinderlens');
            $cylinderlensneww = implode(',',$cylinderlens);
        }else {
            $cylinderlensneww = '';
        }
        
        if($request->input('addpowerlens') != '') {
            $addpowerrlens = $request->input('addpowerlens');
            $addpowerrlensnew = implode(',',$addpowerrlens);
        }else {
            $addpowerrlensnew = '';
        }
        
        if($request->input('diameterlens') != '') {
            $diameterlens = $request->input('diameterlens');
            $diameterlensnew = implode(',',$diameterlens);
        }else {
            $diameterlensnew = '';
        }
        
        if($request->input('sphere') != '') {
            $sphere = $request->input('sphere');
            $spherenew = implode(',',$sphere);
        }else {
            $spherenew = '';
        }
        
        $lens_new = $request->input('lenstechnology');
        $coat_new = $request->input('coating');
        $gender_new = $request->input('gender');
        
        
        $data = new Product();
        $data->fill($form_data);
        $data->category = $request->mainid;
        $data['entry_by'] = Auth::user()->username;
        $data['subid'] = $sub_new;
        $data['childid'] = $childnew;
        $data['vendorid'] = $vendId;
        $data['vendor_name'] = $vandor_name;
        $data['diameter'] = $dianew;
        $data['powermin'] = $powernewmin;
        $data['powermax'] = $powernewmax;
        $data['axisnew'] = $axisneww;
        $data['approved'] = 'yes';
        $data['owner'] = 'vendor';
        $data['status'] = 1;
        $data['cylindernew'] = $cylinderneww;
        $data['basecurve'] = $basecurvenew;
        $data['addpower'] = $addnew;
        $data['axisnlens'] = $axisnlenseww;
        $data['cylinderlens'] = $cylinderlensneww;
        $data['addpowerlens'] = $addpowerrlensnew;
        $data['diameterlens'] = $diameterlensnew;
        $data['sphere'] = $spherenew;

        $data['colorcode'] = $request->input('colorcode') ? $request->input('colorcode') : '';
        $data['productdimension'] = $request->input('productdimension') ? $request->input('productdimension') : '';
        $data['packweight'] = $request->input('packweight') == '' ? 'NULL' : $request->input('packweight');
        $data['packwidth'] = $request->input('packwidth') == '' ? 'NULL' : $request->input('packwidth');
        $data['packheight'] = $request->input('packheight') == '' ? 'NULL' : $request->input('packheight');
        $data['packlength'] = $request->input('packlength') == '' ? 'NULL' : $request->input('packlength');
        $data['usagesduration'] = $request->input('usagesduration') == '' ? 'NULL' : $request->input('usagesduration');
        
        $data['color'] = $color;
        $data['framecolor'] = $framecolor;
        
        if (!empty($lens_new)) {
            $lenstechnologynew = implode(',',$lens_new );
            $data['lenstechnology'] = $lenstechnologynew;
        }
        if (!empty($coat_new)) {
           $coatingnew = implode(',',$coat_new);
           $data['coating'] =  $coatingnew;
        }
        if (!empty($gender_new)) {
           $gendernew = implode(',',$gender_new);
           $data['gender'] =  $gendernew;
        }
        if ($file = $request->file('photo')){
            $photo_name = time().$request->file('photo')->getClientOriginalName();
            $file->move('assets/images/products',$photo_name);
            $data['feature_image'] = $photo_name;
        }
        if ($request->featured == 1){
            $data->featured = 1;
        }
        if ($request->tranding == 1){
            $data->tranding = 1;
        }
        if ($request->latest == 1){
            $data->latest = 1;
        }
        if ($request->selected == 1){
            $data->selected = 1;
        }
        if ($file = $request->file('video')){
            $video_name = time().$request->file('video')->getClientOriginalName();
            $file->move('assets/images/products',$video_name);
            $data['video'] = $video_name;
        }
        if ($file = $request->file('video1')){
            $video_name = time().$request->file('video1')->getClientOriginalName();
            $file->move('assets/images/products',$video_name);
            $data['video1'] = $video_name;
        }
        if ($file = $request->file('video2')){
            $video_name = time().$request->file('video2')->getClientOriginalName();
            $file->move('assets/images/products',$video_name);
            $data['video2'] = $video_name;
        }
        $data->save();
        $lastid = $data->id;

        if ($files = $request->file('gallery')){
            foreach ($files as $file){
                $gallery = new Gallery;
                $image_name = str_random(2).time().$file->getClientOriginalName();
                $file->move('assets/images/gallery',$image_name);
                $gallery['image'] = $image_name;
                $gallery['productid'] = $lastid;
                $gallery->save();
            }
        }
        
        // Product Attribute Start here --------------------

        $attSku = $request->input('att_pro_sku');
        if(isset($attSku[0])){
            for($i=0;$i<count($attSku); $i++) {
                if($attSku[$i] != '') {
                    $subdata = new ProductAttr();
                    $attrSize = $request->input('attr_pro_size');
                    $attrQty = $request->input('attr_pro_qty');
                    $attrMrp = $request->input('attr_mrp');
                    $attrPrice = $request->input('attr_pro_price');
                    $attrColor = $request->input('attr_pro_color');
                    $subdata['product_id'] = $lastid;
                    $subdata['product_sku'] = $request->productsku;
                    $subdata['attr_sku'] = $attSku[$i];
                    $subdata['attr_size'] = isset($attrSize[$i]) ? $attrSize[$i] : '';
                    $subdata['attr_qty'] = $attrQty[$i];
                    $subdata['attr_mrp'] = $attrMrp[$i];
                    $subdata['attr_price'] = $attrPrice[$i];
                    $subdata['attr_color'] = $attrColor[$i];
                    $subdata->save();
                }
               
            }
        }
        Session::flash('message', 'Successfully Added New Vendor Product By Admin !!');
        return response()->json(['status'=>'success', 'message'=>'Successfully Added New Vendor Product By Admin !!']);
    }
    // End Create Vendor Product By Admin


    // Update Vendor Product By Admin
    public function editVendorProduct($id) {
        $vendor_shop_name = DB::select("SELECT vendor_profiles.shop_name FROM `products` LEFT JOIN vendor_profiles on vendor_profiles.id = products.vendorid WHERE products.id = $id");
        $product = Product::findOrFail($id);
        $demo = $product->subid;
        $demo_new = explode(',',$demo);
        $lense = $product->lenstechnology;
        $lens_new = explode(',',$lense);
        $coat = $product->coating;
        $coat_new = explode(',',$coat);
        $gendernew = $product->gender;
        $gender_new = explode(',',$gendernew);
        $d = $product->childid;
        $dd = explode(',',$d);
        $maincategory = DB::table("categories")->where("role","main")->where("id",$product->category)->get();
        $subs = Category::where('role','sub')->where('mainid',$product->category[0])->get();
        $child = Category::where('role','child')->whereIn('subid',$demo_new)->get();
        $gallery = Gallery::where('productid',$id)->get();
        $countryoforigin = DB::table('country_of_origin')->select('name')->get();
        $attrData = DB::table('product_attrs')->where('product_id', $id)->get();

        $attrColor = DB::table('product_attr_gallery')->select('color')->distinct()->where('pid', (string)$product->productsku)->get();
        $lenses_data = DB::table('lenses_data')->get()->toarray();
        $brand_data = DB::table('brand_name')->get()->toarray();
        $frame_material = DB::table('frame_material')->get()->toarray();
        $lens_material = DB::table('lens_material')->get()->toarray();
        $lenstechnology = DB::table('lens_technology')->get()->toarray();
        $lenscoating = DB::table('lens_coating')->get()->toarray();
        $contact_lens = DB::table('contact_lens_data')->get()->toarray();
        return view('admin.adminVendorProductEdit',compact('id','vendor_shop_name','product','maincategory','child','subs','gallery','countryoforigin','dd','demo_new', 'attrData', 'attrColor', 'lenses_data', 'brand_data', 'frame_material','lens_material','lenstechnology', 'lenscoating','contact_lens'));
    }

    public function updateVendorProduct(Request $request) {
        if(!in_array('U', session()->get('role')['role_actions']['pl'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $id = $request->id;
        $this->validate($request, [
            'photo' => 'max:400',
            'productsku' => 'required|max:255',
            'title' => 'required|max:255',
            'description' => 'required|max:3000',
            'gallery' => 'max:400',
            'video' => 'mimes:mp4|max:8000',
        ]);
     
        $product = Product::findOrFail($id);
        $productattr = DB::table('product_attrs')->where('product_id',$id)->get();
        $input = $request->all();

        $sub_catg = $request->input('subid');
        $sub_new = implode(',', $sub_catg);
      
        $child = $request->input('childid');
        $childnew = implode(',', $child);
        
        $vendId = $request->input('vendorid');
        $vendor_name = $request->input('vendor_name');
        $owner = $request->input('owner');

        if($request->input('lenstechnology') != '') {
            $lens_new = $request->input('lenstechnology');
            $lenstechnologynew = implode(',',$lens_new);
        }
        else {
            $lenstechnologynew = '';
        }
        
        if($request->input('diameter') != '') {
            $dia = $request->input('diameter');
            $dianew = implode(',',$dia);
        }
        else {
            $dianew = '';
        }
        
        if($request->input('powermin') != '') {
            $powermin = $request->input('powermin');
            $powerminnew = implode(',',$powermin);
        }
        else {
            $powerminnew = '';
        }
        
        if($request->input('powermax') != '') {
            $powermax = $request->input('powermax');
            $powermaxnew = implode(',',$powermax);
        }
        else {
            $powermaxnew = '';
        }
        
        if($request->input('axisnew') != '') {
            $axis= $request->input('axisnew');
            $axisneww = implode(',',$axis);
        }
        else {
            $axisneww = '';
        }
        
        if($request->input('cylinderlens') != '') {
            $cylinderlens = $request->input('cylinderlens');
            $cylinderlensneww = implode(',', array_unique($cylinderlens));
        }else {
            $cylinderlensneww = '';
        }
        
        if($request->input('axisnlens') != '') {
            $axislens= $request->input('axisnlens');
            $axisnlenseww = implode(',',array_unique($axislens));
        }else {
            $axisnlenseww = '';
        }
        
        if($request->input('sphere') != '') {
            $sphere = $request->input('sphere');
            $spherenew = implode(',',array_unique($sphere));
        }else {
            $spherenew = '';
        }
        
        if($request->input('addpowerlens') != '') {
            $addpowerrlens = $request->input('addpowerlens');
            $addpowerrlensnew = implode(',',array_unique($addpowerrlens));
        }else {
            $addpowerrlensnew = '';
        }
        
        if($request->input('diameterlens') != '') {
            $diameterlens = $request->input('diameterlens');
            $diameterlensnew = implode(',',$diameterlens);
        }else {
            $diameterlensnew = '';
        }
        
        
        if($request->input('cylindernew') != '') {
            $cylinder = $request->input('cylindernew');
            $cylinderneww = implode(',',$cylinder);
        }
        else {
            $cylinderneww = '';
        }
        
        if($request->input('basecurve') != '') {
            $base = $request->input('basecurve');
            $basecurvenew = implode(',',$base);
        }
        else {
            $basecurvenew = '';
        }

        if($request->input('addpower') != '') {
            $addpowerr = $request->input('addpower');
            $addnew = implode(',',$addpowerr);
        }
        else {
            $addnew = '';
        }
        
        if($request->input('coating') != '') {
            $coating = $request->input('coating');
            $addnewcoating = implode(',',$coating);
        }
        else {
            $addnewcoating = '';
        }

        $input['coating'] = $addnewcoating;
        $input['category'] = $request->mainid;
        $input['subid'] =  $sub_new;
        $input['childid'] = $childnew;
        $input['vendorid'] = $vendId;
        $input['vendor_name'] = $vendor_name;
        $input['owner'] = $owner;
        $input['axisnew'] = $axisneww;
        $input['diameter'] = $dianew;
        $input['powermin'] = $powerminnew;
        $input['powermax'] = $powermaxnew;
        $input['cylindernew'] = $cylinderneww;
        $input['basecurve'] = $basecurvenew;
        $input['addpower'] = $addnew;
        $input['cylinderlens'] = $cylinderlensneww;
        $input['axisnlens'] = $axisnlenseww;
        $input['sphere'] = $spherenew;
        $input['addpowerlens'] = $addpowerrlensnew;
        $input['diameterlens'] = $diameterlensnew;
        $input['lenstechnology'] = $lenstechnologynew;
        
        if ($file = $request->file('photo')){
            $photo_name = time().$request->file('photo')->getClientOriginalName();
            $file->move('assets/images/products',$photo_name);
            $input['feature_image'] = $photo_name;
        }

        if ($request->galdel == 1){
            $gal = Gallery::where('productid',$id);
            $gal->delete();
        }

        if ($request->featured == 1){
            $input['featured'] = 1;
        }else{
            $input['featured'] = 0;
        }

        if ($request->latest == 1){
            $input['latest'] = 1;
        }else{
            $input['latest'] = 0;
        }

        if ($request->tranding == 1){
            $input['tranding'] = 1;
        }else{
            $input['tranding'] = 0;
        }

        if ($request->selected == 1){
            $input['selected'] = 1;
        }else{
            $input['selected'] = 0;
        }

        if ($file = $request->file('video')){
            $video_name = time().$request->file('video')->getClientOriginalName();
            $file->move('assets/images/products',$video_name);
            $input['video'] = $video_name;
        }

        if ($file = $request->file('video1')){
            $video_name = time().$request->file('video1')->getClientOriginalName();
            $file->move('assets/images/products',$video_name);
            $input['video1'] = $video_name;
        }
        
        if ($file = $request->file('video2')){
            $video_name = time().$request->file('video2')->getClientOriginalName();
            $file->move('assets/images/products',$video_name);
            $input['video2'] = $video_name;
        }
        
        $product->update($input);
        $pid = $product->id;
        if ($files = $request->file('gallery')){
            foreach ($files as $file){
                $gallery = new Gallery;
                $image_name = str_random(2).time().$file->getClientOriginalName();
                $file->move('assets/images/gallery',$image_name);
                $gallery['image'] = $image_name;
                $gallery['productid'] = $id;
                $gallery->save();
            }
        }
        
        // delete functionality for attribute images and product attributes
        $dataimg = $request->input('removeimg');
        if($dataimg){
            for($k=0;$k<count($dataimg); $k++){
                $delete = ProductGallery::findOrFail($dataimg[$k]);
                try {
                    unlink("assets/images/product_attr/".$delete->attr_imgs);
                } catch (\Exception $e) {
                    //
                }
                $delete->delete();
            }
        }
        $gal = ProductAttr::where('product_id',$id);
        $gal->delete();
        $attSku = $request->input('att_pro_sku');
        if(isset($attSku)){
            for($i=0;$i<count($attSku); $i++) {
                if($attSku[$i] != ''){
                    $subdata = new ProductAttr();
                    $attrSize = $request->input('attr_pro_size');
                    $attrQty = $request->input('attr_pro_qty');
                    $attrMrp = $request->input('attr_mrp');
                    $attrPrice = $request->input('attr_pro_price');
                    $attrColor = array_filter($request->input('attr_pro_color'));
                    $subdata['product_id'] = $id;
                    $subdata['product_sku'] = $request->productsku;
                    $subdata['attr_sku'] = $attSku[$i];
                    $subdata['attr_size'] = isset($attrSize[$i]) ? $attrSize[$i] : '';
                    $subdata['attr_qty'] = $attrQty[$i];
                    $subdata['attr_mrp'] = $attrMrp[$i];
                    $subdata['attr_price'] = $attrPrice[$i];
                    $subdata['attr_color'] = $attrColor[$i];
                    $subdata->save();
                }
            }
        }
        Session::flash('message', 'Successfully Updated Vendor Product By Admin !!');
        return response()->json(['status'=>'success', 'message'=>'Successfully Updated Vendor Product By Admin !!']);
    }
    // End Update Vendor Product By Admin

    public function vendor_product_view($id){
        $product = Product::findOrFail($id);
        $vendor = DB::select("SELECT vendor_profiles.shop_name FROM `products` LEFT JOIN vendor_profiles ON vendor_profiles.id = products.vendorid where products.id = $id");
        $vendor_shop_name = $vendor[0]->shop_name;
        $demo = $product->subid;
        $demo_new = explode(',',$demo);
        $demo2 = $product->childid;
        $demo_new2 = explode(',',$demo2);
        $lense = $product->lenstechnology;
        $lens_new = explode(',',$lense);
        $coat = $product->coating;
        $coat_new = explode(',',$coat);
        $gendernew = $product->gender;
        $gender_new = explode(',',$gendernew);
        $d = $product->childid;
        $dd = explode(',',$d);
        $subs = Category::where('role','sub')->where('mainid', $product->category[0])->get();
        $child = Category::where('role','child')->whereIn('id',$demo_new2)->get();
        $gallery = Gallery::where('productid',$id)->get();
        $categories = Category::where('role','main')->where('id', $product->category[0])->get()->toArray();
        $countryoforigin = DB::table('country_of_origin')->select('name')->get();
        $attrData = DB::table('product_attrs')->where('product_id', $id)->get();
        $attrColor = DB::table('product_attr_gallery')->select('color')->distinct()->where('pid', (string)$product->productsku)->get();
        return view('admin.adminVendorProductView', compact('product', 'vendor_shop_name', 'categories', 'dd', 'subs', 'demo_new', 'child', 'gallery', 'attrData', 'attrColor'));
    
        $html = '';
        $html .='<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <form method="get" action="">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Rejection Note</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="item form-group" id="productskunew">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productsku"> Vendor Name</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="vendor_name" value="'. $vendor .'" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="item form-group" id="productskunew">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="productsku"> Product Sku</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="productsku" value="'. $product->productsku .'" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="item form-group" id="titlenew">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Product Name</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="name" class="form-control col-md-7 col-xs-12" value="'. $product->title .'" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="item form-group" id="titledescriptionnew">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="titledescription">Product Name Description</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="titledescription" class="form-control col-md-7 col-xs-12" value="'. $product->titledescription .'" placeholder="Product Description" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Main Category</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="maincats" class="form-control col-md-7 col-xs-12" value="'. $categories[0]['name'] . '" type="text" readonly>
                                        </div>
                                    </div>
                                    
                                    <div class="item form-group" id="premiumtypenew">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shape">Premium Brands Type </label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="premiumtype" class="form-control col-md-7 col-xs-12" value="'. $product->premiumtype .'" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Sub Category</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select>';
                                                foreach($subcategory as $key=>$val){
                                                    if(in_array($val->id, $subid)){
                                                        $html =' <option value="' . $val->id . '" selected>"'. $val->name .'"</option>';
                                                    }
                                                }
                                                $html =' </select>
                                        </div>
                                    </div>

                                    <div class="item form-group">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Child Category</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <select>';
                                                foreach($childcategory as $key=>$val){
                                                    if(in_array($val->id, $childid)){
                                                        $html =' <option value="' . $val->id . '" selected>"'. $val->name .'"</option>';
                                                    }
                                                }
                                                $html =' </select>
                                        </div>
                                    </div>
                                    <div class="item form-group" id="shapenew">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="shape">Frame Shape</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="shape" class="form-control col-md-7 col-xs-12" name="titledescription" value="'. $product->shape .'" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="item form-group" id="colornew">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="color">Frame Color</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="framecolor" class="form-control col-md-7 col-xs-12" value="'. $product->framecolor .'" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="item form-group" id="gendernew">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="gender">Gender</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="gender" class="form-control col-md-7 col-xs-12" value="'. $product->gender .'" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="item form-group" id="brandnamenew">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="brandname">Brand Name</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="brandname" value="'.$product->brandname.'" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                        </div>
                                    </div>

                                    <hr>
                                    <!-- Start new input fields added as per category  -->

                                    <div class="item form-group" id="lenstypenew">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="lenstype">Lens Type</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="lenstype" class="form-control col-md-7 col-xs-12" value="'.$product->lenstype.'" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="item form-group" id="modelnonew">
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="modelno"> Model No <span class="required" style="color:red;">*</span></label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="modelno" value="'.$product->modelno.'" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="item form-group" id="framewidthnew"><span class="required">MM</span>
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="framewidth">Frame Width</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12" style="display:flex;">
                                            <input id="framewidth" value="'.$product->framewidth.'" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="item form-group" id="heightnew"><span class="required">MM</span>
                                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="height">Frame Height</label>
                                        <div class="col-md-6 col-sm-6 col-xs-12">
                                            <input id="height" value="'.$product->height.'" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                        </div>
                                    </div>

                                    <div class="item form-group" id="usagesdurationnew">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="usagesduration"> Usages Duration</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="usagesduration" value="'.$product->usagesduration.'" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                    </div>
                                </div>
    
                                <div class="item form-group" id="colorcodenew">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="colorcode">Color Code</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="colorcode" value="'.$product->colorcode.'" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                    </div>
                                </div>
    
                                <div class="item form-group" id="sellernamenew">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sellername">Seller Name</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input id="sellername" value="'.$product->sellername.'" class="form-control col-md-7 col-xs-12" type="text" readonly>
                                    </div>
                                </div>
                                
                                <div class="item form-group" id="addpowerlenss">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="addpowerlens">Add Power</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">';
                                            $addpowerlens = $product->add;
                                        $html = '<select class="form-control" id="addpowerlens" readonly>';
                                             for($i=0; $i< count($arrSpecialityaddpowerlens); $i++){ 
                                                $html = '<option value="{{ $arrSpecialityaddpowerlens[$i] }}">{{ $arrSpecialityaddpowerlens[$i] }}</option>';
                                            } 
                                        $html = '</select>
                                    </div>
                                </div>
                                <div class="item form-group" id="diameterlenss">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="diameterlens">Lens DIA</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        
                                         <select class="form-control" id="diameterlens" readonly>
                                            <?php for($i=0; $i< count($arrSpecialitydiameterlens); $i++){ ?>
                                                <option value="{{ $arrSpecialitydiameterlens[$i] }}">{{ $arrSpecialitydiameterlens[$i] }}</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="item form-group" id="spheres">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="sphere">sphere**</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        
                                         <select class="form-control" id="sphere" readonly>
                                            <?php for($i=0; $i< count($arrSpecialitysphere); $i++){ ?>
                                                <option value="{{ $arrSpecialitysphere[$i] }}">{{ $arrSpecialitysphere[$i] }}</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group" id="axisnlenss">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="axisnlens">Axis</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        
                                         <select class="form-control" id="axisnlens" readonly>
                                            <?php for($i=0; $i< count($arrSpecialityaxisnlens); $i++){ ?>
                                                <option value="{{ $arrSpecialityaxisnlens[$i] }}">{{ $arrSpecialityaxisnlens[$i] }}</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="item form-group" id="cylinderlenss">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" for="cylinderlens">Cylinder</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        
                                         <select class="form-control" id="cylinderlens" readonly>
                                            <?php for($i=0; $i< count($arrSpecialitycylinders); $i++){ ?>
                                                <option value="{{ $arrSpecialitycylinders[$i] }}">{{ $arrSpecialitycylinders[$i] }}</option>
                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>
    
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                ';
        
        
    }

    public function attr_color_list()  {
        $list = array();
        $count = 0;
        if($_POST['product_id'] != ''){
            $list = ProductGallery::orderBy('id','desc')->where('pid', $_POST['product_id'])->get();
            $count = ProductGallery::orderBy('id','desc')->where('pid', $_POST['product_id'])->count();
        }
        
        $data = array();
        $no = $_POST['start'];
                                
        $count_rows = 1;
        foreach ($list as $val) {
            $no++;
            $row = array();
            $row[] = $count_rows;
            $row[] = $val->color;
            $row[] = $val->attr_color_code;
            $row[] = '<img width="50" height="50" src="'.url("assets/images/product_attr")."/".$val->attr_imgs.'">';
            $data[] = $row; 
            
            $count_rows++;
        }

        $output = array(
            "draw" => $_POST['draw'],
            "recordsTotal" => $count,
            "recordsFiltered" => $count,
            "data" => $data,
        );
        echo json_encode($output);
    }
    
}
