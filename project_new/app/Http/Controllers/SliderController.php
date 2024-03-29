<?php

namespace App\Http\Controllers;

use App\Slider;
use Illuminate\Http\Request;

class SliderController extends Controller
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
        if(count(array_intersect(['V', 'N', 'U', 'D'], session()->get('role')['role_actions']['ssl'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        $sliders = Slider::all();
        return view('admin.sliderlist',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(count(array_intersect(['N'], session()->get('role')['role_actions']['ssl'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        return view('admin.slideradd');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slider = new Slider();
        $slider->fill($request->all());

        if ($file = $request->file('image')){
            $photo_name = str_random(3).$request->file('image')->getClientOriginalName();
            $file->move('assets/images/sliders',$photo_name);
            $slider['image'] = $photo_name;
        }
        $slider->save();
        return redirect('admin/sliders')->with('message','Slider Added Successfully.');
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
        if(count(array_intersect(['U'], session()->get('role')['role_actions']['ssl'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        $slider = Slider::findOrFail($id);
        return view('admin.slideredit',compact('slider'));
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
        $slider = Slider::findOrFail($id);
        $data = $request->all();

        if ($file = $request->file('image')){
            $photo_name = str_random(3).$request->file('image')->getClientOriginalName();
            $file->move('assets/images/sliders',$photo_name);
            $data['image'] = $photo_name;
        }
        $slider->update($data);
        return redirect('admin/sliders')->with('message','Slider Updated Successfully.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(count(array_intersect(['D'], session()->get('role')['role_actions']['ssl'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section1</h3>');
        }
        $slider = Slider::findOrFail($id);
        $slider->delete();
        return redirect('admin/sliders')->with('message','Slider Delete Successfully.');
    }
}
