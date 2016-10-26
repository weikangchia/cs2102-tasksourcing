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
			}
			catch(QueryException $e) {
				return false;
			}

			return view('event')->with('events', $events);
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
