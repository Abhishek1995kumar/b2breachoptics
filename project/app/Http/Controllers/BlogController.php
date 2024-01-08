<?php

namespace App\Http\Controllers;

use App\Blog;
use App\OurOfferings;
use App\SectionTitles;
use App\policy;
use Illuminate\Http\Request;
use DB;

class BlogController extends Controller
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
        if(count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['bsc'])) == 0 && 
            count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['bst'])) == 0 &&
            count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['poli'])) == 0 &&
            count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['ooff'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        $titles = SectionTitles::findOrFail(1);
        $blogs = Blog::all();
        $policy = policy::all();
        $details = DB::table('OurOfferings')->get();
        // dd($details);
        $policycount = policy::count();
        return view('admin.blogsection',compact('blogs','titles','policy','policycount','details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(count(array_intersect(['V', 'N'], session()->get('role')['role_actions']['bsc'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        return view('admin.blogadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = new Blog();
        $blog->fill($request->all());

        if ($file = $request->file('image')){
            $photo_name = str_random(3).$request->file('image')->getClientOriginalName();
            $file->move('assets/images/blog',$photo_name);
            $blog['featured_image'] = $photo_name;
        }
        $blog->save();
        return redirect('admin/blog')->with('message','New Blog Added Successfully.');
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
        if(count(array_intersect(['V', 'U'], session()->get('role')['role_actions']['bsc'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        $blog = Blog::findOrFail($id);
        return view('admin.blogedit',compact('blog'));
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
        $blog = Blog::findOrFail($id);
        $data = $request->all();

        if ($file = $request->file('image')){
            $photo_name = str_random(3).$request->file('image')->getClientOriginalName();
            $file->move('assets/images/blog',$photo_name);
            $data['featured_image'] = $photo_name;
        }
        $blog->update($data);
        return redirect('admin/blog')->with('message','Blog Updated Successfully.');
    }

    public function titles(Request $request)
    {
        $blog = SectionTitles::findOrFail(1);
        $data['blog_title'] = $request->blog_title;
        $data['blog_text'] = $request->blog_text;
        $blog->update($data);
        return redirect('admin/blog')->with('message','Blog Section Title & Text Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(count(array_intersect(['D'], session()->get('role')['role_actions']['bsc'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        $blog = Blog::findOrFail($id);
        $blog->delete();
        return redirect('admin/blog')->with('message','Blog Delete Successfully.');
    }

    // pranali's Code for Blog policy section

    public function policy()
    {
        if(count(array_intersect(['V', 'N', 'U', 'D'], session()->get('role')['role_actions']['poli'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        $titles = PolicyTitles::findOrFail(1);
        $details =policy::all();
        return view('admin.policysection',compact('titles','details'));
    }

    public function createpolicy()
    {
        if(count(array_intersect(['V', 'N'], session()->get('role')['role_actions']['poli'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        return view('admin.policyadd');
    }

    public function storepolicy(Request $request)
    {
        $policy = new policy();
        // dd($policy);
        $policy->fill($request->all());

        $policy->save();
        return redirect('admin/blog')->with('message','New Policy Added Successfully.');
    }

    public function policyedit($id)
    {
        if(count(array_intersect(['V', 'U'], session()->get('role')['role_actions']['poli'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        $policy = policy::findOrFail($id);
        return view('admin.policyedit',compact('policy'));
    }

    public function policyupdate(Request $request, $id)
    {
        $policy = policy::findOrFail($id);
        $data = $request->all();

        $policy->update($data);
        return redirect('admin/blog')->with('message','policy Updated Successfully.');
    }

    public function policydestroy($id)
    {
        if(count(array_intersect(['D'], session()->get('role')['role_actions']['poli'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        $policy = policy::findOrFail($id);
        $policy->delete();
        return redirect('admin/blog')->with('message','policy Delete Successfully.');
    }

    // end pranali's Code for blog policy section



// OurOfferings code start//
// public function OurOfferings()
// {
//     // $titles =OurOfferingstitles::findOrFail(1);
//     $details =DB::table('OurOfferings')->get();
//     // dd($details);
//     return view('admin.blogsection',compact('details'));
// }

 public function createourofferings()
{
    if(count(array_intersect(['V', 'N', 'U', 'D'], session()->get('role')['role_actions']['ooff'])) == 0) {
        exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
    }
    return view('OurOfferingsadd');
}


 public function storeourofferings(Request $request)
{
        $OurOfferings = new OurOfferings();
        $OurOfferings->fill($request->all());
          if ($file = $request->file('image')){
            $photo_name = str_random(3).$request->file('image')->getClientOriginalName();
            $file->move('assets/images/sliders',$photo_name);
            $OurOfferings['image'] = $photo_name;
        }
        $OurOfferings->save();
        return redirect('admin/blog')->with('message','New OurOfferings Added Successfully');
}

public function OurOfferingsdestroy($id)
{
    if(count(array_intersect(['D'], session()->get('role')['role_actions']['ooff'])) == 0) {
        exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
    }
    $OurOfferings =OurOfferings::findOrFail($id);
    $OurOfferings->delete();
    return redirect('admin/blog')->with('message','OurOfferings Delete Successfully');
}

//OurOfferingd code end//
}