<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Employee;
use Image;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $emp = Employee::all();
        return response()->json($emp);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required','max:255'],
            'email' => ['required','email','unique:employees'],
            'phone' => ['required'],
            'address' => ['required'],
            'salary' => ['required'],
            'nid' => ['required'],
            'joining_date' => ['required'],
            'photo' => ['required'],
        ]);
        
        $emp = new Employee();
        $emp->name = $request->name;
        $emp->email = $request->email;
        $emp->phone = $request->phone;
        $emp->address = $request->address;
        $emp->salary = $request->salary;
        $emp->nid = $request->nid;
        $emp->joining_date = $request->joining_date;

        if ($request->photo) {
            $position = strpos($request->photo,';');
            $sub = substr($request->photo,0,$position);
            $ext = explode('/',$sub)[1];

            $name = time().".".$ext;
            $image = Image::make($request->photo)->resize(240,200);
            $upload_path = "backend/employee/";
            $image_url = $upload_path.$name;
            $image->save($image_url); 
            $emp->photo = $image_url;
        } 

        $emp->save();
        return 0;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emp = Employee::where('id',$id)->first();
        return response()->json($emp);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    { 
        $employee = Employee::where('id',$id)->first();
        $photo = $employee->photo;
        if ($photo) {
            unlink($photo);
            Employee::where('id',$employee->id)->delete();
        }else{
            Employee::where('id',$employee->id)->delete();
        } 
    }
}
