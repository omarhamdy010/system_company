<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'omar',
            'email'=>'omar@omar.com',
            'password'=>bcrypt('123456789'),
            'phone'=>'123456789',
            'is_admin'=>1,
            'status'=>1,
        ]);
    }
}
