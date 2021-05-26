<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\user_educbg;
use App\Models\user_workexp;
use App\Models\user_ldi;
use App\Models\eligibility;
use App\Models\UserProfile;
use App\Models\Employees;
use App\Models\department;
use App\Models\Designations;
use App\Models\designation_records;
use App\Models\department_records;
use App\Models\positions;
use App\Models\position_type;
use App\Models\UserSelfService;
use App\Models\service_record;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userprofile= User::with('user')->get()->All();
        $department= department::All();
        $dept_records= department_records::All();
        $designations= Designations::All();
        $desig_records = designation_records::All();
        
        return view('adminpages.employees',compact('userprofile', 'department', 'dept_records', 'designations', 'desig_records'));
    }

   

    public function view_profile($id)
    {
        $user_id= Crypt::decrypt($id);
        $userprofile= User::with('user')->findorfail($user_id);
        $educbg= user_educbg::where('user_id', $user_id)->get()->All();
        $workexp= user_workexp::where('user_id', $user_id)->get()->All();
        $eligibilities= eligibility::where('user_id', $user_id)->get()->All();
        $trainings= user_ldi::where('user_id', $user_id)->get()->All();
        $service_record= service_record::where('user_id', $user_id)->get()->sortByDesc('started')->All();
        $positions= positions::All();
        $position_type= position_type::All();
        return view('adminpages.employee_profile', compact('userprofile', 'educbg', 'workexp', 'trainings', 'eligibilities', 'service_record', 'positions', 'position_type'));
    }

    public function print_profile($id)
    {
        $user_id= Crypt::decrypt($id);
        $userprofile= User::with('user')->findorfail($user_id);
        $educbg= user_educbg::where('user_id', $user_id)->get()->All();
        $workexp= user_workexp::where('user_id', $user_id)->get()->All();
        $eligibilities= eligibility::where('user_id', $user_id)->get()->All();
        $trainings= user_ldi::where('user_id', $user_id)->get()->All();
        $service_record= service_record::where('user_id', $user_id)->get()->sortByDesc('started')->All();
        $positions= positions::All();
        $position_type= position_type::All();
        return view('adminpages.profile_print', compact('userprofile', 'educbg', 'workexp', 'trainings', 'eligibilities', 'service_record', 'positions', 'position_type'));
    }

     public function print_list()
    {

        $userprofile= User::with('user')->get()->All();
        $department= department::All();
        $dept_records= department_records::All();
        $designations= Designations::All();
        $desig_records = designation_records::All();
        
        return view('adminpages.print_employees',compact('userprofile', 'department', 'dept_records', 'designations', 'desig_records'));

    }

    public function add_service_record($id, Request $request){
       
        $user_id= Crypt::decrypt($id);
        $service_record= service_record::where('user_id', $user_id)->get()->All();
        foreach($service_record as $record)
        {
            if(!isset($record->end))
            {
                $record->end= now();
                $record->update();
            }
            
        }
        $add= service_record::create([
            'user_id'=>$user_id,
            'pos_id'=>$request->input('position'),
            'started'=>$request->input('from')
        ]);

        return redirect()->back()->with('success', 'Successfully updated service record');

    }

    public function directory()
    {
        $userprofile= User::with('user')->get()->All();
        $department= department::All();
        $dept_records= department_records::All();
        $designations= Designations::All();
        $desig_records = designation_records::All();
        
        return view('pages.directory',compact('userprofile', 'department', 'dept_records', 'designations', 'desig_records'));

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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function show(Employees $employees)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function edit(Employees $employees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employees $employees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employees  $employees
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employees $employees)
    {
        //
    }
}
