<?php

namespace App\Http\Controllers;

 
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Department;
use App\Models\Visitor;
use Illuminate\Support\Facades\Auth;
use Hash;
use Session;
use DataTables;

class visitorController extends Controller
{
    //

    
    public function __construct()
    {
        $this->middleware('auth');
    }

    function index()
    { 
        return view('visitor');
    }


    function fetch_all(Request $request)
    {
        if($request->ajax())
        {
            $query = Visitor::join('users', 'users.id', '=', 'visitors.visitor_enter_by');

            if(Auth::user()->type == 'User')
            {
                $query->where('visitors.visitor_enter_by', '=', Auth::user()->id);
            }

            $data = $query->get(['visitors.visitor_name', 'visitors.visitor_meet_person_name', 'visitors.visitor_department', 'visitors.visitor_enter_time', 'visitors.visitor_out_time', 'visitors.visitor_status', 'users.name', 'visitors.id']);

            return DataTables::of($data)
                ->addIndexColumn()
                ->editColumn('visitor_status', function($row){
                    if($row->visitor_status == 'In')
                    {
                        return '<span class="badge bg-success">In</span>';
                    }
                    else
                    {
                        return '<span class="badge bg-danger">Out</span>';
                    }
                })
                ->escapeColumns('visitor_status')
                ->addColumn('action', function($row){
                    if($row->visitor_status == 'In')
                    {
                        return '<a href="/visitor/edit/'.$row->id.'" class="btn btn-primary btn-sm">Edit</a>&nbsp;<button type="button" class="btn btn-danger btn-sm delete" data-id="'.$row->id.'">Delete</button>
                        ';
                    }
                    else
                    {
                        return '<a href="/visitor/view/'.$row->id.'" class="btn btn-info btn-sm">View</a>&nbsp;<button type="button" class="btn btn-danger btn-sm delete" data-id="'.$row->id.'">Delete</button>';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }


    function add()
    {  
        $data = Department::all();
        return view('add_visitor', compact('data'));

     }


    function add_validation(Request $request) 
    {
        $request->validate([
            'visitor_name'       =>  'required',
            'visitor_email'        =>  'required',
            'visitor_mobile_no'        =>  'required',
            'visitor_address'        =>  'required',
            'visitor_meet_person_name'        =>  'required',
            'visitor_department'        =>  'required',
            'visitor_reason_to_meet'        =>  'required',
            'visitor_enter_time'        =>  'required',
            // 'visitor_outing_remark'        =>  'required',
            'visitor_out_time'        =>  'required',
            'visitor_status'        =>  'required',
            'visitor_enter_by'        =>  'required',
        ]);

        $data = $request->all();
    

        Visitor::create([
            'visitor_name' => $data['visitor_name'], 
            'visitor_email' => $data['visitor_email'], 
            'visitor_mobile_no' => $data['visitor_mobile_no'], 
            'visitor_address' => $data['visitor_address'], 
            'visitor_meet_person_name' => $data['visitor_meet_person_name'], 
            'visitor_department' => $data['visitor_department'],  // Corrected field assignment
            'visitor_reason_to_meet' => $data['visitor_reason_to_meet'], 
            'visitor_enter_time' => $data['visitor_enter_time'], 
            'visitor_outing_remark' => "-", 
            'visitor_out_time' => $data['visitor_out_time'], 
            'visitor_status' => $data['visitor_status'], 
            'visitor_enter_by' => $data['visitor_enter_by'] 
        ]);
        

        return redirect('visitor')->with('success', 'New visitor Added');
    }



    function delete($id)
    {
        $data = Visitor::findOrFail($id);

        $data->delete();

        return redirect('visitor')->with('success', 'Visitor Data Removed');
    }



  


    public function edit($id)
    {
        $data = Visitor::findOrFail($id);

        return view('edit_visitor', compact('data'));
    }



    
    function edit_validation(Request $request)
    {
        

        $data = $request->all();

        $form_data = array(
            'visitor_name' => $data['visitor_name'], 
            'visitor_email' => $data['visitor_email'], 
            'visitor_mobile_no' => $data['visitor_mobile_no'], 
            'visitor_address' => $data['visitor_address'], 
            'visitor_meet_person_name' => $data['visitor_meet_person_name'], 
            'visitor_department' => $data['visitor_department'],  // Corrected field assignment
            'visitor_reason_to_meet' => $data['visitor_reason_to_meet'], 
            'visitor_enter_time' => $data['visitor_enter_time'], 
            'visitor_outing_remark' => "-", 
            'visitor_out_time' => $data['visitor_out_time'], 
            'visitor_status' => $data['visitor_status'], 
            'visitor_enter_by' => $data['visitor_enter_by'] 
        );

        Visitor::whereId($data['row_id'])->update($form_data);

        return redirect('visitor')->with('success', 'Visitor Data Updated');

    }





}
