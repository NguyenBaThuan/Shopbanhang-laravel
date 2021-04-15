<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\DB;
use App\Models\Roles;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Admin::truncate();
        DB::table('admin_roles')->truncate();

        $adminRoles = Roles::where('name','admin')->first();
        $authorRoles = Roles::where('name','author')->first();
        $userRoles = Roles::where('name','user')->first();
        $admin = Admin::create([
            'admin_name' => 'thuanadmin',
            'admin_email' => 'thuanadmin@gmail.com',
            'admin_phone' => '002248487',
            'admin_password' => md5('123456')
        ]);
        $author = Admin::create([
            'admin_name' => 'thuanauthor',
            'admin_email' => 'thuanauthor@gmail.com',
            'admin_phone' => '002248487',
            'admin_password' => md5('123456')
        ]);
        $user = Admin::create([
            'admin_name' => 'thuanuser',
            'admin_email' => 'thuanuser@gmail.com',
            'admin_phone' => '002248487',
            'admin_password' => md5('123456')
        ]);

        $admin->roles()->attach($adminRoles);
        $author->roles()->attach($authorRoles);
        $user->roles()->attach($userRoles);

        $admin= Admin::factory()->count(5)->create();
    }
}
