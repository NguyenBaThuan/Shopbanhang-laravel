<?php

namespace Database\Factories;
use App\Models\Roles;
use App\Models\Admin;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdminFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Admin::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'admin_name' => $this->faker->name,
            'admin_email' => $this->faker->unique()->safeEmail,
            'admin_phone' => '15154878487',
            'admin_password' => 'e10adc3949ba59abbe56e057f20f883e', // password
        ];
    }
    public function configure()
    {
        return $this->afterCreating(function (Admin $admin) {
            $roles = Roles::where('name','user')->get();
	        $admin->roles()->sync($roles->pluck('id_roles')->toArray());
        });
    }
}
