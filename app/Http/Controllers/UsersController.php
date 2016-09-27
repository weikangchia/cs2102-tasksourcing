<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;

class UsersController extends Controller
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
        return view('sign-up');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
     public function store(Request $request)
     {
       $this->validate($request, User::$createValidationRules);
       $data = $request->only('username', 'email', 'password');
       $rawPassword = $data['password'];
       $data['password'] = bcrypt($data['password']);
       $data['created_at'] = new \DateTime();
       $data['updated_at'] = new \DateTime();
       $result = User::create($data);

       if($result)
       {
         $data['password'] = $rawPassword;
         if(Auth::attempt($data)) {
           return redirect()->intended('home');
         }
       }

       return back()->withInput();
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
        $user = User::find($id);

        return view('profile')->with('user', $user);
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
         'email' => 'email|unique:users',
         'password' => 'min:7',
         'password_confirm' => 'same:password',
         'first_name' => 'min:3|max:32',
         'last_name' => 'min:3|max:32',
         'bio' => 'max:120'
       ];

       $user = User::find($id);
       $required = [];

       if(strcmp($request->email, $user->email) != 0)
       {
         $required['email'] = $optional['email'];
         $user->email = $request->email;
       }

       if($request->first_name != '')
       {
         $required['first_name'] = $optional['first_name'];
         $user->first_name = $request->first_name;
       }

       if($request->last_name != '')
       {
         $required['last_name'] = $optional['last_name'];
         $user->last_name = $request->last_name;
       }

       if($request->bio != '')
       {
         $required['bio'] = $optional['bio'];
         $user->bio = $request->bio;
       }

       if($request->password != '')
       {
         $user->dirty_password = bcrypt($request->password);
         $required['password'] = $optional['password'];
         $required['password_confirm'] = $optional['password_confirm'];
       }

       $this->validate($request, $required);

       $user->save();
       
       return redirect()->route('users.edit', $user->id);
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
