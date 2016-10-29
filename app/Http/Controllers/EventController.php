<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests;

class EventController extends Controller
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
				$events = \DB::select(
                    "SELECT t.id AS t_id, t.name AS task_name,
                    u.id AS posted_by_id, u.username AS posted_by_username, u.email AS posted_by_email,
                    u.profile_photo AS posted_by_photo, b.status, b.bid_amount
                    FROM Task t, Users u, Bid b
                    WHERE b.u_id = :u_id
                    AND t.posted_by = u.id
                    AND b.t_id = t.id
                    ORDER BY t.created_at DESC",
                    [
                        'u_id' => Auth::id()
                    ]
                );
        $tasks = \DB::select(
                    "SELECT t.id AS t_id, t.name AS task_name, t.description AS task_description,
                        t.postal_code, t.start_date, t.start_time, t.cash_value, t.duration, t.location,
                        c.name AS category_name, u.id AS user_id, u.username, u.profile_photo,
                        (SELECT COUNT(*) FROM bid WHERE bid.t_id = t.id) as num_bidders
                        FROM Task t, Category c, Users u
                        WHERE t.category = c.id
                        AND t.posted_by = u.id
  					            AND t.start_date > :now
                        AND t.posted_by = :u_id
                        ORDER BY t.created_at DESC",
              					[
              						'now' => new \DateTime(),
                          'u_id' => Auth::id()
              					]);
			}
			catch(QueryException $e) {
				return false;
			}

			return view('event', compact('events', 'tasks'));
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
