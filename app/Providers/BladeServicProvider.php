<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use App\Models\Admin;


class BladeServicProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Blade::if('hasrole',function($expression){
            if(Auth::user()){
                if(Auth::user()->hasAnyRoles($expression)){
                    return true;
                }
            }
            return false;
        });
        Blade::if('impersonate',function(){
            if(Session::get('impersonate')){
                return true;
            }
            return false;
        });
    }
}
