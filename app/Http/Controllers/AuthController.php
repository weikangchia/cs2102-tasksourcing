<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use Auth;

class AuthController extends Controller
{
    public function getLogin()
    {
      return view('login');
    }

    public function handleLogin(Request $request)
    {
      $data = $request->only('email', 'password');
      if(Auth::attempt($data)) {
        return redirect()->intended('home');
      }

      return back()->withInput();
    }

    public function logout()
    {
      Auth::logout();
      return redirect()->route('home');
    }
}
