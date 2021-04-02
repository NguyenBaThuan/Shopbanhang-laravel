<?php

namespace App\Http\Controllers;
use App\Models\Social; //sử dụng model Social
use App\Models\Login; //sử dụng model Login
use Illuminate\Support\Facades\Session;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    public function login_facebook(){
        return Socialite::driver('facebook')->redirect();
    }

    public function callback_facebook(){
        $users = Socialite::driver('facebook')->stateless()->user(); 
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'facebook');
            $account_name = Login::where('admin_id',$authUser->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
        return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
    }

    //login google
    public function login_google(){
        return Socialite::driver('google')->redirect();
   }
    public function callback_google(){
        $users = Socialite::driver('google')->stateless()->user(); 
        // return $users->id;
        $authUser = $this->findOrCreateUser($users,'google');
            $account_name = Login::where('admin_id',$authUser->user)->first();
            Session::put('admin_name',$account_name->admin_name);
            Session::put('admin_id',$account_name->admin_id);
        return redirect('/dashboard')->with('message', 'Đăng nhập Admin thành công');
        
    }
    public function findOrCreateUser($users,$provider){
        $authUser = Social::where('provider_user_id', $users->id)->first();
        if($authUser){

            return $authUser;
        }else{
            $customer_new = new Social([
                'provider_user_id' => $users->id,
                'provider' => strtoupper($provider)
            ]);
    
            $orang = Login::where('admin_email',$users->email)->first();
    
                if(!$orang){
                    $orang = Login::create([
                        'admin_name' => $users->name,
                        'admin_email' => $users->email,
                        'admin_password' => '',
                        'admin_phone' => '',
                    ]);
                }
            $customer_new->login()->associate($orang);
            $customer_new->save();
            return  $customer_new;
        }
    }


}
