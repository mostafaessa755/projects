<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminUserController extends Controller
{
    public function index()
    {
        return view('admin.login');
    }
    public function store(Request $request)
    {
        // dd($request->all());

        //validate
        $request->validate([
            'email'=>'required|email',
            'password'=>'required'
        ]);
        //login
        $credentials = $request->only('email','password');
        if(!Auth::guard('admin')->attempt($credentials))
        {
            return back()->withErrors([
                'message'=>'wrong data .....! please try again'
            ]);
        }
        //session
        session()->flash('msg','you have loged in :)');
        //redirect
        return redirect('/admin');
    }
}
