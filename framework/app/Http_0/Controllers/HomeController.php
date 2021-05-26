<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\user_educbg;
use App\Models\user_workexp;
use App\Models\user_ldi;
use App\Models\eligibility;
use App\Models\Employees;
use App\Models\department;
use App\Models\Designations;
use App\Models\designation_records;
use App\Models\department_records;
use App\Models\positions;
use App\Models\position_type;
use App\Models\UserSelfService;
use App\Models\service_record;
use App\Http\Controllers\Controller;
use App\Models\Tasks;
use App\Models\Sem;
use App\Models\assigned_task;
use App\Models\task_milestone;
use App\Models\JobOpp;
use App\Models\Evaluations;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        $this->middleware('auth');

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
         $user= User::with('user')->findorfail(Auth::user()->id);
       
        if(Auth::user()->hasRole('superadministrator'))
      {
        $userprofile= User::with('user')->get()->All();
        $department= department::All();
        $dept_records= department_records::All();
        $designations= Designations::All();
        $desig_records = designation_records::All();
        return view('admin.index');

        }
        elseif(!isset($user->email_verified_at))
        {
           
            return redirect()->route('profile.change_pass', compact('user'));
        }
        else{
            
        $user= User::with('user')->findOrFail(Auth::user()->id);
        $sem = Sem::where(['status' => 1])->get()->first();
        $task= Tasks::with(['assigned_details'=> function($query){
            $query->where('user_id', '=', Auth::user()->id);
        }])->get()->All();
   
        $assigned= assigned_task::where(['user_id'=>Auth::user()->id])->get()->All();
        $joboppor = JobOpp::where(['job_category' => 'internal', 'status'=> 1])->get()->All();
        $evaluations = Evaluations::All();
        $document_requests= UserSelfService::where('user_id', Auth::user()->id)->get()->All();
        $tasks= Tasks::with(['assigned_details'=> function($query){
            $query->where('user_id', '=', Auth::user()->id);
        }])->get()->All();
        // $task= Tasks::All();
      
       // dd($task->assigned_details);
       
        return view('dashboard', compact('user', 'sem', 'task', 'assigned', 'joboppor', 'evaluations', 'document_requests', 'tasks'));
    }
    

    }
}
