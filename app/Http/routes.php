<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', 'HomeController@index');
Route::get('home', ['as' => 'home', 'uses' => 'HomeController@index']);
Route::get('login', ['as' => 'login', 'uses' => 'AuthController@getLogin']);
Route::post('handleLogin', ['as' => 'handleLogin', 'uses' => 'AuthController@handleLogin']);
Route::get('logout', ['as' => 'logout', 'uses' => 'AuthController@logout']);
Route::resource('users', 'UsersController', ['only' => ['create', 'store', 'edit', 'update']]);
Route::resource('tasks', 'TasksController', ['only' => ['index', 'edit', 'update', 'show', 'destroy']]);
