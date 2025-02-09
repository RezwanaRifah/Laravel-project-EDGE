<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
   use Illuminate\Support\Facades\Auth;
   use Hash;
   use Session;

class CustomAuthController extends Controller
{
    //

    public function index()
    {
        return view('auth.login');
    }


    public function registration()
    {
        return view('auth.register');
    }

    public function custom_login(Request $request){
        $request->validate([
             'email'=>'required',
            'password'=>'required'
        ]);
        $credentials = $request->only('email','password');
        if(Auth::attempt($credentials)){
            return redirect()->intended('dashboard')->withSuccess('login'); 
        };
        return redirect('login')->with('error',"Login details are incorrect");
    }

    public function custom_registration(Request $request){
        $request->validate([
            'name'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6'
        ]);

        $data = $request->all();
        User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
            'type' => 'Admin',
        ]);
        return redirect('register')->with('success',"Registration Complete");
        }


        public function dashboard(){
            
            if(Auth::check()){
                return view('dashboard');
            }
            return redirect('login');
        }

        public function logout(){ 
           Session::flush();
           Auth::logout();
           return redirect('login');
        }



}
