<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Auth;
use App\Http\Requests;

define ('NEXT_LINE', '<br>');

class TasksController extends Controller
{
	
	
	/**
	* Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
		if (Auth::check())
		{
			try {
				$results = \DB::select(
                    "SELECT t.id AS t_id, t.name AS task_name, t.description AS task_description,
                        t.postal_code, t.start_date, t.start_time, t.cash_value, t.duration, t.location,
                        c.name AS category_name, u.id AS user_id, u.username, u.profile_photo,
                        u.reputation  FROM Task t, Category c, Users u 
                        WHERE t.category = c.id 
                        AND t.posted_by = u.id
                        ORDER BY t.created_at DESC"
                );
			}
			catch(QueryException $e) {
				return false;
			}

			return view('all-task')->with('tasks',$results);
		}
		else
        {
			return redirect()->route('login');
		}
	}
	
	
	
	/**
	* Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        //
	}
	
	
	
	/**
	* Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
		//
	}
	
	
	
	/**
	* Display the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function show($id)
    {
		$task = Task::find($id);

        return view('task')->with('task', $task);
	}
	
	
	
	/**
	* Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
		//
	}
	
	
	
	/**
	* Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
		//
	}
	
	
	
	/**
	* Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
		//
	}
}
