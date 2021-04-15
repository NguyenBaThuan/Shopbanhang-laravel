<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use Illuminate\Support\Facades\Auth;
use App\Models\Roles;

class UserController extends Controller
{
    public function index()
    {
        $admin = Admin::with('roles')->orderBy('admin_id','DESC')->paginate(5);
        return view('admin.users.all_users')->with(compact('admin'));;
    }
    public function add_users(){
        return view('admin.users.add_users');
    }

    public function assign_roles(Request $request){

        if(Auth::id()==$request->admin_id){
            return redirect()->back()->with('message','Bạn không được phân quyền chính mình');
        }

        $user = Admin::where('admin_email',$request->admin_email)->first();
        $user->roles()->detach(); // detach loai bo quyen

        if($request->author_role){
           $user->roles()->attach(Roles::where('name','author')->first()); // attach : them quyen     
        }
        if($request->user_role){
           $user->roles()->attach(Roles::where('name','user')->first());     
        }
        if($request->admin_role){
           $user->roles()->attach(Roles::where('name','admin')->first());     
        }
        return redirect()->back()->with('message','Cấp quyền thành công');
    }
}
