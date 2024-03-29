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
Route::get('tasks/search', ['as' => 'tasks.search', 'uses' => 'TasksController@search']);
Route::resource('tasks', 'TasksController', ['only' => ['index', 'edit', 'update', 'show', 'create', 'store', 'destroy']]);
Route::resource('bid', 'BidController', ['only' => ['show', 'store', 'update']]);
Route::resource('comment', 'CommentController', ['only' => ['store']]);
Route::resource('events', 'EventController', ['only' => ['index']]);
Route::post('handleAcceptBid', ['as' => 'handleAcceptBid', 'uses' => 'BidController@acceptBid']);
Route::post('handleRejectBid', ['as' => 'handleRejectBid', 'uses' => 'BidController@rejectBid']);