<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name'=> 'normal user',
                'username'=>'normaluser',
                'email'=>'user@gmail.com',
                'role'=>'user',
                'status'=> 'active',
                'password'=>bcrypt(env('USER_PASSWORD'))
            ],
            [
                'name'=> 'Admin user',
                'username'=>'adminuser',
                'email'=>'admin@gmail.com',
                'role'=>'admin',
                'status'=> 'active',
                'password'=>bcrypt(env('ADMIN_PASSWORD'))
            ]
        ]);
    }
}
