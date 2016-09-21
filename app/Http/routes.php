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

Route::get('join', function() {
  return View::make('sign-up');
});

Route::get('login', function() {
  return View::make('login');
});

Route::get('books.json', function () {
  //$results = DB::select('SELECT * FROM book');
  $results = DB::select('SELECT t.name, t.category FROM task t');

  return response()->json($results);
});
