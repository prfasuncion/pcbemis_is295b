<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\department;
use App\Models\Designations;
use App\Models\designation_records;
use App\Models\department_records;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;


class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $departments= department::All();
     $dept_records= department_records::All();

     return view ('adminpages.department', compact('departments', 'dept_records'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function view($id){

        $dept_id=Crypt::decrypt($id);
        $departments= department::findorfail($dept_id);
        $users= User::with('user')->get()->All();
        $employees_in_dept= department_records::where('dept_id', $dept_id)->get()->All();
        $dept_records= department_records::All();
        $designations= Designations::where('dept_id_head', $dept_id)->get()->first();
              
        $designation_records= designation_records::where('desig_id', $designations->id)->get();

 
        return view('adminpages.dept_view', compact('departments', 'users', 'employees_in_dept', 'dept_records', 'designation_records'));
    }


    public function add_employee(Request $request, $id){


         $dept_id=Crypt::decrypt($id);
        $employees= $request->input('employees');
          foreach ($employees as $employee) {
                $department = department_records::create([
                 'dept_id'=> $dept_id,
                 'user_id'=>$employee
                  ]);
            }

        return back()->with('success', 'Employee(s) successfully added!');
      

    }

    public function remove_employee($id, $dept_id)
    {
        $emp_id=Crypt::decrypt($id);
        $dep_id=Crypt::decrypt($dept_id);
        $record= department_records::where(['user_id'=>$emp_id, 'dept_id' => $dep_id, 'until'=>null])->get()->first();
        $record->until= now();
        $record->update();

        return redirect()->back()->with('success', 'Successfully removed employee from this department.');
    }


    public function create()
    {
        return view ('adminpages.add_department');
    }

    public function delete($id)
    {
        $dept_id=Crypt::decrypt($id);
       
        $designations= Designations::where('dept_id_head', $dept_id)->get()->first()->delete();
         $department= department::findorfail($dept_id)->delete();
        return back()->with('success', 'Department has been deleted!');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $departments= department::All();
         $department= department::create([
            'code'=> $request->input('deptcode'),
            'name'=>$request->input('deptname')
     ]);
         $desig = Designations::create([
            'desig_title' => $request->input('deptcode').' Coordinator',
             'desig_description' => $request->input('deptname').' Coordinator will lead and oversee the department', 
             'dept_id_head'=> $department->id

        ]);

         return redirect ('/department')->with(['departments'=>$departments])->with('success', 'Successfully Added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function show(department $department)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function edit( $id)
    {
         
        // $department= Department::findorfail($dept_id);
        // dd($request->input('dept'));
        // $department->code= $request->input('deptcode');
        // $department->name= $request->input('deptname');
        // $department->update();

        //   return back()->with('success', 'Department has been updated!');
        $dept_id=Crypt::decrypt($id);
        $department= Department::findorfail($dept_id);
        return view('adminpages.edit_department', compact('department'));


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $dept_id=Crypt::decrypt($id);
         $department= Department::findorfail($dept_id);
    
        $department->code= $request->input('deptcode');
        $department->name= $request->input('deptname');
        $department->update();

        $departments= department::All();
     $dept_records= department_records::All();

     return redirect ('/department')->with(['departments'=>$departments, 'dept_records'=>$dept_records])->with('success', 'Department has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\department  $department
     * @return \Illuminate\Http\Response
     */
    public function destroy(department $department)
    {
        //
    }
}
