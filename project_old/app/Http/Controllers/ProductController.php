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

class ProductController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        if(!in_array('PL', explode(',', session()->get('role')['products']))) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $categories = DB::table('categories')->where('role', 'main')->get();
        $vendors = Product::select('vendor_name')
        ->distinct()
        ->where('approved', 'yes')
        ->whereIn('status', ['0', '1'])
        ->where('owner', 'vendor')
        ->orderBy('id', 'desc')
        ->get();
        return view('admin.productlist', compact('categories', 'vendors'));
    }

    public function add_product_color(Request $request)   {
        $newString = str_replace(' ', '-', $request->color);
        $newString = preg_replace('/[^A-Za-z0-9\-]/', '', $newString);
        $newString2 = preg_replace('/-+/', '-', $newString);
        
        if($_POST['product_id'] != ''){
            if (!empty($_FILES['images']['name'][0])) {
                $files = $request->file('images');
                if ($files){
                    $count = 0;
                    foreach ($files as $file){
                        $data = explode('.', $file->getClientOriginalExtension());
                        $filepath = 'assets/images/product_attr';
                        $galleryData = new ProductGallery();
                        $image_name = $request->product_id.'_'.$newString2."_".uniqid().".".$data[0];
                        $file->move($filepath, $image_name);
                        $galleryData['attr_imgs'] = $image_name;
                        // $galleryData['paid'] = '';
                        $galleryData['pid'] = $request->product_id;
                        $galleryData['color'] = $request->color;
                        $galleryData->save();
                    }
                    echo json_encode(array("status" => 200, 'msg' => 'Data Added !')); 
                }
            }  
        }else {
            echo json_encode(array("status" => 500, 'msg' => 'Server Error !')); 
        }
    }

    public function fetch_attr_color_list()  {
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
            $row[] = '<img width="50" height="50" src="'.url("assets/images/product_attr")."/".$val->attr_imgs.'">';
            $action_string = '
                <a type="button" name="edit" data-image="' . $val->attr_imgs . '" data-name="' . $val->color . '" data-id="' . $val->id . '" pro_id="' . $val->pro_id . '" href="javascript:void(0)" class="fa fa-edit edit_color"></a>
                <a type="button" name="delete" id="'.$val->id.'" pro_id="'.$val->pro_id.'" href="javascript:void(0)" class="fa fa-trash delete_color"></a>';
            $row[] = $action_string;
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

    public function update_attr_color_list(Request $request)
    {
        // Get the form data
        $editId = $request->input('editId');
        $colorName = $request->input('colorName');
        $colorCode = $request->input('colorCode');

        // Check if a new image is uploaded
        if ($request->hasFile('colorImage')) {
            // Delete the previous image
            $prevImage = ProductGallery::where('id', $editId)->value('attr_imgs');
            if ($prevImage) {
                $previousImagePath = public_path('images/' . $prevImage);
                if (file_exists($previousImagePath)) {
                    unlink($previousImagePath);
                }
            }


            // Upload and store the new image
            $image = $request->file('colorImage');
            $imageName = uniqid() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageName);
            ProductGallery::where('id', $editId)->update([
                'attr_imgs' => $imageName
            ]);
        }

        // Update other attributes in the database
        ProductGallery::where('id', $editId)->update([
            'color' => $colorName,
        ]);

        return response()->json(['message' => 'Color Code updated successfully']);
    }

    public function fetch_attr_color_dropdown(Request $request)  {
        $id = trim($request->id);
        $output = '<option value="">Select</option>';
        if(!empty($id)) {

             $list = DB::table('product_attr_gallery')
                ->select('color')
                ->distinct()
                ->where('pid', $id)
                ->get();
            foreach($list as $val) {
                $output .='<option value="'.$val->color.'">'.$val->color.'</option>';
            }   
        }
        echo json_encode(array("status" => 200, 'data' => $output));
    }

    public function delete_attr_color(Request $request)  {
        $id = $request->id;
        $gal = ProductGallery::where('id',$id);
        $gal->delete();
        echo json_encode(array("status" => 200, 'data' => 'Deleted Successfully !'));
    }

 
    public function pending()   {
        if(!in_array('PL', explode(',', session()->get('role')['products']))) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
       // $products = Product::where('status','2')->where('approved','no')->orderBy('id','desc')->get();
        $products = DB::table('products')
                    ->join('categories', 'categories.id', '=', 'products.category')
                    ->select('products.*', 'categories.name as category')
                    ->where('products.status','2')
                    ->where('products.approved','no')
                    ->orWhere('products.status', '=', 3)
                    ->orderBy('products.id','desc')
                    ->get();
       return view('admin.pendingproduct',compact('products'));
    }

    public function pendingdetails($id) {
        if(!in_array('PL', explode(',', session()->get('role')['products']))) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
       $product = Product::findOrFail($id);
       return view('admin.pendingdetails',compact('product'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()  {
        if(!in_array('N', session()->get('role')['role_actions']['pl'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $categories = Category::where('role','main')->get();
        $countryoforigin = DB::table('country_of_origin')->select('name')->get();
        $lenses_data = DB::table('lenses_data')->get()->toarray();
        $brand_data = DB::table('brand_name')->get()->toarray();
        $frame_material = DB::table('frame_material')->get()->toarray();
        
        $lens_material = DB::table('lens_material')->get()->toarray();
        $lenstechnology = DB::table('lens_technology')->get()->toarray();
        $lenscoating = DB::table('lens_coating')->get()->toarray();
        $frame_shape = DB::table('frame_shape')->get()->toarray();
        $frame_color = DB::table('frame_color')->get()->toarray();
        $contact_lens_data = DB::table('contact_lens_data')->get()->toarray();
        return view('admin.productadd',compact('categories','frame_shape','frame_color','countryoforigin', 'lenses_data', 'brand_data', 'frame_material','lens_material','lenstechnology', 'lenscoating', 'contact_lens_data'));
    }



    public function store(Request $request) {
        if(!in_array('N', session()->get('role')['role_actions']['pl'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $this->validate($request, [
            'photo' => 'required|mimes:jpeg,jpg,png,gif|required|max:110|dimensions:min_width=1300,min_height=1160',
            'productsku' => 'required|max:255|unique:products',
            'title' => 'required|max:255',
            'mainid' => 'required|max:255',
            'previous_price' => 'required|max:255',
            'gallery.*' => 'image|mimes:jpeg,jpg,png,gif|max:110|dimensions:min_width=1300,min_height=1160',
            'video' => 'mimes:mp4|max:8000',
        ]);
        
        $form_data = $request->all();   // save form data in a variable
        
        $sub_catg = $request->input('subid');   // get a particular field value
        $sub_new = implode(',', $sub_catg);    //convert array to string with , sperator
        $child = $request->input('childid');
        $childnew = implode(',', $child);
        
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
        $data->entry_by = Auth::user()->username;
        
        $data['subid'] = $sub_new;
        $data['childid'] = $childnew;
        $data['diameter'] = $dianew;
        $data['powermin'] = $powernewmin;
        $data['powermax'] = $powernewmax;
        $data['axisnew'] = $axisneww;
        
       
        $data['cylindernew'] = $cylinderneww;
        $data['basecurve'] = $basecurvenew;
        $data['addpower'] = $addnew;
        $data['axisnlens'] = $axisnlenseww;
        $data['cylinderlens'] = $cylinderlensneww;
        $data['addpowerlens'] = $addpowerrlensnew;
        $data['diameterlens'] = $diameterlensnew;
        $data['sphere'] = $spherenew;

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
        Session::flash('message', 'New Product Added Successfully.');
        return response()->json(['status'=>'success', 'msg'=>'New Product Added Successfully']);
      
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)  {
        if(!in_array('U', session()->get('role')['role_actions']['pl'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
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
        $subs = Category::where('role','sub')->where('mainid', $product->category[0])->get();
        $child = Category::where('role','child')->whereIn('subid',$demo_new)->get();
        $gallery = Gallery::where('productid',$id)->get();
        $categories = Category::where('role','main')->get();
        $countryoforigin = DB::table('country_of_origin')->select('name')->get();
        $attrData = DB::table('product_attrs')->where('product_id', $id)->get();
        
        $attrColor = DB::table('product_attr_gallery')->select('color')->distinct()->where('pid', (string)$product->productsku)->get();
        
        $lenses_data = DB::table('lenses_data')->get()->toarray();
        $brand_data = DB::table('brand_name')->get()->toarray();
        $frame_material = DB::table('frame_material')->get()->toarray();
        $lens_material = DB::table('lens_material')->get()->toarray();
        $lenstechnology = DB::table('lens_technology')->get()->toarray();
        $lenscoating = DB::table('lens_coating')->get()->toarray();
        
        return view('admin.productedit',compact('id','product','categories','child','subs','gallery','countryoforigin','dd','demo_new', 'attrData', 'attrColor', 'lenses_data', 'brand_data', 'frame_material','lens_material','lenstechnology', 'lenscoating'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     
    public function update(Request $request, $id)  {
        if(!in_array('U', session()->get('role')['role_actions']['pl'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        
        $id = $_POST['id'];
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
        
        $sub_catg = $request->input('subid');   // get a particular field value
        $sub_new = implode(',', $sub_catg);    //convert array to string with , sperator
      
        $child = $request->input('childid');
        $childnew = implode(',', $child);
        
        if($request->input('lenstechnology') != '') {
            $lens_new = $request->input('lenstechnology');
            $lenstechnologynew = implode(',',$lens_new);
        }
        else {
            $lenstechnologynew = '';
        }
        
        // if($request->input('gender') != '') {
        //     $gender = $request->input('gender');
        //     $gendernew = implode(',',$gender);
        // }
        // else {
        //     $gendernew = '';
        // }
        
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
        
        //new field add
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
        $input['entry_by'] = Auth::user()->username;
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
        
        // $dataproduct = $request->input('removeattr');
        // if($dataproduct){
        //     for($l=0;$l<count($dataproduct); $l++){
        //         $deleteprod = ProductAttr::findOrFail($dataproduct[$l]);
        //     }
        //     $deleteprod->delete();
        // }
        
        $gal = ProductAttr::where('product_id',$id);
        $gal->delete();

        $attSku = $request->input('att_pro_sku');
        if(isset($attSku[0])){
            for($i=0;$i<count($attSku); $i++) {
                if($attSku[$i] != ''){
                    $subdata = new ProductAttr();
                    $attrSize = $request->input('attr_pro_size');
                    $attrQty = $request->input('attr_pro_qty');
                    $attrMrp = $request->input('attr_mrp');
                    $attrPrice = $request->input('attr_pro_price');
                    $attrColor = $request->input('attr_pro_color');
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

        Session::flash('message', 'Product Updated Successfully.');
        return response()->json(['status'=>'success', 'msg'=>' Product Updated Successfully']);
    }

    public function status($id , $status)
    {
        if(!in_array('A', session()->get('role')['role_actions']['pl'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $product = Product::findOrFail($id);
        $input['status'] = $status;

        $product->update($input);
        
        Session::flash('message', 'Product Status Updated Successfully.');
        return response()->json(['status'=>'success', 'msg'=>' Product Status Updated Successfully.']);
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)  {
        if(!in_array('D', session()->get('role')['role_actions']['pl'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $product = Product::findOrFail($id);
        $gallery = Gallery::where('productid', $id)->get();
        
        foreach($gallery as $gll){
            try {
                unlink('assets/images/gallery/'.$gll->image);
            } catch (\Exception $e) {
                //
            }
            $gll->delete();
        }
        
        $datattr = ProductAttr::where('product_id', '=', $id)->get();
        
        if(isset($datattr)){
            foreach($datattr as $attr){
                $attr->delete();
            }
        }
        
        $attrgallery = ProductGallery::where('pid', $product->productsku)->get();
        
        if(isset($attrgallery)){
            foreach($attrgallery as $gallery){
                try {
                    unlink('assets/images/product_attr/'.$gallery->attr_imgs);
                } catch (\Exception $e) {
                    //
                }
                $gallery->delete();
            }
        }
        
        try {
            unlink('assets/images/products/'.$product->feature_image);
        } catch (\Exception $e) {
            //
        }
        
        try {
            unlink('assets/images/products/'.$product->video);
        } catch (\Exception $e) {
            //
        }
        
        try {
            unlink('assets/images/products/'.$product->video1);
        } catch (\Exception $e) {
            //
        }
        
        try {
            unlink('assets/images/products/'.$product->video2);
        } catch (\Exception $e) {
            //
        }
        
        $product->delete();
        
        Session::flash('message', 'Product Delete Successfully.');
        return response()->json(['status'=>'success', 'msg'=>' Product Delete Successfully.']);
    }

    public function deleteimg($id)  {
        if(!in_array('D', session()->get('role')['role_actions']['pl'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $img = Gallery::findOrFail($id);
        try {
            unlink('assets/images/gallery/'.$img->image);
        } catch (\Exception $e) {
            //
        }
        $img->delete();
        return redirect()->back();
    }
    
    public function accept($id) {
        if(!in_array('A', session()->get('role')['role_actions']['pl'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        // $vendor = Vendors::findOrFail($id);
        $product = Product::findOrFail($id);
        $product->approved = 'yes';
        $product->status=1;

        // mail($vendor->email,'Your Product is approved','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.');
        $product->update();
        return redirect('admin/products')->with('message','Product Accepted Successfully');
    }

    public function reject($id) {
        if(!in_array('C', session()->get('role')['role_actions']['pl'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $product = Product::findOrFail($id);
        $approved['status']=3;
        $product->update($approved);
        return redirect('admin/products')->with('message','Product Rejected Successfully');
    }

    public function storenote(Request $request,$id) {
        $product = Product::findOrFail($id);
        $product->note = $request->input('note');
        $product->save();
        return redirect('admin/products/pending')->with('message','Rejection Note Send to Vendor');
    }
    
    public function get_list_details(Request $request)  {
        if (count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['pl'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        $category_id = $request->input('category_id');
        $premiumtype = $request->input('premiumtype');
        // dd($category_id);

        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;

        $product_details_total = $this->get_list_data(false, $search_term, $other_configs, $category_id, $premiumtype);
        $product_details_count = $this->get_list_data(true, $search_term, $other_configs, $category_id, $premiumtype);

        $data = array();
        $i = 1;
        foreach ($product_details_total as $row => $vals) {
            $start++;
            $nestedData = array();
            $actionData = '';
            $nestedData[] = $start;
            $id = $vals->id;

            if (in_array('U', session()->get('role')['role_actions']['pl'])) {
                $actionButton = "<a href='" . url('admin/products') . '/' . $id . '/edit' . "'  class='btn btn-primary btn-xs'><i class='fa fa-edit'></i>Edit</a>&nbsp&nbsp;";
            }

            if (in_array('A', session()->get('role')['role_actions']['pl'])) {
                if ($vals->status == 1) {
                    $actionButton .= "<a href='javascript:void(0)' onclick='activeProduct(" . $id . ")'  class='btn btn-warning btn-xs'><i class='fa fa-times'></i>Deactive</a>&nbsp&nbsp;";
                }
                if ($vals->status == 2) {
                    $actionButton .= "<a href='javascript:void(0)'  class='btn btn-warning btn-xs' disabled><i class='fa fa-times'></i>Pending</a>&nbsp&nbsp;";
                } else if ($vals->status == 3) {
                    $actionButton .= "<a href='' class='btn btn-primary btn-xs' disabled><i class='fa fa-times'></i>Active</a>&nbsp&nbsp;";
                } else if ($vals->status == 0) {
                    $actionButton .= "<a href='javascript:void(0)' onclick='deactiveProduct(" . $id . ")' class='btn btn-primary btn-xs'><i class='fa fa-times'></i>Active</a>&nbsp&nbsp;";
                } else {
                    //
                }
            }

            if (in_array('D', session()->get('role')['role_actions']['pl'])) {
                $actionButton .= "<a type='button' onclick='deleteProduct(event)' data='" . $id . "'  class='btn btn-danger btn-xs'><i class='fa fa-trash'></i>Delete</a>";
            }

            $nestedData[] = $vals->owner;
            $nestedData[] = $vals->entry_by;
            $nestedData[] = $vals->title;
            $nestedData[] = $vals->productsku;
            $nestedData[] = $vals->modelno;
            $nestedData[] = $vals->costprice;
            $nestedData[] = $vals->category;
            $nestedData[] = $vals->stock;
            $nestedData[] = "<img style='max-width: 50px;' src='" . url('assets/images/products') . '/' . $vals->feature_image . "'>";
            // $nestedData[] = $vals->feature_image;
            $nestedData[] = $vals->status;
            $nestedData[] = $actionButton;

            $data[] = $nestedData;
        }
        // die();

        $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $product_details_count,
            'recordsFiltered' => $product_details_count,
            'data' => $data,
        );

        echo json_encode($output);
    }
    
    public function get_list_data($count, $search_term = '', $other_configs, $category_id = null, $premiumtype)  {
        if (!in_array('PL', explode(',', session()->get('role')['products']))) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }

        $data = DB::table('products as p')
            ->select('p.id', 'p.owner', 'p.entry_by', 'p.title', 'p.productsku', 'p.modelno', 'p.costprice', 'c.name as category', 'p.stock', 'p.feature_image', 'p.status')
            ->leftJoin('categories as c', 'p.category', '=', 'c.id')
            ->orderBy('p.id', 'desc');

        if (isset($search_term) && $search_term != "") {
            $data->where(function ($query) use ($search_term, $other_configs) {
                $query->where('p.owner', 'like', '%' . $search_term . '%');
                $query->orWhere('p.entry_by', 'like', '%' . $search_term . '%');
                $query->orWhere('p.title', 'like', '%' . $search_term . '%');
                $query->orWhere('p.productsku', 'like', '%' . $search_term . '%');
                $query->orWhere('p.modelno', 'like', '%' . $search_term . '%');
                $query->orWhere('p.price', 'like', '%' . $search_term . '%');
                $query->orWhere('p.stock', 'like', '%' . $search_term . '%');
                $query->orWhere('p.feature_image', 'like', '%' . $search_term . '%');
                $query->orWhere(function ($join) use ($search_term, $other_configs) {
                    $join->orWhere('c.name', 'like', '%' . $search_term . '%');
                });
            });
        }
        
        $data->where('p.owner', 'admin');

        // Handle the category_id filter
        if ($category_id) {
            $data->where('p.category', $category_id);
        }

        // Handle the category_id filter
        if ($premiumtype && $premiumtype != "all") {
            $data->where('p.premiumtype', $premiumtype);
        }

        if (!$count && $other_configs['length']) {
            $data->limit($other_configs['length']);
            $data->offset($other_configs['offset']);
        }

        $result = $data->get();

        $countrow = count($result);
        if ($countrow > 0) {
            if ($count) {
                return $countrow;
            } else {
                return $result;
            }
        } else {
            return $result;
        }
    }
    
    public function get_vendor_list_details(Request $request)  {
        if(count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['pl'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];

        $vendor_category = $request->input('vendor_category');
        $vendor_name = $request->input('vendor_name');
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;
        
        $product_details_total = $this->get_vendor_list_data(false, $search_term, $other_configs, $vendor_category, $vendor_name);
        $product_details_count = $this->get_vendor_list_data(true, $search_term, $other_configs, $vendor_category, $vendor_name);
        
        $data = array();
        $i = 1;
        foreach($product_details_total as $row => $vals) {
            $start++;
            $nestedData = array();
            $actionData = '';
            $nestedData[] = $start;
            $id = $vals->id;

            if(in_array('U', session()->get('role')['role_actions']['pl'])) {
                $actionButton = "<a href='" . url('admin/products'). '/'. $id . '/view' . "'  class='btn btn-primary btn-xs'><i class='fa fa-eye'></i>View</a>&nbsp&nbsp;";
            }
            
            if(in_array('A', session()->get('role')['role_actions']['pl'])) {
                if($vals->status == 1){
                    $actionButton .= "<a href='javascript:void(0)' onclick='updateProductTrade(" . $id . ")'  class='btn btn-primary btn-xs'><i class='fa fa-times'></i>Trades</a>&nbsp&nbsp;";
                    $actionButton .= "<a href='javascript:void(0)' onclick='activeProduct(" . $id . ")'  class='btn btn-warning btn-xs'><i class='fa fa-times'></i>Deactive</a>&nbsp&nbsp;";
                }
                if($vals->status == 2){
                    $actionButton .= "<a href='javascript:void(0)'  class='btn btn-warning btn-xs' disabled><i class='fa fa-times'></i>Pending</a>&nbsp&nbsp;";
                }
                else if($vals->status == 3){
                    $actionButton .= "<a href='' class='btn btn-primary btn-xs' disabled><i class='fa fa-times'></i>Active</a>&nbsp&nbsp;";
                }
                else if($vals->status == 0){
                    $actionButton .= "<a href='javascript:void(0)' onclick='deactiveProduct(" . $id . ")' class='btn btn-primary btn-xs'><i class='fa fa-times'></i>Active</a>&nbsp&nbsp;";
                }
                else{
                    //
                }
            }
            
            // if(in_array('D', session()->get('role')['role_actions']['pl'])) {
            //     $actionButton .= "<a type='button' onclick='deleteProduct(event)' data='" . $id . "'  class='btn btn-danger btn-xs'><i class='fa fa-trash'></i>Delete</a>";
            // }
            
            $nestedData[] = Vendors::findOrFail($vals->vendorid)->shop_name;
            $nestedData[] = $vals->vendor_name;
            $nestedData[] = $vals->title;
            $nestedData[] = $vals->productsku;
            $nestedData[] = $vals->modelno;
            $nestedData[] = $vals->costprice;
            $nestedData[] = $vals->category;
            $nestedData[] = $vals->stock;
            $nestedData[] = "<img style='max-width: 50px;' src='" . url('assets/images/products'). '/' . $vals->feature_image . "'>";
            // $nestedData[] = $vals->feature_image;
            if($vals->status == 0)
            {
                $nestedData[] = 'Deactive';
            }
            elseif($vals->status == 1)
            {
                $nestedData[] = 'Active';
            }
            $nestedData[] = $actionButton;
            
            $data[] = $nestedData;
        }
      
        $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $product_details_count,
            'recordsFiltered' => $product_details_count,
            'data' => $data,
        );

        echo json_encode($output);
    }
    
    public function get_vendor_list_data($count, $search_term = '', $other_configs, $vendor_category = null, $vendor_name = null)  {
        if(!in_array('PL', explode(',', session()->get('role')['products']))) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }

        $result = [];

        $data = DB::table('products as p')
                ->select('p.id','p.vendorid', 'p.owner', 'p.vendor_name', 'p.title', 'p.productsku', 'p.modelno', 'p.costprice', 'c.name as category', 'p.stock', 'p.feature_image', 'p.status')
                ->leftjoin('categories as c', 'p.category', '=', 'c.id')
                ->where('approved', 'yes')
                ->whereIn('p.status', ['0','1'])
                ->where('owner', 'vendor')
                ->orderBy('p.id', 'desc');

        if(isset($search_term) && $search_term!="") {
            $data->where(function($query) use ($search_term,$other_configs){
                $query->where('p.owner', $search_term);
                $query->orwhere('p.vendor_name', 'like', '%' . $search_term . '%');
                $query->orwhere('p.title', 'like', '%' . $search_term . '%');
                $query->orwhere('p.productsku', 'like', '%' . $search_term . '%');
                $query->orwhere('p.modelno', 'like', '%' . $search_term . '%');
                $query->orwhere('p.price', 'like', '%' . $search_term . '%');
                $query->orwhere('p.stock', 'like', '%' . $search_term . '%');
                $query->orwhere('p.feature_image', 'like', '%' . $search_term . '%');
                $query->orwhere(function($join) use ($search_term, $other_configs)
                {
                    $join->orwhere('c.name', 'like', '%' . $search_term . '%');
                });
            });
        }

        if(!$count && $other_configs['length']){
            $data->limit($other_configs['length']);
            $data->offset($other_configs['offset']);
        }

        // Handle the category_id filter
        if ($vendor_category) {
            $data->where('p.category', $vendor_category);
        }
        if ($vendor_name) {
            $data->where('p.vendor_name', $vendor_name);
        }
        
        $result = $data->get();
        
        $countrow = count($result);
        if ($countrow > 0) {
            if ($count) {
                return $countrow;
            } else {
                return $result;
            }
        } else {
            return $result;
        }
    }
    
    // Vendor Export Excel
    public function getVendorExport(Request $request)
    {
        // Fetch data for Excel export`
        $vendor_category = $request->input('vendor_category');
        $vendor_name = $request->input('vendor_name');
        $search_term = $request->input('search')['value'];
        $data = $this->get_vendor_list_data(false, $search_term, ['length' => -1, 'offset' => 0], $vendor_category, $vendor_name);

        // Create an array to hold the data for export
        $exportData = [
            ['ID', 'Vendor Name', 'Entry By', 'Product', 'SKU No', 'Model No', 'Price', 'Category', 'Stock', 'Status'],
        ];

        // Add the data rows to the exportData array
        foreach ($data as $row) {
            $status = '';
            if ($row->status == 1) {
                $status = 'Active';
            } elseif ($row->status == 0) {
                $status = 'Deactive';
            } elseif ($row->status == 2) {
                $status = 'Approved';
            } elseif ($row->status == 3) {
                $status = 'Reject';
            }

            $shop_name = Vendors::findOrFail($row->vendorid)->shop_name;
            // dd($shop_name);
            $rowData = [
                $row->id,
                $shop_name,
                $row->vendor_name,
                $row->title,
                $row->productsku,
                $row->modelno,
                $row->costprice,
                $row->category,
                $row->stock,
                $status,
            ];
            $exportData[] = $rowData;
        }

        // Generate and download the Excel file
        $filename = '';
        header('Content-Type: application/vnd.ms-excel');
        // header('Content-Disposition: attachment; filename="' . $filename . '"');
        header('Content-Disposition: attachment');
        header('Cache-Control: max-age=0');

        $fp = fopen('php://output', 'w');
        foreach ($exportData as $row) {
            fputcsv($fp, $row, "\t");
        }
        fclose($fp);
        exit();
    }
    
    public function vendor_product_update(Request $request)  {
        $id = $request->id;
        $product = Product::findOrFail($id);
        return $product;
    }
    
    public function vendorProductUpdate(Request $request) {
        $id = $_POST['id'];
        $product = Product::findOrFail($id);
        
        $input = $_POST;
        
        if(isset($input['featured'])){$data['featured'] = $input['featured'];}
        else{$data['featured'] = 0;}
        
        if(isset($input['tranding'])){$data['tranding'] = $input['tranding'];}
        else{$data['tranding'] = 0;}
        
        if(isset($input['latest'])){$data['latest'] = $input['latest'];}
        else{$data['latest'] = 0;}
        
        if(isset($input['selected'])){$data['selected'] = $input['selected'];}
        else{$data['selected'] = 0;}
        
        $product->update($data);
        
        Session::flash('message', 'Product Updated Successfully.');
        return response()->json(['status'=>'success', 'msg'=>' Product Updated Successfully']);
    }
    
    public function get_vendor_pending_list_details(Request $request) {
        if(count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['pl'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;
        
        $product_details_total = $this->get_vendor_pendig_list_data(false, $search_term, $other_configs);
        $product_details_count = $this->get_vendor_pendig_list_data(true, $search_term, $other_configs);
        
        $data = array();
        $i = 1;
        foreach($product_details_total as $row => $vals) {
            $start++;
            $nestedData = array();
            $actionData = '';
            $nestedData[] = $start;
            $id = $vals->id;

            if(in_array('U', session()->get('role')['role_actions']['pl'])) {
                $actionButton = "<a href='" . url('admin/products'). '/'. $id . '/view' . "'  class='btn btn-primary btn-xs'><i class='fa fa-eye'></i>View</a>&nbsp&nbsp;";
            }
            
            if(in_array('A', session()->get('role')['role_actions']['pl'])) {
                if($vals->status == 3){
                    if($vals->note != ''){
                        $actionButton .= "<a  data-toggle='modal' data='exampleModal' class='btn btn-danger btn-xs' disabled><i class='fa fa-times'></i> Send Rejection Note </a>";
                    }
                    else{
                        $actionButton .= "<a  data-toggle='modal' data='exampleModal' onclick='rejectNote(event, ". $vals->id .")' class='btn btn-danger btn-xs'><i class='fa fa-times'></i> Send Rejection Note </a>";
                    }
                }
                else{
                    $actionButton .= "<a href='" . url('admin/products/accept') . '/' . $vals->id . "' class='btn btn-success btn-xs'><i class='fa fa-check'></i> Accept </a>";

                    $actionButton .= "<a  href='" . url('admin/products/reject') . '/' . $vals->id . "' class='btn btn-danger btn-xs'><i class='fa fa-times'></i> Reject </a>";
                }
            }
            
            $nestedData[] = Vendors::findOrFail($vals->vendorid)->shop_name;
            $nestedData[] = $vals->vendor_name;
            $nestedData[] = $vals->title;
            $nestedData[] = $vals->costprice;
            $nestedData[] = $vals->category;
            $nestedData[] = "Pending";
            $nestedData[] = $actionButton;
            
            $data[] = $nestedData;
        }
        // die();
      
        $output = array(
            'draw' => intval($request['draw']),
            'recordsTotal' => $product_details_count,
            'recordsFiltered' => $product_details_count,
            'data' => $data,
        );

        echo json_encode($output);
    }
    
    public function get_vendor_pendig_list_data($count, $search_term = '', $other_configs, $condition = false)  {
        if(!in_array('PL', explode(',', session()->get('role')['products']))) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $result = [];
        if(isset($search_term) && $search_term!="") {
            $data = DB::table('products as p')
                ->where(function($query) use ($search_term,$other_configs){
                    $query->where('owner', $search_term);
                    $query->orwhere('p.vendor_name', 'like', '%' . $search_term . '%');
                    $query->orwhere('p.title', 'like', '%' . $search_term . '%');
                    $query->orwhere('p.productsku', 'like', '%' . $search_term . '%');
                    $query->orwhere('p.modelno', 'like', '%' . $search_term . '%');
                    $query->orwhere('p.price', 'like', '%' . $search_term . '%');
                    $query->orwhere('p.stock', 'like', '%' . $search_term . '%');
                    $query->orwhere('p.feature_image', 'like', '%' . $search_term . '%');
                    $query->orwhere(function($join) use ($search_term, $other_configs)
                    {
                        $join->orwhere('c.name', 'like', '%' . $search_term . '%');
                    });
                })
                ->select('p.id','p.vendorid', 'p.owner', 'p.vendor_name', 'p.title', 'p.note', 'p.productsku', 'p.modelno', 'p.costprice', 'c.name as category', 'p.stock', 'p.feature_image', 'p.status')
                ->join('categories as c', 'p.category', '=', 'c.id')
                ->where('approved', 'no')
                ->where('owner', 'vendor')
                ->whereIn('p.status', ['2', '3'])
                ->orderBy('p.id', 'desc');
                
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
                
                $result = $data->get();
        }
        else{
            $data = DB::table('products as p')
                    ->select('p.id','p.vendorid', 'p.owner', 'p.vendor_name', 'p.title', 'p.note', 'p.productsku', 'p.modelno', 'p.costprice', 'c.name as category', 'p.stock', 'p.feature_image', 'p.status')
                    ->leftjoin('categories as c', 'p.category', '=', 'c.id')
                    ->where('approved', 'no')
                    ->where('owner', 'vendor')
                    ->whereIn('p.status', ['2', '3'])
                    ->orderBy('p.id', 'desc');
                    
                    if(!$count && $other_configs['length']){
                        $data->limit($other_configs['length']);
                        $data->offset($other_configs['offset']);
                    }
                    
                    $result = $data->get();
        }

        if($count){
            return count($result);
        }else{
            return $result;
        }
        
    }
    
    public function vendorProductView($id)  {
        $product = Product::findOrFail($id);
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
        
        return view('admin.productview', compact('product', 'categories', 'dd', 'subs', 'demo_new', 'child', 'gallery', 'attrData', 'attrColor'));
    }

    public function fetch_attr_color_list_view()  {
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
    
    // public function exportExcel(Request $request){
    //     // Fetch data for Excel export
    //     $category_id = $request->input('category_id');
    //     $search_term = $request->input('search')['value'];
        
    //     if (!in_array('PL', explode(',', session()->get('role')['products']))) {
    //         exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
    //     }

    //     // $data = Product::where('category', $category_id)
    //     //         ->leftjoin('categories as cat', function($join) {
    //     //             $join->on('products.category', '=', 'cat.id');
    //     //         });
    //     // DB::enableQueryLog();
    //     $data = Product::where('category', $category_id);
        
    //     $data->where('owner', 'admin');

    //     $result = $data->with(['getProductAttribute','getProductAttributeColor'])->get()->toArray();

    //     foreach($result as $key => $value){
    //         $categorys = $value['category'][0];
    //         $response = DB::select("SELECT name FROM categories WHERE id IN ($categorys)");
    //         $result[$key]['category'] = $response[0]->name;
    //     }
        
    //     foreach($result as $key => $value){
    //         foreach($value['get_product_attribute'] as $ke => $attr){
    //             $psku = $attr['product_sku'];
    //             $attrcolor = $attr['attr_color'];
    //             $response = DB::select("SELECT color, attr_color_code  FROM product_attr_gallery WHERE pid = '$psku' AND color = '$attrcolor'");
    //             if($response){
    //                 $result[$key]['get_product_attribute'][$ke]['code'] = $response[0]->attr_color_code;
    //             }
    //         }
    //     }

    //     return $result;
    // }
    
    public function exportExcel(Request $request) {
        // Fetch data for Excel export
        $category_id = $request->input('category_id');
        $search_term = $request->input('search')['value'];
        
        if (!in_array('PL', explode(',', session()->get('role')['products']))) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }

        $data = Product::where('category', $category_id);
        
        $data->where('owner', 'admin');

        $result = $data->with(['getProductAttribute','getProductAttributeColor'])->get()->toArray();

        foreach($result as $key => $value){
            $categorys = $value['category'][0];
            $response = DB::select("SELECT name FROM categories WHERE id IN ($categorys)");
            $result[$key]['category'] = $response[0]->name;
        }
        
        foreach($result as $key => $value){
            foreach($value['get_product_attribute'] as $ke => $attr){
                $psku = $attr['product_sku'];
                $attrcolor = $attr['attr_color'];
                $response = DB::select("SELECT color, attr_color_code  FROM product_attr_gallery WHERE pid = '$psku' AND color = '$attrcolor'");
                if($response){
                    $result[$key]['get_product_attribute'][$ke]['code'] = $response[0]->attr_color_code;
                }
            }
        }
        
        // Create an array to hold the data for export
        $exportData = [];
        if($result[0]['category'] == 'Frames'){
            $exportData = [
                ['Product SKU', 'Product Name', 'Main Categroy', 'Frame Shape', 'Frame Color', 'Gender', 'Brand Name', 'Model No.', 'Color Code', 'Seller Name',
                'Frame Material', 'Frame Width', 'Temple Material', 'Temple Color', 'Frame Type', 'Manufacturer', 'Warrenty Type',
                'Frame Dimention', 'Product Weight', 'Frame Height', 'Package Weight', 'Package Width', 'Package Length', 'Country Of Origin', 'HSN Code',
                'Selling Price', 'MRP', 'Product Cost', 'Product Stock', 'Product Tat'],
            ];
        }
        else if($value['category'] == 'Lenses'){
            $exportData = [
                ['Product SKU', 'Product Name', 'Main Categroy', 'Brand Name', 'Lens Type', 'Color Code', 'Seller Name', 'Lens Dia', 'Sphere', 'Axis',
                'Cylinder', 'Add Power', 'Lens Material', 'Lens Color', 'Lens Technology', 'Lens Index', 'Gravity', 'Coating', 'Coating Color',
                'Abbe Value', 'Focal Length', 'Manufacturer', 'Warrenty Type', 'Product Weight', 'Package Weight', 'Package Width', 'Package Length', 
                'Country Of Origin', 'HSN Code', 'Selling Price', 'MRP', 'Product Cost', 'Product Stock', 'Product Tat'],
            ];
        }
        else if($value['category'] == 'Sunglasses'){
            $exportData = [
                ['Product SKU', 'Product Name', 'Main Categroy', 'Frame Shape', 'Frame Color', 'Gender', 'Brand Name', 'Model No.', 'Color Code', 'Seller Name',
                'Frame Material', 'Frame Width', 'Temple Material', 'Temple Color', 'Frame Type', 'Lens Material', 'Lens Color', 'Lens Technology', 'Manufacturer',
                'Warrenty Type', 'Frame Dimention', 'Product Weight', 'Frame Height', 'Package Weight', 'Package Width', 'Package Length', 'Country Of Origin', 'HSN Code',
                'Selling Price', 'MRP', 'Product Cost', 'Product Stock', 'Product Tat'],
            ];
        }
        else if($value['category'] == 'Contact Lenses'){
            $exportData = [
                ['Product SKU', 'Product Name', 'Main Categroy', 'Brand Name', 'Contact Lens Type', 'Model No.', 'Color Code', 'Seller Name', 'Diameter', 'Base Curve', 'Sphere Power (-)',
                'Sphere Power (+)', 'Axis', 'Cylinder', 'Add Power', 'Center Thickness', 'Contact Lens Material', 'Contact Lens Color', 'Usages Duration', 'Desposibilty', 'Packaging',
                'Manufacturer', 'Warrenty Type', 'Product Weight', 'Package Weight', 'Package Width', 'Package Length', 'Country Of Origin',
                'HSN Code', 'Selling Price', 'MRP', 'Product Cost', 'Product Stock', 'Product Tat'],
            ];
        }
        else if($value['category'] == 'Premium Brands'){
            $exportData = [
                ['Product SKU', 'Product Name', 'Main Categroy', 'Premium Type', 'Frame Shape', 'Frame Color', 'Gender', 'Brand Name', 'Model No.', 'Color Code', 'Seller Name',
                'Frame Material', 'Frame Width', 'Temple Material', 'Temple Color', 'Frame Type', 'Lens Material', 'Lens Color', 'Lens Technology', 'Manufacturer',
                'Warrenty Type', 'Frame Dimention', 'Product Weight', 'Frame Height', 'Package Weight', 'Package Width', 'Package Length', 'Country Of Origin', 'HSN Code',
                'Selling Price', 'MRP', 'Product Cost', 'Product Stock', 'Product Tat'],
            ];
        }
        else if($value['category'] == 'Contact Lens Solutions' || $value['category'] == 'Accessories'){
            $exportData = [
                ['Product SKU', 'Product Name', 'Main Categroy', 'Brand Name', 'Net Quantity', 'Self Life', 'Color Code', 'Product Color', 'Manufacturer', 'Warrenty Type', 'Product Weight', 'Package Weight', 'Package Width', 'Package Length', 
                'Country Of Origin', 'HSN Code', 'Selling Price', 'MRP', 'Product Cost', 'Product Stock', 'Product Tat'],
            ];
        }
        else{
            //
        }

        foreach($result as $key => $value){
            if($value['category'] == 'Frames'){
                $rowData = [
                    $value['productsku'],
                    $value['title'] ? str_replace(',', ' ', $value['title']) : '-',
                    $value['category'] ? $value['category'] : '-',
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
                ];
                $exportData[] = $rowData;
                if($value['get_product_attribute']){
                    foreach($value['get_product_attribute'] as $attr){
                        $rowData = [
                            $attr['attr_sku'],
                            '-',
                            '-',
                            '-',
                            '-',
                            $attr['attr_color'],
                            '-',
                            $value['brandname'],
                            $value['modelno'],
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            $attr['attr_size'] ? $attr['attr_size'] : '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            $attr['attr_mrp'] ? $attr['attr_mrp'] : '-',
                            $attr['attr_price'] ? $attr['attr_price'] : '-',
                            $attr['attr_qty'] ? $attr['attr_qty'] : '-',
                            '-',
                        ];
                        $exportData[] = $rowData;
                    }
                }
            }
            else if($value['category'] == 'Lenses'){
                $rowData = [
                    $value['productsku'],
                    str_replace(',', ' ', $value['title']),
                    $value['category'] ? $value['category'] : '-',
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
                ];
                $exportData[] = $rowData;
                if($value['get_product_attribute']){
                    foreach($value['get_product_attribute'] as $attr){
                        $rowData = [
                            $attr['attr_sku'] ? $attr['attr_sku'] : '-',
                            '-',
                            '-',
                            $value['brandname'] ? $value['brandname'] : '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            $attr['attr_color'] ? $attr['attr_color'] : '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            $attr['attr_mrp'] ? $attr['attr_mrp'] : '-',
                            $attr['attr_price'] ? $attr['attr_price'] : '-',
                            $attr['attr_qty'] ? $attr['attr_qty'] : '-',
                            '-',
                        ];
                        $exportData[] = $rowData;
                    }
                }
            }
            else if($value['category'] == 'Sunglasses'){
                $rowData = [
                    $value['productsku'],
                    str_replace(',', ' ', $value['title']),
                    $value['category'] ? $value['category'] : '-',
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
                ];
                $exportData[] = $rowData;
                if($value['get_product_attribute']){
                    foreach($value['get_product_attribute'] as $attr){
                        $rowData = [
                            $attr['attr_sku'] ? $attr['attr_sku'] : '-',
                            '-',
                            '-',
                            '-',
                            $attr['attr_color'] ? $attr['attr_color'] : '-',
                            '-',
                            $value['brandname'] ? $value['brandname'] : '-',
                            $value['modelno'] ? $value['modelno'] : '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            $attr['attr_size'] ? $attr['attr_size'] : '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            $attr['attr_mrp'] ? $attr['attr_mrp'] : '-',
                            $attr['attr_price'] ? $attr['attr_price'] : '-',
                            $attr['attr_qty'] ? $attr['attr_qty'] : '-',
                            '-',
                        ];
                        $exportData[] = $rowData;
                    }
                }
            }
            else if($value['category'] == 'Contact Lenses'){
                $rowData = [
                    $value['productsku'],
                    str_replace(',', ' ', $value['title']),
                    $value['category'] ? $value['category'] : '-',
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
                ];
                $exportData[] = $rowData;
                if($value['get_product_attribute']){
                    foreach($value['get_product_attribute'] as $attr){
                        $rowData = [
                            $attr['attr_sku'] ? $attr['attr_sku'] : '-',
                            '-',
                            '-',
                            $value['brandname'] ? $value['brandname'] : '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            $attr['attr_color'] ? $attr['attr_color'] : '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            $attr['attr_mrp'] ? $attr['attr_mrp'] : '-',
                            $attr['attr_price'] ? $attr['attr_price'] : '-',
                            $attr['attr_qty'] ? $attr['attr_qty'] : '-',
                            '-',
                        ];
                        $exportData[] = $rowData;
                    }
                }
            }
            else if($value['category'] == 'Premium Brands'){
                $rowData = [
                    $value['productsku'],
                    str_replace(',', ' ', $value['title']),
                    $value['category'] ? $value['category'] : '-',
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
                ];
                $exportData[] = $rowData;
                if($value['get_product_attribute']){
                    foreach($value['get_product_attribute'] as $attr){
                        $rowData = [
                            $attr['attr_sku'] ? $attr['attr_sku'] : '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            $attr['attr_color'] ? $attr['attr_color'] : '-',
                            '-',
                            $value['brandname'] ? $value['brandname'] : '-',
                            $value['modelno'] ? $value['modelno'] : '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            $attr['attr_size'] ? $attr['attr_size'] : '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            $attr['attr_mrp'] ? $attr['attr_mrp'] : '-',
                            $attr['attr_price'] ? $attr['attr_price'] : '-',
                            $attr['attr_qty'] ? $attr['attr_qty'] : '-',
                            '-',
                        ];
                        $exportData[] = $rowData;
                    }
                }
            }
            else if($value['category'] == 'Contact Lens Solutions' || $value['category'] == 'Accessories'){
                $rowData = [
                    $value['productsku'],
                    $value['title'] ? str_replace(',', ' ', $value['title']) : '-',
                    $value['category'] ? $value['category'] : '-',
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
                ];
                $exportData[] = $rowData;
                if($value['get_product_attribute']){
                    foreach($value['get_product_attribute'] as $attr){
                        $rowData = [
                            $attr['attr_sku'] ? $attr['attr_sku'] : '-',
                            '-',
                            '-',
                            $value['brandname'] ? $value['brandname'] : '-',
                            '-',
                            '-',
                            '-',
                            $attr['attr_color'] ? $attr['attr_color'] : '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            '-',
                            $attr['attr_mrp'] ? $attr['attr_mrp'] : '-',
                            $attr['attr_price'] ? $attr['attr_price'] : '-',
                            $attr['attr_qty'] ? $attr['attr_qty'] : '-',
                            '-',
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
}


















