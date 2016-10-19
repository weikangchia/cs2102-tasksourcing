<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use Auth;
use App\Http\Requests;
use DB;

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
				$tasks = \DB::select(
                    "SELECT t.id AS t_id, t.name AS task_name, t.description AS task_description,
                        t.postal_code, t.start_date, t.start_time, t.cash_value, t.duration, t.location,
                        c.name AS category_name, u.id AS user_id, u.username, u.profile_photo,
                        u.reputation  FROM Task t, Category c, Users u
                        WHERE t.category = c.id
                        AND t.posted_by = u.id
                        ORDER BY t.created_at DESC"
                );
        $allCats = \DB::select("SELECT id, name FROM category");

        foreach($allCats as $cat) {
          $categories[$cat->id] = $cat->name;
        }
			}
			catch(QueryException $e) {
				return false;
			}

			$today = new \DateTime();

			$request = [];
			return view('all-task', compact('tasks', 'categories', 'request'));
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
			for ($i = 1; $i < 32; $i++) {
				$days[$i] = $i;
			}

			for ($i = 2016; $i < 2026; $i++) {
				$years[$i] = $i;
			}

			$months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');

			for ($i = 0; $i < 24; $i++) {
				$hours[$i] = sprintf('%02d', $i);
			}

			for ($i = 0; $i < 60; $i++) {
				$minutes[$i] = sprintf('%02d', $i);
			}

			$allCats = \DB::select("SELECT id, name FROM category");

			foreach($allCats as $cat) {
				$categories[$cat->id] = $cat->name;
			}

			return view('new-task', compact('days', 'months', 'years', 'hours', 'minutes', 'categories'));
		}


	/**
	* Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {

			$optional = [
				'task_description'  => 'max:255',
				'duration'		=> 'integer',
				'location'		=> 'max:120',
				'postal_code'  => 'integer',
				'cash_value'	=> 'numeric'
			];

			$required = [
				'task_name'	=> 'required|max:64',
				'start' => 'bail|date|after:now'
			];

			$task_name = $request->task_name;
			$category_id = $request->category_id;

			// Y-m-d
			$start_date = "{$request->start_year}-{$request->start_month}-{$request->start_day}";

			// H:i:s
			$start_time = "{$request->start_hour}:{$request->start_minute}:00";

			$request['start'] = "{$start_date} {$start_time}";

			if($request->task_description != '')
			{
				$required['task_description'] = $optional['task_description'];
				$task_description = $request->task_description;
			} else {
				$task_description = NULL;
			}

			if($request->duration != '')
			{
				$required['duration'] = $optional['duration'];
				$duration = $request->duration;
			} else {
				$duration = NULL;
			}

			if($request->location != '')
			{
				$required['location'] = $optional['location'];
				$location = $request->location;
			} else {
				$location = NULL;
			}

			if($request->postal_code != '')
			{
				$required['postal_code'] = $optional['postal_code'];
				$postal_code = $request->postal_code;
			} else {
				$postal_code = NULL;
			}

			if($request->cash_value != '')
			{
				$required['cash_value'] = $optional['cash_value'];
				$cash_value = $request->cash_value;
			} else {
				$cash_value = NULL;
			}
			$user = Auth::user();
			$posted_by = $user->id;

			$this->validate($request, $required);

			try {
				$query = \DB::insert("INSERT INTO task (name, postal_code, created_at, description, start_date,start_time, cash_value, duration, category, posted_by, location)
				VALUES (:name, :postal_code, :created_at, :description, :start_date, :start_time, :cash_value, :duration, :category, :posted_by, :location)",
				[
					'name' => $task_name,
					'postal_code' => $postal_code,
					'description' => $task_description,
					'start_date' => $start_date,
					'start_time' => $start_time,
					'cash_value' => $cash_value,
					'duration' => $duration,
					'category' => $category_id,
					'posted_by' => $posted_by,
					'location' => $location,
					'created_at' =>new \DateTime()

				]);
				return redirect()->route('tasks.index');
			} catch(QueryException $e) {
				return redirect()->route('tasks.index');
			}

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
    	for ($i = 1; $i < 32; $i++) {
    		$days[$i] = $i;
    	}

    	for ($i = 2016; $i < 2026; $i++) {
    		$years[$i] = $i;
    	}

    	$months = array(1 => 'January', 2 => 'February', 3 => 'March', 4 => 'April', 5 => 'May', 6 => 'June', 7 => 'July', 8 => 'August', 9 => 'September', 10 => 'October', 11 => 'November', 12 => 'December');

    	for ($i = 0; $i < 24; $i++) {
    		$hours[$i] = sprintf('%02d', $i);
    	}

    	for ($i = 0; $i < 60; $i++) {
    		$minutes[$i] = sprintf('%02d', $i);
    	}

    	$allCats = \DB::select("SELECT id, name FROM category");

    	foreach($allCats as $cat) {
    		$categories[$cat->id] = $cat->name;
    	}

    	$task = Task::find($id);

		  return view('edit-task', compact('days', 'months', 'years', 'hours', 'minutes', 'task', 'categories'));
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
       	 'task_description'  => 'max:255',
       	 'duration'		=> 'integer',
       	 'location'		=> 'max:120',
         'postal_code'  => 'integer',
         'cash_value'	=> 'numeric'
       ];

       $task = Task::find($id);

       $required = [
         'task_name'	=> 'required|max:64',
         'start' => 'bail|date|after:now'
       ];

       $task->task_name = $request->task_name;
       $task->category_id = $request->category_id;

       // Y-m-d
       $task->start_date = "{$request->start_year}-{$request->start_month}-{$request->start_day}";

       // H:i:s
       $task->start_time = "{$request->start_hour}:{$request->start_minute}:00";

       $request['start'] = "{$task->start_date} {$task->start_time}";

       if($request->task_description != '')
       {
         $required['task_description'] = $optional['task_description'];
         $task->task_description = $request->task_description;
       } else {
       	 $task->task_description = NULL;
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

       return redirect()->route('tasks.show', $task->t_id);
     }

	/**
	* Remove the specified resource from storage.
    *
    * @param  int  $id
    * @return \Illuminate\Http\Response
    */
    public function destroy($id)
    {
		try {
			\DB::select("DELETE FROM task WHERE id = :id",
				[ 'id' => $id ]);
		} catch (QueryException $e) {
			return false;
		}

		return redirect()->route('tasks.index');
	}

	public function search(Request $request) {

		$dateQuery = ' ';
		$catQuery = ' ';

		if ($request->date) {
			$date = \DateTime::createFromFormat('d F Y', $request->date);
			$dateQuery .= "AND t.start_date > '" . $date->format('Y-m-d') . "'";
		}

		if ($request->category_id) {
			$catQuery .= "AND t.category IN ("
				. implode(',', $request->category_id)
				. ")";
		}

		$query = "SELECT t.id AS t_id, t.name AS task_name, t.description AS task_description,
			t.postal_code, t.start_date, t.start_time, t.cash_value, t.duration, t.location,
			c.name AS category_name, u.id AS user_id, u.username, u.profile_photo,
			u.reputation
			FROM Task t, Category c, Users u
			WHERE t.category = c.id
			AND t.posted_by = u.id"
			. $catQuery
			. $dateQuery
			. " ORDER BY t.created_at DESC";

		$tasks = \DB::select($query);

		$allCats = \DB::select("SELECT id, name FROM category");

		foreach($allCats as $cat) {
			$categories[$cat->id] = $cat->name;
		}

		return view('all-task', compact('tasks', 'categories', 'request'));
	}
}
