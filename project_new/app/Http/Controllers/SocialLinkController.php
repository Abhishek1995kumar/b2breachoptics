<?php

namespace App\Http\Controllers;

use App\SocialLink;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class SocialLinkController extends Controller
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
        if(count(array_intersect(['V', 'U', 'N', 'D'], session()->get('role')['role_actions']['sslink'])) == 0) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $social = SocialLink::find(1);
        return view('admin.socialsettings',compact('social'));
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
        $user = SocialLink::findOrFail($id);
        $input = $request->all();
        if ($request->f_status == ""){
            $input['f_status'] = "disable";
        }
        if ($request->t_status == ""){
            $input['t_status'] = "disable";
        }

        if ($request->g_status == ""){
            $input['g_status'] = "disable";
        }

        if ($request->link_status == ""){
            $input['link_status'] = "disable";
        }

        $user->update($input);
        Session::flash('message', 'Social Links Updated Successfully.');
        return redirect('admin/social');
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
}
