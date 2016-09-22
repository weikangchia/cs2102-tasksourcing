<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\User;
use Auth;

class AuthController extends Controller
{
    public function getLogin()
    {
      return view('login');
    }

    public function handleLogin(Request $request)
    {
      $this->validate($request, User::$loginValidationRules);
      $data = $request->only('email', 'password');
      if(Auth::attempt($data)) {
        return redirect()->intended('home');
      }

      return back()->withInput()->withErrors(['email' => 'Username or password is invalid']);
    }

    public function logout()
    {
      Auth::logout();
      return redirect()->route('home');
    }
}
