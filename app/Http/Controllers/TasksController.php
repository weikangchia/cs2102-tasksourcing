<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
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
      $task = new Task();
      $task->name = 'Wash car 2';
      $task->category = 'General';
      $task->posted_by = 'Wei Kang';
      $task->posted_by_url = '11.png';
      $task->description = 'Date: Mon 20/10/2016'
        .NEXT_LINE.'Time: 02:00 PM - 03:00'
        .NEXT_LINE.'Pays: $20.00'
        .NEXT_LINE.'Location: NUS'
        .NEXT_LINE.NEXT_LINE.'Details:'
        .NEXT_LINE.'I need help to wash my car on this Monday. My car will be parked at Kent Vale\'s carpark.';
      return view('all-task')->with('task',$task);
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
