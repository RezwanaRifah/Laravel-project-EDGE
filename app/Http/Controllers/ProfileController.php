<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;


class ProfileController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $user = Auth::user(); 
        $data = User::findOrFail($user->id);
         return view('profile', compact('data')); 
    }

    public function edit_validation(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]); 

        $data = $request->all();

        if (!empty($data['password'])) {
            $form_data = [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ];
        } else {
            $form_data = [
                'name' => $data['name'],
                'email' => $data['email'],
            ];
        }

        User::whereId(Auth::user()->id)->update($form_data);
        return redirect('profile')->with('success', "Profile Updated");
    }

}
