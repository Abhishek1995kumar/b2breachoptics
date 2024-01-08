<?php


namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class ChildCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth',['except' => 'childcats']);
    }

    public function index()
    {
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
        if(count(array_intersect(['V', 'N'], session()->get('role')['role_actions']['cc'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $categories = Category::where('role','main')->get();
        return view('admin.childcategoryadd',compact('categories'));
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
            $category['role'] = "child";
            if ($request->featured == 1){
                $category->featured = 1;
            }else{
                $category->featured = 0;
            }
            if ($file = $request->file('fimage')){
                $photo_name = time().str_random(7).str_replace(' ','_',$request->file('fimage')->getClientOriginalName());
                
                $file->move('assets/images/categories',$photo_name);
                $category['feature_image'] = $photo_name;
            }
            
            $category->save();
            Session::flash('message', 'New Child Category Added Successfully.');
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
        if(count(array_intersect(['V', 'U'], session()->get('role')['role_actions']['cc'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $category = Category::findOrFail($id);
        $categories = Category::where('role','main')->get();
        $subcats = Category::where('mainid',$category->mainid->id)->where('role','sub')->get();
        return view('admin.childcategoryedit',compact('categories','category','subcats'));
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
            'slug' => 'required|max:255|unique:categories,slug,'.$id
        ]);

        if ($validator->passes()) {
            $category = Category::findOrFail($id);
            $input = $request->all();
            try {
                unlink('assets/images/categories/'.$category->feature_image);
            } catch (\Exception $e) {
                //
            }
            if ($file = $request->file('fimage')){
                $photo_name = time().str_random(7).str_replace(' ','_',$request->file('fimage')->getClientOriginalName());
                $file->move('assets/images/categories',$photo_name);
                $input['feature_image'] = $photo_name;
            }
            if ($request->featured == 1){
                $input['featured'] = 1;
            }else{
                $input['featured'] = 0;
            }
            $category->update($input);
            Session::flash('message', 'Child Category Updated Successfully.');
            return redirect('admin/categories');
        }
        return redirect()->back()->with('message', 'Category Slug Must Be Unique.');
    }
public function childcats(Request $request)
    {
        // print_r("Hello");die();
        $demo = $request->subid;

        
        $name = array();

        for($i = 0; $i < count($demo); $i++) {
                 if($demo[$i] != '')  {
                $query =  Category::where('subid', '=', $demo[$i])->get();
               
                foreach ($query as $p) {
                    $name['id'][] = $p->id;
                    $name['name'][] = $p->name;
                    }
               
                
           
            }
           
        }


       
       
        return response()->json(['response' => $name]);
    }





    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(count(array_intersect(['D'], session()->get('role')['role_actions']['cc'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $category = Category::findOrFail($id);
        $category->delete();
        Session::flash('message', 'Child Category Deleted Successfully.');
        return redirect('admin/categories');
    }
}
