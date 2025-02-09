<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use DataTables;

class receptionistController extends Controller
{
    //
    public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        return view('receptionist');
    }

    function fetch_all(Request $request)
    { 
        if($request->ajax())
        {
            $data = User::where('type', '=', 'User')->get();

            return DataTables::of($data)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        return '<a href="/receptionist/edit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>&nbsp;<button type="button" class="btn btn-danger btn-sm delete" data-id="'.$row->id.'">Delete</button>';
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
    }



  public function add()
    {
        return view('add_receptionist');
    }

    
    function add_validation(Request $request)
    {
        $request->validate([
            'name'          =>  'required',
            'email'         =>  'required|email|unique:users',
            'password'      =>  'required|min:6'
        ]);

        $data = $request->all();

        User::create([
            'name'      =>  $data['name'],
            'email'     =>  $data['email'],
            'password'  =>  Hash::make($data['password']),
            'type'      =>  'User'
        ]);

        return redirect('receptionist')->with('success', 'New Receptionist Added');
    }


    public function edit($id)
    {
        $data = User::findOrFail($id); 
        return view('edit_receptionist', compact('data'));
    }



    function edit_validation(Request $request)
    {
        $request->validate([
            'email'     =>  'required|email',
            'name'      =>  'required'   
        ]);

        $data = $request->all();

        if(!empty($data['password']))
        {
            $form_data = array(
                'name'  => $data['name'],
                'email'  => $data['email'],
                'password' => Hash::make($data['password'])
            );
        }
        else
        {
            $form_data = array(
                'name'      =>  $data['name'],
                'email'     =>  $data['email']
            );
        }

        User::whereId($data['hidden_id'])->update($form_data);

        return redirect('receptionist')->with('success', 'Receptionist Data Updated');

    }



    function delete($id)
    {
        $data = User::findOrFail($id);

        $data->delete();

        return redirect('receptionist')->with('success', 'Receptionist Data Removed');
    }
}

 