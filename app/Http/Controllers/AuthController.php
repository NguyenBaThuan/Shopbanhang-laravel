<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Admin;
use App\Models\Roles;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function register_auth(){
        return view('admin.custom_auth.register');
    }

    public function register(Request $request){
        $this->validation($request);
        $data = $request->all();
        $admin = new Admin();
        $admin->admin_name = $data['admin_name'];
        $admin->admin_email = $data['admin_email'];
        $admin->admin_phone = $data['admin_phone'];
        $admin->admin_password = md5($data['admin_password']);
        $admin->save();
        return redirect('/register-auth')->with('message','Đăng kí thành công');
    }

    public function validation($request){
       return $this->validate($request,[
            'admin_name' => 'required|max:255',
            'admin_email' => 'required|max:255',
            'admin_phone' => 'required',
            'admin_password' => 'required',
            
       ]);
    }
    public function login_auth(){
        return view('admin.custom_auth.login_auth');
    }
    public function login(Request $request){
        $this->validate($request,[        
            'admin_email' => 'required|max:255',
            'admin_password' => 'required',
            
       ]);
        $credentials = $request->only('admin_email','admin_password');
        if(Auth::attempt($credentials)){
            return redirect('/dashboard');
        }else{
             return redirect('/login-auth')->with('message','Lỗi đăng nhập authentication');
         }

    }

    public function logout_auth(){
        Auth::logout();
        return redirect('/login-auth')->with('message','Đăng xuất thàng công');

    }
}
