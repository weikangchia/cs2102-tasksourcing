<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
     public function run()
     {
       DB::table('users')->delete();
       User::create([
         'username' => 'weikangchia',
         'email' => 'weikangchia@gmail.com',
         'password' => bcrypt('P@ssw0rd')
       ]);
     }
}
