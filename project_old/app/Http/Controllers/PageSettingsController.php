<?php

namespace App\Http\Controllers;

use App\Brand;
use App\FAQ;
use App\PageSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use DB;

class PageSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if(count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['faqpage'])) == 0 && 
            count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['blpage'])) == 0 &&
            count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['hbpage'])) == 0 &&
            count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['nhpage'])) == 0 &&
            count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['nmpage'])) == 0 &&
            count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['bspage'])) == 0 &&
            count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['nsbpage'])) == 0 &&
            count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['lhbpage'])) == 0 &&
            count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['aupage'])) == 0 &&
            count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['cupage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        
        $brands = Brand::where('type','brand')->get();
        $banners = Brand::where('type','banner')->get();
        $newsliders = Brand::where('type','newslider')->get();
        $mainslider = Brand::where('type','newmainslider')->get();
        $smallbox = Brand::where('type','smallbox')->get();
        $countnewslider = Brand::where('type','newslider')->count();
        $countmainslider = Brand::where('type','newmainslider')->count();
        $smallboxcount = Brand::where('type','smallbox')->count();
      
        $bottomslidernew = Brand::where('type','bottomslider')->count();
        $bottomslider = Brand::where('type','bottomslider')->get();
        
        $product_baner =  DB::table('product_baner')
                        ->select('product_baner.*','categories.name as cat_name')
                        ->join('categories','categories.id','=','product_baner.cat_name')
                        ->get();
        $count_product_baner =  DB::table('product_baner')->where('cat_name')->count();
        $faqs = FAQ::all();
        $pagedata = PageSettings::find(1);
        return view('admin.pagesettings',compact('pagedata','product_baner','count_product_baner','faqs','brands','banners','newsliders','mainslider','countnewslider','countmainslider','smallbox','smallboxcount','bottomslider','bottomslidernew'));
    }

    //Banner Add,Edit,Update
    public function addbanner()
    {
        if(count(array_intersect(['N'], session()->get('role')['role_actions']['hbpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        return view('admin.banneradd');
    }

    public function bannerdelete($id)
    {
        if(count(array_intersect(['D'], session()->get('role')['role_actions']['hbpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        Brand::findOrFail($id)->delete();
        return redirect('admin/pagesettings')->with('message','Banner Deleted Successfully.');
    }

    public function banneredit($id)
    {
        if(count(array_intersect(['U'], session()->get('role')['role_actions']['hbpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $banner = Brand::findOrFail($id);
        return view('admin.banneredit',compact('banner'));
    }

    public function bannersave(Request $request)
    {
        $brand = new Brand();
        $brand->fill($request->all());
        $brand->type='banner';
        if ($file = $request->file('blogo')){
            $photo_name = time().$request->file('blogo')->getClientOriginalName();
            $file->move('assets/images/brands',$photo_name);
            $brand['image'] = $photo_name;
        }
        $brand->save();
        Session::flash('message', 'New Banner Added Successfully.');
        return redirect('admin/pagesettings');
    }

    public function bannerupdate(Request $request,$id)
    {
        $brand = Brand::findOrFail($id);
        $data = $request->all();
        $data['type']='banner';
        if ($file = $request->file('blogo')){
            $photo_name = time().$request->file('blogo')->getClientOriginalName();
            $file->move('assets/images/brands',$photo_name);
            $data['image'] = $photo_name;
        }
        $brand->update($data);
        Session::flash('message', 'Banner Updated Successfully.');
        return redirect('admin/pagesettings');
    }



    // New Home slider Add,Edit,Update
    
    public function addnewsliders()
    {
        if(count(array_intersect(['N'], session()->get('role')['role_actions']['nhpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        return view('admin.slideraddnew');
    }

    public function newsliderdelete($id)
    {
        if(count(array_intersect(['D'], session()->get('role')['role_actions']['nhpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        Brand::findOrFail($id)->delete();
        return redirect('admin/pagesettings')->with('message','New Home Slider Deleted Successfully.');
    }

    public function newslideredit($id)
    {
        if(count(array_intersect(['U'], session()->get('role')['role_actions']['nhpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $slider = Brand::findOrFail($id);
        return view('admin.newslideredit',compact('slider'));
    }

    public function newslidersave(Request $request)
    {
        $brand = new Brand();
        $brand->fill($request->all());
        $brand->type='newslider';
        if ($file = $request->file('sliderimg')){
            $photo_name = time().$request->file('sliderimg')->getClientOriginalName();
            $file->move('assets/images/sliders',$photo_name);
            $brand['image'] = $photo_name;
        }
        $brand->save();
        Session::flash('message', 'New Home Slider Image Added Successfully.');
        return redirect('admin/pagesettings');
    }

    public function newsliderupdate(Request $request,$id)
    {
        $brand = Brand::findOrFail($id);
        $data = $request->all();
        $data['type']='newslider';
        if ($file = $request->file('newsliderimg')){
            $photo_name = time().$request->file('newsliderimg')->getClientOriginalName();
            $file->move('assets/images/sliders',$photo_name);
            $data['image'] = $photo_name;
        }
        $brand->update($data);
        Session::flash('message', 'New Home Slider Updated Successfully.');
        return redirect('admin/pagesettings');
    }



// main slider add , edit, delete


    public function addnewmainsliders()
    {
        if(count(array_intersect(['N'], session()->get('role')['role_actions']['nmpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        return view('admin.mainslideradd');
    }

    public function mainslideredit($id)
    {
        if(count(array_intersect(['U'], session()->get('role')['role_actions']['nmpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $mainslider = Brand::findOrFail($id);
        return view('admin.mainslideredit',compact('mainslider'));
    }

    public function mainsliderdelete($id)
    {
        if(count(array_intersect(['D'], session()->get('role')['role_actions']['nmpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        Brand::findOrFail($id)->delete();
        return redirect('admin/pagesettings')->with('message','Main Home Slider Deleted Successfully.');
    }


    public function mainslidersave(Request $request)
    {
        $brand = new Brand();
        $brand->fill($request->all());
        $brand->type='newmainslider';
        if ($file = $request->file('mainslider')){
            $photo_name = time().$request->file('mainslider')->getClientOriginalName();
            $file->move('assets/images/sliders',$photo_name);
            $brand['image'] = $photo_name;
        }
        $brand->save();
        Session::flash('message', ' Home Slider Main Image Added Successfully.');
        return redirect('admin/pagesettings');
    }

    public function mainsliderupdate(Request $request,$id)
    {
        $brand = Brand::findOrFail($id);
        $data = $request->all();
        $data['type']='newmainslider';
        if ($file = $request->file('mainsliderimg')){
            $photo_name = time().$request->file('mainsliderimg')->getClientOriginalName();
            $file->move('assets/images/sliders',$photo_name);
            $data['image'] = $photo_name;
        }
        $brand->update($data);
        Session::flash('message', ' Home Main Slider Updated Successfully.');
        return redirect('admin/pagesettings');
    }


    // Small Box Edit ,delete, add

    public function addsmallbox()
    {
        if(count(array_intersect(['N'], session()->get('role')['role_actions']['nsbpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        return view('admin.addsmallbox');
    }

    public function smallboxdelete($id)
    {
        if(count(array_intersect(['D'], session()->get('role')['role_actions']['nsbpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        Brand::findOrFail($id)->delete();
        return redirect('admin/pagesettings')->with('message','Small Box Image Deleted Successfully.');
    }

    public function smallboxedit($id)
    {
        if(count(array_intersect(['U'], session()->get('role')['role_actions']['nsbpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $smallbox = Brand::findOrFail($id);
        return view('admin.smallboxedit',compact('smallbox'));
    }

    public function smallboxsave(Request $request)
    {
        $brand = new Brand();
        $brand->fill($request->all());
        $brand->type='smallbox';
        if ($file = $request->file('smbox')){
            $photo_name = time().$request->file('smbox')->getClientOriginalName();
            $file->move('assets/images/sliders',$photo_name);
            $brand['image'] = $photo_name;
        }
        $brand->save();
        Session::flash('message', ' Small Box Image Added Successfully.');
        return redirect('admin/pagesettings');
    }

    public function smallboxupdate(Request $request,$id)
    {
        $brand = Brand::findOrFail($id);
        $data = $request->all();
        $data['type']='smallbox';
        if ($file = $request->file('smbox')){
            $photo_name = time().$request->file('smbox')->getClientOriginalName();
            $file->move('assets/images/sliders',$photo_name);
            $data['image'] = $photo_name;
        }
        $brand->update($data);
        Session::flash('message', ' Small Box Image Updated Successfully.');
        return redirect('admin/pagesettings');
    }
    // Nik Product Baner
    public function productbaners()
    {
        return view('admin.product_baner');
    }
    
    public function product_Baner_form(Request $request)
    {
        $category_name = $request->cat_name;
        $count_product_baner =  DB::table('product_baner')->where('cat_name',$category_name)->count();

        if($count_product_baner == 3)
        {
            return response()->json(['status'=>'404', 'msg'=>'Category Base Only 3 Banner Add']);
        }else{
            $base_path = explode("/", base_path());
            $base_path[count($base_path)-1] = 'assets';
            $base_path = implode("/", $base_path);
            $target_path = $base_path."/images/product_baner/";
        
            if($request->file('pro_baner')){
                $file= $request->file('pro_baner');
            
                $filename= random_int(111111, 999999).$file->getClientOriginalName();
            
                $_FILES['pro_baner']['name'] = $filename;
            
                $file-> move($target_path."pro_baner", $filename);
            }
            $cat_name = $request->input('cat_name');
            $pro_baner =  $_FILES['pro_baner']['name'];
            $pro_baner_url = $request->input('pro_baner_url');
            $data=array('cat_name'=>$cat_name,"pro_baner"=>$pro_baner, 'pro_baner_url'=>$pro_baner_url);
            DB::table('product_baner')->insert($data);
            Session::flash('message', '');
            return response()->json(['status'=>'200', 'msg'=>'Product Baner Add Successfully..']);
        }
    }
    
    public function Product_baner_delete($id)
    {
        $data = DB::table('product_baner')->where('id', $id)->get()[0];
        try {
            unlink('assets/images/product_baner/pro_baner/'.$data->pro_baner);
        } catch (\Exception $e) {
            //
        }
        DB::table('product_baner')->delete($id);
        return redirect('admin/pagesettings')->with('message','Product Baner Deleted Successfully.');
    }
    //End NIk 

    //Brand Logo Add,Edit,Update
    public function addbrand()
    {
        if(count(array_intersect(['N'], session()->get('role')['role_actions']['blpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        return view('admin.brandadd');
    }

    public function branddelete($id)
    {
        if(count(array_intersect(['D'], session()->get('role')['role_actions']['blpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        Brand::findOrFail($id)->delete();
        return redirect('admin/pagesettings')->with('message','Brand Deleted Successfully.');
    }

    public function brandedit($id)
    {
        if(count(array_intersect(['U'], session()->get('role')['role_actions']['blpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $brand = Brand::findOrFail($id);
        return view('admin.brandedit',compact('brand'));
    }

    public function brandsave(Request $request)
    {
        $brand = new Brand();
        $brand->fill($request->all());
        $brand->type='brand';
        if ($file = $request->file('blogo')){
            $photo_name = time().$request->file('blogo')->getClientOriginalName();
            $file->move('assets/images/brands',$photo_name);
            $brand['image'] = $photo_name;
        }
        $brand->save();
        Session::flash('message', 'New Brand Logo Added Successfully.');
        return redirect('admin/pagesettings');
    }
    //Large Banner
    public function largebanner(Request $request)
    {
        if(count(array_intersect(['V', 'U'], session()->get('role')['role_actions']['lhbpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $page = PageSettings::findOrFail(1);
        $input = $request->all();

        if ($file = $request->file('large_banner')) {
            $banner = $request->file('large_banner');
            $name = time().$banner->getClientOriginalName();
            $banner->move('assets/images', $name);
            $input['large_banner'] = $name;
        }
        $page->update($input);
        Session::flash('message', 'Large Banner Updated Successfully.');
        return redirect('admin/pagesettings');
    }

    public function brandupdate(Request $request,$id)
    {
        $brand = Brand::findOrFail($id);
        $data = $request->all();
        $brand->update($data);
        Session::flash('message', 'Brand Updated Successfully.');
        return redirect('admin/pagesettings');
    }

    //FAQ Page Add,Edit,Update
    public function addfaq()
    {
        if(count(array_intersect(['N'], session()->get('role')['role_actions']['faqpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        return view('admin.faqadd');
    }

    public function faqdelete($id)
    {
        if(count(array_intersect(['D'], session()->get('role')['role_actions']['faqpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        FAQ::findOrFail($id)->delete();
        return redirect('admin/pagesettings')->with('message','FAQ Deleted Successfully.');
    }

    public function faqedit($id)
    {
        if(count(array_intersect(['U'], session()->get('role')['role_actions']['faqpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $faq = FAQ::findOrFail($id);
        return view('admin.faqedit',compact('faq'));
    }

    public function faqsave(Request $request)
    {
        $faq = new FAQ();
        $faq->fill($request->all());
        $faq->save();
        Session::flash('message', 'New FAQ Added Successfully.');
        return redirect('admin/pagesettings');
    }

    public function faqupdate(Request $request,$id)
    {
        $faq = FAQ::findOrFail($id);
        $data = $request->all();
        $faq->update($data);
        Session::flash('message', 'FAQ Updated Successfully.');
        return redirect('admin/pagesettings');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
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
        //
    }

    //Upadte About Page Section Settings
    public function about(Request $request)
    {
        if(count(array_intersect(['V', 'U'], session()->get('role')['role_actions']['aupage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $page = PageSettings::findOrFail(1);
        $input = $request->all();
        if ($request->a_status == ""){
            $input['a_status'] = 0;
        }
        $page->update($input);
        Session::flash('message', 'About Us Page Content Updated Successfully.');
        return redirect('admin/pagesettings');
    }

    //Upadte FAQ Page Section Settings
    public function faq(Request $request)
    {
        if(count(array_intersect(['V', 'A'], session()->get('role')['role_actions']['faqpage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $page = PageSettings::findOrFail(1);
        $input = $request->all();
        if ($request->f_status == ""){
            $input['f_status'] = 0;
        }
        $page->update($input);
        Session::flash('message', 'FAQ Page Content Updated Successfully.');
        return redirect('admin/pagesettings');
    }

    //Upadte Contact Page Section Settings
    public function contact(Request $request)
    {
        if(count(array_intersect(['V', 'U'], session()->get('role')['role_actions']['cupage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $page = PageSettings::findOrFail(1);
        $input = $request->all();
        if ($request->c_status == ""){
            $input['c_status'] = 0;
        }
        $page->update($input);
        Session::flash('message', 'Contact Page Content Updated Successfully.');
        return redirect('admin/pagesettings');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // pranalis's code for bottomslider 

    public function addbottomslider()
    {
        if(count(array_intersect(['V', 'N'], session()->get('role')['role_actions']['bspage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        return view('admin.bottomslider');
    }
      public function bottomslidersave(Request $request )
    {
        $brand = new Brand();
        $brand->fill($request->all());
        $brand->type='bottomslider';
        if($file = $request->file('bottomslider')){
            $photo_name = time().$request->file('bottomslider')->getClientOriginalName();
            $file->move('assets/images/sliders',$photo_name);
            $brand['image'] =$photo_name;

        }
        $brand->save();
        Session::flash('message','bottom slider Image Added Successfully.');
        return redirect('admin/pagesettings');
    }
    public function bottomslideredit($id)
    {
        if(count(array_intersect(['U'], session()->get('role')['role_actions']['bspage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $bottomslider = Brand::findOrFail($id);
        return view('admin.bottomslideredit',compact('bottomslider'));
    }
    public function bottomsliderupdate(Request $request,$id)
    {
        $brand = Brand::findOrFail($id);
        $data = $request->all();
        $data['type']='bottomslider';
        if ($file = $request->file('bottomsliderimg')){
            $photo_name = time().$request->file('bottomsliderimg')->getClientOriginalName();
            $file->move('assets/images/sliders',$photo_name);
            $data['image'] = $photo_name;
        }
        $brand->update($data);
        Session::flash('message', 'bottom Slider Updated Successfully.');
        return redirect('admin/pagesettings');
    }
    public function bottomsliderdelete($id)
    {
        if(count(array_intersect(['D'], session()->get('role')['role_actions']['bspage'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        Brand::findOrFail($id)->delete();
        return redirect('admin/pagesettings')->with('message','bottom Slider Deleted Successfully.');
    }

    // end of pranali's code for bottomslider




}
