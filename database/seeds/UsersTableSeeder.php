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

    $users = [
      [
        'username' => 'weikangchia',
        'email' => 'weikangchia@mailinator.com',
        'password' => bcrypt('P@ssw0rd'),
        'role' => 'user'
      ],
      [
        'username' => 'david',
        'email' => 'david@mailinator.com',
        'password' => bcrypt('P@ssw0rd'),
        'role' => 'user'
      ],
      [
        'username' => 'admin',
        'email' => 'admin@mailinator.com',
        'password' => bcrypt('P@ssw0rd'),
        'role' => 'admin'
      ]
    ];

    foreach($users as $user){
      User::create($user);
    }
  }
}
