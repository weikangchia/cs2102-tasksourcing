<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Bid;
use App\Http\Requests;

class BidController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        try {
			$query = \DB::insert("INSERT INTO bid (created_at, bid_amount, u_id, t_id)
			VALUES (:created_at, :bid_amount, :u_id, :t_id)",
			[
				'created_at' => new \DateTime(),
                'bid_amount' => $request['bid_amount'],
                'u_id' => Auth::id(),
                't_id' => $request['t_id']

			]);
			return redirect()->route('tasks.show', $request['t_id']);
		} catch(QueryException $e) {
			return redirect()->route('tasks.show', $request['t_id']);
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
        $bid = Bid::find($id, Auth::id());
      	dd($bid);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
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
        try {
			$query = \DB::update("UPDATE bid
            SET bid_amount = :bid_amount
            WHERE id = :b_id AND u_id = :u_id AND t_id = :t_id",
			[
				'b_id' => $id,
                'bid_amount' => $request['bid_amount'],
                'u_id' => Auth::id(),
                't_id' => $request['t_id']

			]);
			return redirect()->route('tasks.show', $request['t_id']);
		} catch(QueryException $e) {
			return redirect()->route('tasks.show', $request['t_id']);
		}
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

    public function acceptBid(Request $request) {
        try {
			$query = \DB::update("UPDATE bid
            SET status = :status
            WHERE id = :b_id",
			[
				'b_id' => $request['b_id'],
                'status' => 'accepted'

			]);
			return redirect()->route('tasks.show', $request['t_id']);
		} catch(QueryException $e) {
			return redirect()->route('tasks.show', $request['t_id']);
		}
    }

    public function rejectBid(Request $request) {
        try {
			$query = \DB::update("UPDATE bid
            SET status = :status
            WHERE id = :b_id",
			[
				'b_id' => $request['b_id'],
                'status' => 'rejected'

			]);
			return redirect()->route('tasks.show', $request['t_id']);
		} catch(QueryException $e) {
			return redirect()->route('tasks.show', $request['t_id']);
		}
    }
}
