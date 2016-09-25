<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\QueryException;

class User extends Authenticatable
{
  /**
  * The attributes that are mass assignable.
  *
  * @var array
  */
  protected $fillable = [
    'username', 'email', 'password',
  ];

  /**
  * The attributes that should be hidden for arrays.
  *
  * @var array
  */
  protected $hidden = [
    'password', 'remember_token',
  ];

  public static function create(array $data = array())
  {
    try {
      $query = \DB::insert("INSERT INTO users (username, email, password, role, created_at, updated_at)
      VALUES (:username, :email, :password, 'user', :created_at, :updated_at)",
      [
        'username' => $data['username'],
        'email' => $data['email'],
        'password' => $data['password'],
        'created_at' => $data['created_at'],
        'updated_at' => $data['updated_at']
      ]);
    } catch(QueryException $e) {
      return false;
    }

    return true;
  }

  public static function find($key)
  {
    try {
      $query = \DB::select("SELECT * FROM users WHERE id = :id",
      [
        'id' => $key,
      ]);
      $user = new User();
      $user->id = $query[0]->id;
      $user->username = $query[0]->username;
      $user->email = $query[0]->email;
      $user->first_name = $query[0]->first_name;
      $user->last_name = $query[0]->last_name;
      $user->reputation = $query[0]->reputation;
    } catch(QueryException $e) {
      return false;
    }

    return $user;
  }

  public static $createValidationRules = [
    'username' => 'required|unique:users|min:5',
    'email' => 'required|email|unique:users',
    'password' => 'required|min:7'
  ];

  public static $loginValidationRules = [
    'email' => 'required|email|exists:users',
    'password' => 'required|min:7'
  ];
}
