<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login(Request $request)
    {
        $attributes=$request->validate([

            'email' => 'required',
            'password' => 'required'
        ]);

        if(Auth::attempt($attributes)) 
        {  
            return redirect()->route('user.dashboard');
        }

        return back()->with('error','Incorrect Credential'); 
    } 
}
