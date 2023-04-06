<?php

namespace App\Http\Controllers;

use App\Models\TaskOneModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class TaskOneController extends Controller
{
    public function index()
    {
        return view('task_one/add_form');
    }
    // Add Form in session
    public function add(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' => 'required',
            'image' => 'required',
            'mobile' => 'required|regex:/^\+?(?:\d\s?){10,14}$/',
            'date' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {

            $savedata = array();
            //upload file
            $file = $request->file('image');
            date_default_timezone_set('Asia/Kolkata');
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload'), $filename);
            //end upload file
            if (!empty(Session::get('session_data'))) {
                $session = Session::get('session_data');
                foreach ($session as $value) {
                    array_push($savedata, array('name' => $value['name'], 'email' => $value['email'], 'image' => $filename, 'password' => $value['password'], 'mobile' => $value['mobile'], 'date' => $value['date'], 'role' => $value['role']));
                }
            }

            array_push($savedata, array('name' => $request->name, 'email' => $request->email, 'image' => $filename, 'password' => $request->password, 'mobile' => $request->mobile, 'date' => $request->date, 'role' => $request->role));
            $data['session_data'] = $savedata;
            Session::put($data);
            return Redirect::to('task_one')->with('success', 'Record 
                Added successfully,Scroll Down for list');
        }
    }
    // edit single data of session
    public function edit(Request $request)
    {
        $id = $request->id;
        $data['key'] = $id;
        $get_data_with_id = Session::get('session_data');
        $data['data_edit'] = $get_data_with_id[$id - 1];
        return view('task_one/edit', $data);
    }
    // final submit
    public function final_submit()
    {
        $savedata = array();
        $session = Session::get('session_data');
        foreach ($session as $value) {
            array_push($savedata, array('name' => $value['name'], 'email' => $value['email'], 'image' => 'upload/' . $value['image'], 'password' => $value['password'], 'mobile' => $value['mobile'], 'date_form' => $value['date'], 'role' => $value['role']));
            $insert_data = TaskOneModel::insert($savedata);
            if ($insert_data) {
                return Redirect::to('task_one')->with('success', 'Record 
                inserted successfully');
            } else {
                echo "Data Not Inserted";
            }
        }
    }

// update single row of session data
    public function update(Request $request)
    {
        $session = Session::get('session_data');
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|regex:/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/',
            'password' => 'required',
            'mobile' => 'required|regex:/^\+?(?:\d\s?){10,14}$/',
            'date' => 'required',
            'role' => 'required',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        } else {
            foreach ($session as $key => &$value) {
                if ($key == ($request->key - 1)) {
                    //upload file
                    if (!empty($request->file('image'))) {
                        $file = $request->file('image');
                        date_default_timezone_set('Asia/Kolkata');
                        $filename = date('YmdHi') . $file->getClientOriginalName();
                        $file->move(public_path('upload'), $filename);
                        $value['image'] = $filename;
                    }
                    //end upload file
                    $value['name'] = $request->name;
                    $value['email'] = $request->email;
                    $value['password'] = $request->password;
                    $value['mobile'] = $request->mobile;
                    $value['date'] = $request->date;
                    $value['role'] = $request->role;
                }
            }
            $data['session_data'] = $session;
            Session::put($data);
            return Redirect::to('task_one')->with('success', 'Record 
                Updated successfully');
        }
    }
// delete single  data of session 
    public function delete(Request $request)
    {
        $id = $request->id;
        $d_id = $id - 1;
        $session = Session::get('session_data');
        unset($session[$d_id]);
        $data['session_data'] = $session;
        Session::put($data);
        return Redirect::to('task_one')->with('success', 'Record 
                Deleted successfully');
    }
}
