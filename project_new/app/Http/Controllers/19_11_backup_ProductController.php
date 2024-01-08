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
    public function index()
    {
        $products = Product::orderBy('id','desc')->get();

        $products = DB::table('products') 
            ->join('categories', 'categories.id', '=', 'products.category') 
            ->select('products.*', 'categories.name as category_name') 
            ->orderBy('id', 'desc')
            ->get();

        //  dd($products);

            // echo '<pre>';
            // print_r($products);
            // die();

       return view('admin.productlist',compact('products'));
    }

            // public function getData(){
            //     $shopname = DB::table('vendor_profiles')->select('shop_name')->get();
            //     return view('admin.productlist',compact('$shopname'));
            // }


   public function pending()
   {
       // $products = Product::where('status','2')->where('approved','no')->orderBy('id','desc')->get();
        $products = Product::where('status','2')->where('approved','no')->orWhere('status', '=', 3)->orderBy('id','desc')->get();
       return view('admin.pendingproduct',compact('products'));
   }

   public function pendingdetails($id)
   {
       $product = Product::findOrFail($id);
       return view('admin.pendingdetails',compact('product'));
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
        // dd($countryoforigin);
        return view('admin.productadd',compact('categories','countryoforigin'));
    }

    // test push codenew
    /** 
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'photo' => 'required|mimes:jpeg,jpg,png,gif|required|max:111|dimensions:min_width=1160,min_height=1160',
            // 'photo' => 'max:400',
            'title' => 'required|max:255',
            'gallery.*' => 'image|mimes:jpeg,jpg,png,gif|max:111|dimensions:min_width=1160,min_height=1160',
            'video' => 'mimes:mp4|max:8000',
        ]);
        $form_data = $request->all();   // save form data in a variable

        // echo "<pre>";
        // print_r($form_data);
        // die();
        
        $sub_catg = $request->input('subid');   // get a particular field value
        $sub_new = implode(',', $sub_catg);    //convert array to string with , sperator
        
        $child = $request->input('childid');
        $childnew = implode(',',$child);
        
        if($request->input('color') != '') {
            $color = $request->input('color');
        }
        else {
            $color = 'NULL';
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
            $powernewmin = implode(',',$powermin);
        }
        else {
            $powernewmin = '';
        }
        
        if($request->input('powermax') != '') {
            $powermax = $request->input('powermax');
            $powernewmax = implode(',',$powermax);
        }
        else {
            $powernewmax = '';
        }
        
        if($request->input('axisnew') != '') {
            $axis= $request->input('axisnew');
            $axisneww = implode(',',$axis);
        }
        else {
            $axisneww = '';
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

        if($request->input('lenscolor') != '') {
            $lenscolor = $request->input('lenscolor');
            // print_r($lenscolor);die();
            // $lenscolor = implode(',',$lenscolor);
        }
        else {
            $lenscolor = '';
        }
        
        $lens_new = $request->input('lenstechnology');
         
        $coat_new = $request->input('coating');

        $gender_new = $request->input('gender');

        $data = new Product();
        $data->fill($form_data);
        $data->category = $request->mainid;
        $data->entry_by = Auth::user()->username;
        
        // echo "<pre>";
        // print_r($data->owner);
        // die();
        
        $data['subid'] = $sub_new;
        $data['childid'] = $childnew;
        $data['diameter'] = $dianew;
        $data['powermin'] = $powernewmin;
        $data['powermax'] = $powernewmax;
        $data['axisnew'] = $axisneww;
        $data['cylindernew'] = $cylinderneww;
        $data['basecurve'] = $basecurvenew;
        $data['addpower'] = $addnew;
        $data['packweight'] = $request->input('packweight') == '' ? 'NULL' : $request->input('packweight');
        $data['packwidth'] = $request->input('packwidth') == '' ? 'NULL' : $request->input('packwidth');
        $data['packheight'] = $request->input('packheight') == '' ? 'NULL' : $request->input('packheight');
        $data['packlength'] = $request->input('packlength') == '' ? 'NULL' : $request->input('packlength');
        $data['usagesduration'] = $request->input('usagesduration') == '' ? 'NULL' : $request->input('usagesduration');
        
        $data['color'] = $color;
        
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

        $attSku = $request->input('attr_sku');
        if($request->input('attr_size') != '') {
            $attrSize = $request->input('attr_size');
        }

        $attrQty = $request->input('attr_qty');
        $attrPrice = $request->input('attr_price');
        $attrColor = $request->input('attr_color');
        
        $count = $request->input('count');
        
        if(isset($count)){
            $count = array_unique($count);
            $count = array_values($count);
            for($i=0;$i<count($count); $i++) {
                
                $subdata = new ProductAttr();
    
                $subdata['product_id'] = $lastid;
                $subdata['attr_sku'] = $attSku[$i];
                
                if($request->input('attr_size') != '') {
                    if($attrSize[$i] == ''){
                        $subdata['attr_size'] = '';
                    }
                    else {
                        $subdata['attr_size'] = $attrSize[$i];
                    }
                }
    
                if($attrQty[$i] == ''){
                    $subdata['attr_qty'] = '';
                }
                else {
                    $subdata['attr_qty'] = $attrQty[$i];
                }
    
                if($attrColor[$i] == ''){
                    $subdata['attr_color'] = '';
                }
                else {
                    $subdata['attr_color'] = $attrColor[$i];
                }
                
                $subdata['attr_price'] = $attrPrice[$i];
                
                $subdata->save();
                
                $sub_id = $subdata->id;
                
                $files = $request->file('attr_imgs_'.$count[$i]);
                if($files) {
        
                    foreach ($files as $file){
                        
                        $filepath = 'assets/images/product_attr';
                        
                        $galleryData = new ProductGallery();
                        
                        $image_name = Str::random(5).time().$file->getClientOriginalName();
                        $file->move($filepath, $image_name);
                        
                        $galleryData['attr_imgs'] = $image_name;
                        
                        $galleryData['paid'] = $sub_id;
                        
                        $galleryData['pid'] = $lastid;
                        
                        $galleryData['color'] = $attrColor[$i];
                        
                        $galleryData->save();
                    }
                }
                
            }
        }
        
        Session::flash('message', 'New Product Added Successfully.');
        return redirect('admin/products');
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
        
        
        // for multiple paid store in a column for a image -------------------
        // $attrNewData = new \stdClass;
        // $allid = array();
        // $allcolor = array();
        // if(isset($attrData)){
        //     foreach($attrData as $data){
        //         array_push($allid, $data->id);
        //         array_push($allcolor, $data->attr_color);
        //     }
        //     $attrNewData->mid = $allid;
        //     $attrNewData->colors = $allcolor;
        // }
        
        // for($a=0; $a<count($attrNewData->mid); $a++){
        //     $imgData = DB::table('product_attr_gallery')->where('paid', $attrNewData->mid[$a])->where('color', $attrNewData->colors)->get();
        // }
        
        // echo "<pre>";
        // print_r($attrNewData->mid[0]);
        // die();

        $attrallData = DB::table('product_attrs as pa')
                ->select('pa.*', 'pag.attr_imgs', 'pag.id as aid')
                ->leftjoin('product_attr_gallery as pag', 'pa.id', 'pag.paid')
                ->where('pid', $id)
                ->get();
        
        // DB::enableQueryLog();
        
        $attrImages = array();
        $count = [];
        if(count($attrData)>0){
            foreach($attrData as $data){
                $attrImages = DB::table('product_attr_gallery')->where('pid', $id)->where('color', $data->attr_color)->get();
                $count = count($attrImages);
            }
        }
        
        // echo "<pre>";
        // print_r(DB::getQueryLog());
        // die();
        
        return view('admin.productedit',compact('product','categories','child','subs','gallery','countryoforigin','dd','demo_new', 'attrData', 'attrImages', 'count', 'attrallData', 'attrNewData'));
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
        $this->validate($request, [
            'photo' => 'max:111',
            'title' => 'required|max:255',
            'description' => 'required|max:3000',
            'gallery' => 'max:111',
            'video' => 'mimes:mp4|max:8000',
        ]);

        $product = Product::findOrFail($id);
        $productattr = DB::table('product_attrs')->where('product_id',$id)->get();
        $input = $request->all();
        
        // echo "<pre>";
        // print_r($input);
        // die();
        
      
        $sub_catg = $request->input('subid');   // get a particular field value
        $sub_new = implode(',', $sub_catg);    //convert array to string with , sperator
      
        $child = $request->input('childid');
        $childnew = implode(',', $child);
        

        // if($request->input('lenstechnology') != '') {
        //     $lens_new = $request->input('lenstechnology');
        //     $lenstechnologynew = implode(',',$lens_new);
        // }
        // else {
        //     $lenstechnologynew = '';
        // }
        
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

        // echo "<pre>";
        // print_r($pid);
        // die();
        
        // dd(DB::getQueryLog());

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
        
        // end delete functionality
        
        $attSku = $request->input('attr_sku');
        $attrSize = $request->input('attr_size');
        $attrQty = $request->input('attr_qty');
        $attrPrice = $request->input('attr_price');
        $attrColor = $request->input('attr_color');
        
        $paid = $request->input('id');

      
        
        $count = $request->input('count');

        // echo "<pre>";
        // print_r($attrSize);
        // die();
        
        if($count){
            for($i=0;$i<count($count); $i++) {
                $product_attr_array['attr_sku'] = $attSku[$i];
                
                // echo "";
                // print_r($attrSize);
                // die();
    
                if(count($attrSize)>0){
                    if($attrSize[$i] != ''){
                        $product_attr_array['attr_size'] = $attrSize[$i];
                    }
                    else {
                        $product_attr_array['attr_size'] = '';
                    }
                }
    
                if($attrQty[$i] != ''){
                    $product_attr_array['attr_qty'] = $attrQty[$i];
                }
                else {
                    $product_attr_array['attr_qty'] = '';
                }
    
                if($attrColor[$i] != ''){
                    $product_attr_array['attr_color'] = $attrColor[$i];
                }
                else {
                    $product_attr_array['attr_color'] = '';
                }

                $product_attr_array['product_id'] = $pid;
                
                $product_attr_array['attr_price'] = $attrPrice[$i];
                
                //unset
                // unset($input['_token']);
                // unset($input['_method']);
              
                if(isset($attSku[$i])){
                    if($paid[$i] != ''){
                        // DB::enableQueryLog();
                        $productattr = DB::table('product_attrs')->where(['id'=>$paid[$i]])->update($product_attr_array);
                        // dd(DB::getQueryLog());die();
                    }
                    else if(count($product_attr_array) > 0){
                        // DB::enableQueryLog();
                        $productattr = DB::table('product_attrs')->insert($product_attr_array);
                        // dd(DB::getQueryLog());die();
                        
                        // echo "<pre>";
                        // print_r($productattr);
                        // die();
                        
                        $sub_id = $productattr;
                        
                        $files = $request->file('attr_imgs_'.$count[$i]);
                        if($files) {
                
                            foreach ($files as $file){
                                $filepath = 'assets/images/product_attr';
                                
                                $galleryData = new ProductGallery();
                                
                                $image_name = Str::random(5).time().$file->getClientOriginalName();
                                $file->move($filepath, $image_name);
                                
                                $galleryData['attr_imgs'] = $image_name;
                                
                                $galleryData['paid'] = $sub_id;
                                
                                $galleryData['pid'] = $pid;
                                
                                $galleryData['color'] = $attrColor[$i];
                                
                                $galleryData->save();
                            }
                        }
                    }
                }
            }
        }
        
        $dataproduct = $request->input('removeattr');
        
        if($dataproduct){
            for($l=0;$l<count($dataproduct); $l++){
                $deleteprod = ProductAttr::findOrFail($dataproduct[$l]);
                $deletegallery = ProductGallery::where('paid', $deleteprod->id)->get();
                
                if($deletegallery){
                    foreach($deletegallery as $delete){
                        if($delete->attr_imgs){
                            unlink("assets/images/product_attr/".$delete->attr_imgs);
                        }
                        $delete->delete();
                    }
                }
                $deleteprod->delete();
            }
        }

        Session::flash('message', 'Product Updated Successfully.');
        return redirect('admin/products');
    }

    public function status($id , $status)
    {
        $product = Product::findOrFail($id);
        $input['status'] = $status;

        $product->update($input);
        Session::flash('message', 'Product Status Updated Successfully.');
        return redirect('admin/products');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        unlink('assets/images/products/'.$product->feature_image);
        $product->delete();
        return redirect('admin/products')->with('message','Product Delete Successfully.');
    }

    public function deleteimg($id){
        $img = Gallery::findOrFail($id);
        unlink('assets/images/gallery/'.$img->image);
        $img->delete();
        return redirect()->back();

    }
    
    
     public function accept($id)
    {   
        // $vendor = Vendors::findOrFail($id);
        $product = Product::findOrFail($id);
        $approved['approved'] = 'yes';
        $approved['status']=1;

        // mail($vendor->email,'Your Product is approved','Your Vendor Account Activated Successfully. Please Login to your account and build your own shop.');

        $product->update($approved);
        return redirect('admin/products')->with('message','Product Accepted Successfully');
    }

    public function reject($id)
    {
        // $vendor = Vendors::findOrFail($id);
        $product = Product::findOrFail($id);
        // $newnote= new Product();
        // $newnote->note = request('note');
        $approved['status']=3;
        // mail($vendor->email,'Your Vendor Registration Rejected','Your Vendor Account Registration Rejected. Please Contact Admin for further details.');

        // unlink('assets/images/products/'.$product->feature_image);
        // $product->delete();
         // $newnote->save();
         $product->update($approved);
        return redirect('admin/products/pending')->with('message','Product Rejected Successfully');
        // return redirect('admin/vendors/pending')->with('message','Vendor Rejected Successfully');
    }

public function storenote(Request $request,$id)
{
    
     $product = Product::findOrFail($id);
      $product->note = $request->input('note');
      $product->save();
       return redirect('admin/products/pending')->with('message','Rejection Note Send to Vendor');
}
    

}

