<?php

namespace App\Http\Controllers;

use App\Category;
use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Product;

class CategoryController extends Controller
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
        if(count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['mc'])) == 0 && 
            count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['sc'])) == 0 &&
            count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['cc'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        $child = Category::where('role','child')->get();
        $subs = Category::where('role','sub')->get();
        $categories = Category::where('role','main')->get();
       
        return view('admin.categories',compact('categories','subs','child'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(count(array_intersect(['V', 'N'], session()->get('role')['role_actions']['mc'])) == 0 && 
            count(array_intersect(['V', 'N'], session()->get('role')['role_actions']['sc'])) == 0 &&
            count(array_intersect(['V', 'N'], session()->get('role')['role_actions']['cc'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        return view('admin.categoryadd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'slug' => 'required|max:255|unique:categories',
        ]);

        if ($validator->passes()) {
            $category = new Category;
            $category->fill($request->all());
            $category['role'] = "main";
                if ($request->featured == 1){
                    $category->featured = 1;
                }else{
                    $category->featured = 0;
                }
                if ($file = $request->file('fimage')){
                    $photo_name = time().str_random(5).str_replace(' ','_',$request->file('fimage')->getClientOriginalName());
                    $file->move('assets/images/categories',$photo_name);
                    $category['feature_image'] = $photo_name;
                }
            $category->save();
            Session::flash('message', 'New Category Added Successfully.');
            return redirect('admin/categories');
        }
        return redirect()->back()->with('message', 'Category Slug Must Be Unique.');
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
        if(count(array_intersect(['V', 'U'], session()->get('role')['role_actions']['mc'])) == 0 && 
            count(array_intersect(['V', 'U'], session()->get('role')['role_actions']['sc'])) == 0 &&
            count(array_intersect(['V', 'U'], session()->get('role')['role_actions']['cc'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        $category = Category::findOrFail($id);
        return view('admin.categoryedit',compact('category'));
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
        $validator = Validator::make($request->all(),[
            'slug' => 'required|max:255|unique:categories,slug,'.$id,
        ]);

        if ($validator->passes()) {
        $category = Category::findOrFail($id);
        try {
            unlink('assets/images/categories/'.$category->feature_image);
        } catch (\Exception $e) {
            //
        }
        $input = $request->all();
        if ($file = $request->file('fimage')){
            $photo_name = time().str_random(5).str_replace(' ','_',$request->file('fimage')->getClientOriginalName());
            $file->move('assets/images/categories',$photo_name);
            $input['feature_image'] = $photo_name;
        }
        if ($request->featured == 1){
            $input['featured'] = 1;
        }else{
            $input['featured'] = 0;
        }
        $category->update($input);
        Session::flash('message', 'Category Updated Successfully.');
        return redirect('admin/categories');
        }
        return redirect()->back()->with('message', 'Category Slug Must Be Unique.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(count(array_intersect(['V', 'D'], session()->get('role')['role_actions']['mc'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        $category = Category::findOrFail($id);
        $category->delete();
        Session::flash('message', 'Category Deleted Successfully.');
        return redirect('admin/categories');
    }
    
    //Delete All Category and Its Details
    public function delete($id)
    {
        if(count(array_intersect(['V', 'D'], session()->get('role')['role_actions']['mc'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        $category = Category::findOrFail($id);

        $subcategory = Category::where('mainid',$category->id);
        $subcategory->delete();

        if($category->role == "sub"){
            $subchcategory = Category::where('subid',$category->id);
            $subchcategory->delete();
        }

        $childcategory = Category::where('mainid',$category->id);
        $childcategory->delete();

        $products = Product::whereRaw('FIND_IN_SET(?,category)', [$category->id]);
        $products->delete();

        $category->delete();

        Session::flash('message', 'Category Deleted Successfully.');
        return redirect('admin/categories');
    }
}
