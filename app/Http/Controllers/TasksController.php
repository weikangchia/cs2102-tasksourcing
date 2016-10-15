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
		//
	}
	
	
	
	/**
	* Show the form for editing the specified resource.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function edit($id)
    {
    	$days = range(1, 31);
    	$months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');
    	$years = range(2016, 2025);

    	$hours = range(0, 23);
    	$minutes = range(0, 59);
    	$task = Task::find($id);
		return view('edit-task', compact('days', 'months', 'years', 'hours', 'minutes', 'task'));
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
       $optional = [
       	 'description'  => 'max:255',
       	 'duration'		=> 'integer',
       	 'location'		=> 'max:120',
         'postal_code'  => 'integer',
         'cash_value'	=> 'numeric'
       ];

       $task = Task::find($id);
       $required = [
         'name'	=> 'required|max:64'
       ];

       $task->name = $request->name;

       if($request->description != '')
       {
         $required['description'] = $optional['description'];
         $task->description = $request->description;
       } else {
       	 $task->description = NULL;
       }

       if($request->duration != '')
       {
         $required['duration'] = $optional['duration'];
         $task->duration = $request->duration;
       } else {
       	 $task->duration = NULL;
       }

       if($request->location != '')
       {
         $required['location'] = $optional['location'];
         $task->location = $request->location;
       } else {
       	 $task->location = NULL;
       }

       if($request->postal_code != '')
       {
         $required['postal_code'] = $optional['postal_code'];
         $task->postal_code = $request->postal_code;
       } else {
       	 $task->postal_code = NULL;
       }

       if($request->cash_value != '')
       {
         $required['cash_value'] = $optional['cash_value'];
         $task->cash_value = $request->cash_value;
       } else {
       	 $task->cash_value = NULL;
       }

       $this->validate($request, $required);

       $task->save();

       return redirect()->route('tasks.edit', $task->id);
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
