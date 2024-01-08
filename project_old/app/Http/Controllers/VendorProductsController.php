<?php

namespace App\Http\Controllers;

use App\Category;
use App\Gallery;
use App\Product;
use App\ProductAttr;
use App\ProductGallery;
use App\Brands;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class VendorProductsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:vendor');
    }

    /**
     * Display a listing of the resource.
     *add_product_color
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user_name = Auth::user()->name;
        $products = Product::orderBy('id','desc')->get();
        $products = DB::table('products') 
            ->join('categories', 'categories.id', '=', 'products.category') 
            ->select('products.*', 'categories.name as category_name')
            ->where('vendor_name',$user_name) 
            ->orderBy('id', 'desc')
            ->get();
        return view('vendor.productlist',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::where('role','main')->get();
        $countryoforigin = DB::table('country_of_origin')->select('name')->get();
        $lenses_data = DB::table('lenses_data')->get()->toarray();
        $frame_material = DB::table('frame_material')->get()->toarray();
        $lens_material = DB::table('lens_material')->get()->toarray();
        $lenstechnology = DB::table('lens_technology')->get()->toarray();
        $frame_color = DB::table('frame_color')->where('status', 1)->get();
        $lens_color = DB::table('lens_color')->where('status', 1)->get();
        $contact_lens_color = DB::table('contact_lens_color')->where('status', 1)->get();
        return view('vendor.productadd',compact('categories','countryoforigin', 'lenses_data', 'frame_material','lens_material','lenstechnology', 'frame_color', 'lens_color', 'contact_lens_color'));
    }
    
    public function get_brand_name(Request $request)
    {
        $brand = Brands::where('category_id', $request->category_id)->get()->toArray();
        return $brand;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
            
    //     $this->validate($request, [
    //         'photo' => 'max:400',
    //         'title' => 'required|max:255',
    //         'description' => 'required|max:3000',
    //         'gallery' => 'max:400',
    //         'video' => 'required|mimes:mp4|max:50000',
    //         'featured'=>'required'
    //     ]);

    //     $data = new Product();
    //     $data->fill($request->all());
    //     $data->category = $request->mainid.",".$request->subid.",".$request->childid;

    //     if ($file = $request->file('photo')){
    //         $photo_name = time().$request->file('photo')->getClientOriginalName();
    //         $file->move('assets/images/products',$photo_name);
    //         $data['feature_image'] = $photo_name;
    //     }
    
    //     $data->owner = "vendor";
    //     $data->vendorid = Auth::user()->id;
    //     $data->vendor_name = Auth::user()->name;
    //     $data->status = 2;

    //     if ($request->featured == 1){
    //         $data->featured = 1;
    //     }

    //     if ($request->tranding == 1){
    //         $data->tranding = 1;
    //     }

    //     if ($request->latest == 1){
    //         $data->latest = 1;
    //     }

    //     if ($request->selected == 1){
    //         $data->selected = 1;
    //     }

    //     if ($request->pallow == ""){
    //         $data->sizes = null;
    //     }
    //     if ($file = $request->file('video')){
    //         $video_name = time().$request->file('video')->getClientOriginalName();
    //         $file->move('assets/images/products',$video_name);
    //         $data['video'] = $video_name;
    //     }
    //     if ($file = $request->file('video1')){
    //         $video_name = time().$request->file('video1')->getClientOriginalName();
    //         $file->move('assets/images/products',$video_name);
    //         $data['video1'] = $video_name;
    //     }
    //     if ($file = $request->file('video2')){
    //         $video_name = time().$request->file('video2')->getClientOriginalName();
    //         $file->move('assets/images/products',$video_name);
    //         $data['video2'] = $video_name;
    //     }
    //     $data->save();
    //     $lastid = $data->id;

    //     if ($files = $request->file('gallery')){
    //         foreach ($files as $file){
    //             $gallery = new Gallery;
    //             $image_name = str_random(2).time().$file->getClientOriginalName();
    //             $file->move('assets/images/gallery',$image_name);
    //             $gallery['image'] = $image_name;
    //             $gallery['productid'] = $lastid;
    //             $gallery->save();
    //         }
    //     }
    //     Session::flash('message', 'New Product Added Successfully.');
    //     return redirect('vendor/products');
    // }
    
     public function store(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die();
        $this->validate($request, [
            'photo' => 'required|mimes:jpeg,jpg,png,gif|required|max:110|dimensions:min_width=1160,min_height=1160',
            'productsku' => 'required|max:255|unique:products',
            'title' => 'required|max:255',
            'mainid' => 'required|max:255',
            'previous_price' => 'required|max:255',
            'gallery.*' => 'image|mimes:jpeg,jpg,png,gif|max:110|dimensions:min_width=1160,min_height=1160',
            'video' => 'mimes:mp4|max:8000',
        ]);
        
        $form_data = $request->all();   // save form data in a variable
        
        $sub_catg = $request->input('subid');   // get a particular field value
        
        // print_r($sub_catg);die();
        $sub_new = implode(',', $sub_catg);    //convert array to string with , sperator
        
        
        $child = $request->input('childid');
        // print_r($child);die();
        $childnew = implode(',', $child);
        
        if($request->input('color') != '') {
            $color = $request->input('color');
        }else {
            $color = NULL;
        }
        
        if($request->input('framecolor') != '') {
            $framecolor = $request->input('framecolor');
        }else {
            $framecolor = NULL;
        }
        
        if($request->input('diameter')) {
            $dia = $request->input('diameter');
            $dianew = implode(',',$dia);
        }else {
            $dianew = NULL;
        }
        
        if($request->input('powermin')) {
            $powermin = $request->input('powermin');
            $powernewmin = implode(',',$powermin);
        } else {
            $powernewmin = NULL;
        }
        
        if($request->input('powermax')) {
            $powermax = $request->input('powermax');
            $powernewmax = implode(',',$powermax);
        }else {
            $powernewmax = NULL;
        }
        
        if($request->input('axisnew')) {
            $axis= $request->input('axisnew');
            $axisneww = implode(',',$axis);
        }else {
            $axisneww = NULL;
        }
        
        if($request->input('cylindernew')) {
            $cylinder = $request->input('cylindernew');
            $cylinderneww = implode(',',$cylinder);
        }else {
            $cylinderneww = NULL;
        }
        
        if($request->input('basecurve')) {
            $base = $request->input('basecurve');
            $basecurvenew = implode(',',$base);
        }else {
            $basecurvenew = NULL;
        }
        
        if($request->input('addpower')) {
            $addpowerr = $request->input('addpower');
            $addnew = implode(',',$addpowerr);
        }else {
            $addnew = NULL;
        }

        if($request->input('lenscolor')) {
            $lenscolor = $request->input('lenscolor');
        }else {
            $lenscolor = NULL;
        }
        
        if($request->input('axisnlens')) {
            $axislens= $request->input('axisnlens');
            $axisnlenseww = implode(',',$axislens);
        }else {
            $axisnlenseww = NULL;
        }
        
        if($request->input('cylinderlens')) {
            $cylinderlens = $request->input('cylinderlens');
            $cylinderlensneww = implode(',',$cylinderlens);
        }else {
            $cylinderlensneww = NULL;
        }
        
        if($request->input('addpowerlens')) {
            $addpowerrlens = $request->input('addpowerlens');
            $addpowerrlensnew = implode(',',$addpowerrlens);
        }else {
            $addpowerrlensnew = NULL;
        }
        
        if($request->input('diameterlens')) {
            $diameterlens = $request->input('diameterlens');
            $diameterlensnew = implode(',',$diameterlens);
        }else {
            $diameterlensnew = NULL;
        }
        
        if($request->input('sphere')) {
            $sphere = $request->input('sphere');
            $spherenew = implode(',',$sphere);
        }else {
            $spherenew = NULL;
        }
        
        $lens_new = $request->input('lenstechnology');
        $coat_new = $request->input('coating');
        $gender_new = $request->input('gender');

        $data = new Product();
        $data->fill($form_data);
        $data->category = $request->mainid;
        $data->entry_by = Auth::user()->name;
        
        $data->status = 2;
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
        $data['entry_by'] = Auth::user()->shop_name;
        
        $data['vendor_name'] = Auth::user()->name;
        $data['vendorid'] = Auth::user()->id;
        
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
    public function edit($id)
    {
        // $product = Product::findOrFail($id);
        // print_r($product);die();
        // $child = Category::where('role','child')->where('subid',$product->category[1])->get();
        
        
        
        // $subs = Category::where('role','sub')->where('mainid',$product->category[0])->get();
        // $categories = Category::where('role','main')->get();
        // $countryoforigin = DB::table('country_of_origin')->select('name')->get();
        // $gallery = Gallery::where('productid',$id)->get();
        
        $product = Product::findOrFail($id);
         
        $demo = $product->subid;
        // print_r($demo);die();
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
        $attrColor = DB::table('product_attr_gallery')->select('color')->distinct()->where('pid', $product->productsku)->get();
        $lenses_data = DB::table('lenses_data')->get()->toarray();
        $brand_data = DB::table('brand_name')->get()->toarray();
        $frame_material = DB::table('frame_material')->get()->toarray();
        $frame_color = DB::table('frame_color')->get()->toarray();
        $frame_shape = DB::table('frame_shape')->get()->toarray();
        $lens_material = DB::table('lens_material')->get()->toarray();
        $lens_color = DB::table('lens_color')->get()->toarray();
        $lenstechnology = DB::table('lens_technology')->get()->toarray();
        return view('vendor.productedit',compact('id','product','categories','child','subs','gallery','countryoforigin','dd','demo_new', 'attrData', 'attrColor','lenses_data','brand_data','frame_material', 'frame_color', 'frame_shape', 'lenstechnology','lens_material', 'lens_color'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $id = $_POST['id'];
        $this->validate($request, [
            'photo' => 'max:400',
            'productsku' => 'required|max:255',
            'title' => 'required|max:255',
            'gallery' => 'max:400',
            'video' => 'mimes:mp4|max:8000',
        ]);
        
        // echo '<pre>';
        // print_r($request->all());
        // die();

        $product = Product::findOrFail($id);
        $productattr = DB::table('product_attrs')->where('product_id',$id)->get();
        $input = $request->all();
        // print_r($input);die();
        
        // echo "<pre>";
        // print_r($input);
        // die();
        
      
        $sub_catg = $request->input('subid');   // get a particular field value
        $sub_new = implode(',', $sub_catg);    //convert array to string with , sperator
      
        $child = $request->input('childid');
        $childnew = implode(',', $child);
        

        if($request->input('lenstechnology') != '') {
            $lenstechnologynew = $request->input('lenstechnology');
        }
        else {
            $lenstechnologynew = NULL;
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
            $dianew = NULL;
        }
        
        if($request->input('powermin') != '') {
            $powermin = $request->input('powermin');
            $powerminnew = implode(',',$powermin);
        }
        else {
            $powerminnew = NULL;
        }
        
        if($request->input('powermax') != '') {
            $powermax = $request->input('powermax');
            $powermaxnew = implode(',',$powermax);
        }
        else {
            $powermaxnew = NULL;
        }
        
        if($request->input('axisnew') != '') {
            $axis= $request->input('axisnew');
            $axisneww = implode(',',$axis);
        }
        else {
            $axisneww = NULL;
        }
        
        if($request->input('cylinderlens') != '') {
            $cylinderlens = $request->input('cylinderlens');
            $cylinderlensneww = implode(',', array_unique($cylinderlens));
        }else {
            $cylinderlensneww = NULL;
        }
        
        if($request->input('axisnlens') != '') {
            $axislens= $request->input('axisnlens');
            $axisnlenseww = implode(',',array_unique($axislens));
        }else {
            $axisnlenseww = NULL;
        }
        
        if($request->input('sphere') != '') {
            $sphere = $request->input('sphere');
            $spherenew = implode(',',array_unique($sphere));
        }else {
            $spherenew = NULL;
        }
        
        if($request->input('addpowerlens') != '') {
            $addpowerrlens = $request->input('addpowerlens');
            $addpowerrlensnew = implode(',',array_unique($addpowerrlens));
        }else {
            $addpowerrlensnew = NULL;
        }
        if($request->input('diameterlens') != '') {
            $diameterlens = $request->input('diameterlens');
            $diameterlensnew = implode(',',$diameterlens);
        }else {
            $diameterlensnew = NULL;
        }
        
        if($request->input('cylindernew') != '') {
            $cylinder = $request->input('cylindernew');
            $cylinderneww = implode(',',$cylinder);
        }
        else {
            $cylinderneww = NULL;
        }
        
        if($request->input('basecurve') != '') {
            $base = $request->input('basecurve');
            $basecurvenew = implode(',',$base);
        }
        else {
            $basecurvenew = NULL;
        }
        
        if($request->input('addpower') != '') {
            $addpowerr = $request->input('addpower');
            $addnew = implode(',',$addpowerr);
        }
        else {
            $addnew = NULL;
        }
        if($request->input('coating') != '') {
            $coating = $request->input('coating');
            $addnewcoating = implode(',',$coating);
        }
        else {
            $addnewcoating = NULL;
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
        $input['status'] = 2;
        $input['approved'] = 'no';
        $input['note'] = NULL;
        $input['lenstechnology'] = $lenstechnologynew;
        
        // $input['lenstechnology'] = $lenstechnologynew;
        // $input['gender'] = $gendernew;
        
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
        // DB::enableQueryLog();
        // print_r($input);
        // dd($input);
                
        // echo "<pre>";
        // print_r($input);
        // die();
        
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
                if($delete->attr_imgs){
                    unlink("assets/images/product_attr/".$delete->attr_imgs);
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
        $msg = 'Product Status Updated Successfully.';
        $product = Product::findOrFail($id);
        if($status == 0){
            if ($product->approved == "no"){
                $status = 2;
                $msg = 'This Product is Waiting for Admin Approval.';
            }
        }
        $input['status'] = $status;
        $product->update($input);
        Session::flash('message', $msg);
        return redirect('vendor/products');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    // public function destroy($id)
    // {
    //     $product = Product::findOrFail($id);
    //     unlink('assets/images/products/'.$product->feature_image);
    //     $product->delete();
    //     return redirect('vendor/products')->with('message','Product Delete Successfully.');
    // }
    
    public function destroy($id)
    {
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
    
    // nik add
    public function fetch_attr_color_list() 
    {
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
            $action_string = '
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

    public function add_product_color(Request $request) 
    {
        if($_POST['product_id'] != ''){
            if (!empty($_FILES['images']['name'][0])) {
                $files = $request->file('images');
                if ($files){
                    $count = 0;
                    foreach ($files as $file){
                        $data = explode('.', $file->getClientOriginalExtension());
                        $filepath = 'assets/images/product_attr';
                        $galleryData = new ProductGallery();
                        $image_name = $request->product_id.'_'.$request->color."_".uniqid().".".$data[0];
                        $file->move($filepath, $image_name);
                        $galleryData['attr_imgs'] = $image_name;
                        // $galleryData['paid'] = '';
                        $galleryData['pid'] = $request->product_id;
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

    public function fetch_attr_color_dropdown(Request $request)
    {
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
    public function delete_attr_color(Request $request)
    {
        $id = $request->id;
        $dat = DB::table('product_attr_gallery')->where("id", $id)->get()[0];
        try
        {
            unlink('assets/images/product_attr/'.$dat->attr_imgs);
        }
        catch(\Exception $e)
        {
            //
        }
        $gal = ProductGallery::where('id',$id);
        $gal->delete();
        echo json_encode(array("status" => 200, 'data' => 'Deleted Successfully !'));
    }
    
    
    public function get_vendor_product_details(Request $request)
    {
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;
        
        $product_details_total = $this->get_vendor_product_list_data(false, $search_term, $other_configs);
        $product_details_count = $this->get_vendor_product_list_data(true, $search_term, $other_configs);
        
        $data = array();
        $i = 1;
        foreach($product_details_total as $row => $vals) {
            $start++;
            $nestedData = array();
            $actionData = '';
            $nestedData[] = $start;
            $id = $vals->id;

            $actionButton = "<a href='" . url('vendor/products'). '/'. $id . '/edit' . "'  class='btn btn-primary btn-xs'><i class='fa fa-edit'></i>Edit</a>&nbsp&nbsp;";
            if($vals->status == 1){
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
            $actionButton .= "<a type='button' onclick='deleteProduct(event)' data='" . $id . "'  class='btn btn-danger btn-xs'><i class='fa fa-trash'></i>Delete</a>";
            
            $nestedData[] = $vals->vendor_name;
            $nestedData[] = $vals->title;
            $nestedData[] = $vals->productsku;
            $nestedData[] = $vals->modelno;
            $nestedData[] = $vals->costprice;
            $nestedData[] = $vals->category;
            $nestedData[] = $vals->stock;
            $nestedData[] = "<img style='max-width: 50px;' src='" . url('assets/images/products'). '/' . $vals->feature_image . "'>";
            // $nestedData[] = $vals->feature_image;
            if($vals->status == 2)
            {
                $nestedData[] = "Pending";
            }
            elseif($vals->status == 1)
            {
                $nestedData[] = "Approved";
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
    
    public function get_vendor_product_list_data($count, $search_term = '', $other_configs, $condition = false)
    {
        $result = [];
        if(isset($search_term) && $search_term!="") {
            $data = DB::table('products as p')
                ->where(function($query) use ($search_term,$other_configs){
                    $query->where('p.vendor_name', $search_term);
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
                ->select('p.id', 'p.vendor_name', 'p.title', 'p.productsku', 'p.modelno', 'p.costprice', 'c.name as category', 'p.stock', 'p.feature_image', 'p.status')
                ->join('categories as c', 'p.category', '=', 'c.id')
                ->where('vendorid', Auth::user()->id)
                ->where('owner', 'vendor')
                ->whereIn('approved', ['no','yes'])
                ->whereIn('p.status', ['1','2'])
                ->orderBy('p.id', 'desc');
                
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
                
                $result = $data->get();
        }
        else{
            $data = DB::table('products as p')
                    ->select('p.id', 'p.vendor_name', 'p.title', 'p.productsku', 'p.modelno', 'p.costprice', 'c.name as category', 'p.stock', 'p.feature_image', 'p.status')
                    ->leftjoin('categories as c', 'p.category', '=', 'c.id')
                    ->where('vendorid', Auth::user()->id)
                    ->where('owner', 'vendor')
                    ->whereIn('approved', ['no','yes'])
                    ->whereIn('p.status', ['1','2'])
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
    
    public function get_vendor_change_list_details(Request $request)
    {
        $start = intval($request['start']);
        $length = intval($request['length']);
        $search_term = $request['search']['value'];
        
        $other_configs['length'] = $length;
        $other_configs['offset'] = $start;
        
        $product_details_total = $this->get_vendor_change_list_data(false, $search_term, $other_configs);
        $product_details_count = $this->get_vendor_change_list_data(true, $search_term, $other_configs);
        
        $data = array();
        $i = 1;
        foreach($product_details_total as $row => $vals) {
            $start++;
            $nestedData = array();
            $actionData = '';
            $nestedData[] = $start;
            $id = $vals->id;
            
            $actionButton = "<a href='" . url('vendor/products'). '/'. $id . '/edit' . "'  class='btn btn-primary btn-xs'><i class='fa fa-edit'></i>Edit</a>&nbsp&nbsp;";
            
            $actionButton .= "<a type='button' onclick='checkProductChanges(" . $id . ")'><i class='fa fa-eye'></i></a>";
            
            $nestedData[] = $vals->vendor_name;
            $nestedData[] = $vals->title;
            $nestedData[] = $vals->costprice;
            $nestedData[] = $vals->category;
            $nestedData[] = "Changes";
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
    
    public function get_vendor_change_list_data($count, $search_term = '', $other_configs, $condition = false)
    {
        $result = [];
        if(isset($search_term) && $search_term!="") {
            $data = DB::table('products as p')
                ->where(function($query) use ($search_term,$other_configs){
                    $query->orwhere('p.vendor_name', $search_term);
                    $query->orwhere('p.title', 'like', '%' . $search_term . '%');
                    $query->orwhere('p.price', 'like', '%' . $search_term . '%');
                    $query->orwhere('p.stock', 'like', '%' . $search_term . '%');
                    $query->orwhere('p.feature_image', 'like', '%' . $search_term . '%');
                    $query->orwhere(function($join) use ($search_term, $other_configs)
                    {
                        $join->orwhere('c.name', 'like', '%' . $search_term . '%');
                    });
                })
                ->select('p.id', 'p.vendor_name', 'p.title', 'p.costprice', 'c.name as category', 'p.stock', 'p.feature_image', 'p.status')
                ->join('categories as c', 'p.category', '=', 'c.id')
                ->where('vendorid', Auth::user()->id)
                ->where('owner', 'vendor')
                ->whereIn('approved', ['no'])
                ->whereIn('p.status', ['3'])
                ->orderBy('p.id', 'desc');
                
                if(!$count && $other_configs['length']){
                    $data->limit($other_configs['length']);
                    $data->offset($other_configs['offset']);
                }
                
                $result = $data->get();
        }
        else{
            $data = DB::table('products as p')
                    ->select('p.id', 'p.vendor_name', 'p.title', 'p.costprice', 'c.name as category', 'p.stock', 'p.feature_image', 'p.status')
                    ->leftjoin('categories as c', 'p.category', '=', 'c.id')
                    ->where('vendorid', Auth::user()->id)
                    ->where('owner', 'vendor')
                    ->whereIn('approved', ['no'])
                    ->whereIn('p.status', ['3'])
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
    
    public function chek_changes_product(Request $request)
    {
        $product = Product::findOrFail($request->id);
        return $product;
    }

}
