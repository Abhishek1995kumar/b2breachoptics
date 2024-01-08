<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Role;
use Illuminate\Support\Facades\Session;
use DB;
use Hash;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;


class RolleManagerController extends Controller
{
    use RegistersUsers;

    protected $redirectTo = '/dashboard';

    public function __construct()
    {
        $this->middleware('web');
    }

    public function rolleformlist(Request $request)
    {
        if(!in_array('V', session()->get('role')['role_actions']['mrlrole'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        
        $roles = Role::all();
        $admins = DB::table('admin')
            ->select('admin.*', 'roles.role')
            ->leftjoin('roles', 'admin.role', '=', 'roles.id')
            ->where('admin.email', '!=', 'helpdesk@jamztudioz.com')
            ->get();
        // echo "<pre>";
        // print_r($admins); die();
        return view('admin.roleform', compact('roles', 'admins'));
    }

    public function rolleCreateform(Request $request)
    {
        if(!in_array('V', session()->get('role')['role_actions']['mrlrole'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        return view('admin.rolecreateform');
    }

    public function storerole(Request $request)
    {
        if(!in_array('N', session()->get('role')['role_actions']['mrlrole'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $this->validate($request, [
            'role' => 'required|unique:roles,role',
        ]);

        $input = $request->all();
        $role = new Role();
        $role->role = $input['role'];
        $role->status = $input['status'];
        $role->save();

        return redirect('admin/manageroles')->with('message', 'New Role Added Successfully.');
    }

    public function roleEdit(Request $request, $id)
    {
        if(!in_array('U', session()->get('role')['role_actions']['mrlrole'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $role = DB::table('roles')->where('id', $id)->get();
        return view('admin.roledit', compact('role'));
    }

    public function updateRole(Request $request)
    {
        if(!in_array('U', session()->get('role')['role_actions']['mrlrole'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $data['role'] = $request->role;
        DB::table('roles')->where('id', $request->id)->update($data);

        return redirect('admin/manageroles')->with('message', 'Role Update Successfully.');
    }

    public function adminrole(Request $request){
        if(!in_array('N', session()->get('role')['role_actions']['mrlrole'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $roles = DB::table('roles')->get();
        return view('admin.adminuseradd', compact('roles'));
    }

    public function adminrolestore(Request $request)
    {
        if(!in_array('N', session()->get('role')['role_actions']['mrlrole'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $this->validate($request, [
            'email' => 'required|unique:admin,email',
            'phone' => 'required|unique:admin,phone',
            'password' => 'required'
        ]);

        $check = DB::table('admin')->where('email',$request->email)->get();


        $input = array(
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'role' => $request->role,
            'remember_token' => Hash::make($request->token),
            'status' => 1,
        );

        DB::table('admin')->insert($input);
        return redirect('admin/manageroles')->with('success', "Admin User Add Successfully");
    }

    public function rolleEditform(Request $request, $id)
    {
        $admin = DB::table('admin')
                ->select('admin.*', 'roles.role', 'roles.id as rid')
                ->leftjoin('roles', 'admin.role', 'roles.id')
                ->where('admin.id', $id)
                ->get();

        $roles = DB::table('roles')->get();
        return view('admin.adminuseredit', compact('admin', 'roles'));
    }

    public function rolleUpdate(Request $request)
    {
        $data['name'] = $request->name;
        $data['username'] = $request->username;
        $data['phone'] = $request->phone;
        $data['role'] = $request->role;
        if($request->password != ''){
            $data['password'] = Hash::make($request->password);
        }
        DB::table('admin')->where('id', $request->id)->update($data);
        return redirect('admin/manageroles')->with('message', 'Admin Role Updated Successfully.');
    }

    public function adminRoleStatus($id, $status)
    {
        if(!in_array('A', session()->get('role')['role_actions']['mrlrole'])) {
            exit('<h3>Sorry! You have insufficient permissions to access this section</h3>');
        }
        $input['status'] = $status;
        DB::table('admin')->where('id', $id)->update($input);
        Session::flash('message', 'Admin Status Updated Successfully.');
        return redirect('admin/manageroles');
    }

}