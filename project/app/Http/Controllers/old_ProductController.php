<?php

namespace App\Http\Controllers;

use App\Category;
use App\Gallery;
use App\Product;
use App\Vendors;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

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

        // $products = DB::table('products') 
        //     ->join('vendor_profiles', 'vendor_profiles.id', '=', 'products.vendorid') 
        //     ->select('products.*', 'vendor_profiles.shop_name') 
        //     ->get();

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
            'photo' => 'mimes:jpeg,jpg,png,gif|required|max:100|dimensions:min_width=1300,min_height=1160',
            // 'photo' => 'max:400',
            'title' => 'required|max:255',
            'description' => 'required|max:3000',
            'gallery' => 'required',
            'gallery.*' => 'image|mimes:jpeg,jpg,png,gif|max:100|dimensions:min_width=1300,min_height=1160,max_width=1300,max_height=1160',
            'video' => 'required|mimes:mp4|max:50000',
            'featured'=>'required'
        ]);
        $form_data = $request->all();   // save form data in a variable
        // dd($form_data);
        $sub_catg = $request->input('subid');   // get a particular field value
        // dd($sub_catg);
        $sub_new = implode(',', $sub_catg);    //convert array to string with , sperator
        // $form_data['subid'] = $sub_new;        // replace the original field value with new value 
        $child = $request->input('childid');
        $childnew = implode(',',$child);
        // $form_data['childid'] = $child;

        // $lenstechno = $request->input('lenstechnology');
        // $lenstechnologynew = implode(',', $lenstechno);
        // $coatnew = $request->input('coating');
        // $coatingnew = implode(',',$coatnew);
         $lens_new = $request->input('lenstechnology');
         
         $coat_new = $request->input('coating');

         $gender_new = $request->input('gender');
         // $gendernew = implode(',',$gender_new );

        $data = new Product();
        $data->fill($form_data);
        $data->category = $request->mainid;
        $data['subid'] = $sub_new;
        $data['childid'] = $childnew;
        // $data['gender'] = $gendernew;
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
        //  if (!empty($gender_new)) {
        //    $gendernew = implode(',',$gender_new);
        //    $data['gender'] =  $gendernew;
        // }
        
        
        // // $data['lenstechnology'] = $lenstechnologynew;
        // $data['coating'] = $coatingnew;

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

        if ($request->pallow == ""){
            $data->sizes = null;
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
        // dd($product);
        $demo = $product->subid;
        // dd($demo);
        // $lens = $product->lenstechnology;
        // dd($lens);
        // $lens_new = explode(',',$lens);
        $lense = $product->lenstechnology;
        $lens_new = explode(',',$lense);

        $coat = $product->coating;
        $coat_new = explode(',',$coat);
        $gendernew = $product->gender;
        $gender_new = explode(',',$gendernew);

        // dd($lens_new);
        // $coat = $product->coating;
         // dd($coat);
        // $coat_new =explode(',',$coat);

        // dd($coat_new);
     
        $demo_new = explode(',',$demo);
        // dd($demo);
   
        $d = $product->childid;
    
        $dd = explode(',',$d);
      
        $subs = Category::where('role','sub')->where('mainid', $product->category[0])->get();
        // dd($subs);
       
        $child = Category::where('role','child')->whereIn('subid',$demo_new)->get();


       
        $gallery = Gallery::where('productid',$id)->get();
        $categories = Category::where('role','main')->get();
        $countryoforigin = DB::table('country_of_origin')->select('name')->get();
        return view('admin.productedit',compact('product','categories','child','subs','gallery','countryoforigin','dd','demo_new','lens_new','coat_new','gender_new'));
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
            // 'photo' => 'max:400',
            'photo' => 'mimes:jpeg,jpg,png,gif|required|max:100|dimensions:min_width=1300,min_height=1160',
            'title' => 'required|max:255',
            'description' => 'required|max:3000',
            'gallery' => 'required',
            'gallery.*' => 'image|mimes:jpeg,jpg,png,gif|max:100|dimensions:min_width=1300,min_height=1160,max_width=1300,max_height=1160',
            'video' => 'mimes:mp4|max:50000',
            'featured'=>'required'
        ]);
        $product = Product::findOrFail($id);
        $input = $request->all();
        
      
        $sub_catg = $request->input('subid');   // get a particular field value
        // dd($sub_catg);
        $sub_new = implode(',', $sub_catg);    //convert array to string with , sperator
      
        $child = $request->input('childid');
        // dd($child);
        $childnew = implode(',', $child);
        // $lense = $request->input('lenstechnology');
        // dd($lense);
        // $lenstechnologynew = implode(',', $lense);
        // dd($lenstechnology);
        // $coat = $request->input('coating');
        // $coating = implode(',',$coat);
        // $lens_new = $request->input('lenstechnology');
        // $lenstechnologynew = implode(',',$lens_new );
        $lense = $request->input('lenstechnology');
        
        $coat_new = $request->input('coating');
        
        // $gendernew = $request->input('gender');
        // $gender_new = implode(',','gendernew');

        // $gender = $request->input('gendernew');
        // $gendernew = implode(',',$gender);
         $gender_new = $request->input('gender');
         // $gender_new = implode(',',$gendernew);
       

        $input['category'] = $request->mainid;
        $input['subid'] =  $sub_new;
        $input['childid'] = $childnew;
        // $input['gender'] = $gender_new;
        // $input['gendernew'] = $gender_new;
        
        

        if (!empty($lense)) {
            $lenstechnologynew = implode(',',$lense );
            $input['lenstechnology'] = $lenstechnologynew;
        }
        if (!empty($coat_new)) {
           $coatingnew = implode(',',$coat_new);
           $input['coating'] =  $coatingnew;
        }

         if (!empty($gender_new)) {
           $gendernew = implode(',',$gender_new);
           $input['gender'] =  $gendernew;
        }
        //  if (!empty($gender_new)) {
        //    $gendernew = implode(',',$gender_new);
        //    $input['gender'] =  $gendernew;
        // }


        // $input['lenstechnology'] =  $lenstechnologynew;
        // $input['coating'] = $coating;

         // $data['lens'] = $lens;
        if ($file = $request->file('photo')){
            $photo_name = time().$request->file('photo')->getClientOriginalName();
            $file->move('assets/images/products',$photo_name);
            $input['feature_image'] = $photo_name;
        }

        if ($request->galdel == 1){
            $gal = Gallery::where('productid',$id);
            $gal->delete();
        }

        if ($request->pallow == ""){
            $input['sizes'] = null;
        }

        // bulkrange
        if ($request->bulkrange == "") {
            
            $input['ranegnameone'] = null;
            $input['p40pieces'] = null;
            $input['rangenametwo'] = null;
            $input['p51pieces'] = null;
            $input['rangenamethree'] = null;
            $input['p5000pieces'] = null;
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
        $product->update($input);
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

