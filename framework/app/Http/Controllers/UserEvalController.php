<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\Sem;
use App\Models\AcadYear;
use App\Models\EvalDetails;
use App\Models\eval_category;
use App\Models\evaluations_set;
use App\Models\evalresults;
use App\Models\Evaluations;
use App\Models\User;
use App\Models\positions;
use App\Models\employee_categ;
use App\Models\service_record;
use App\Models\UserProfile;
use App\Models\department;
use App\Models\department_records;
use App\Models\Designations;
use App\Models\designation_records;
use App\Models\UserEval;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UserEvalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sem = Sem::All();

        $categ= eval_category::All();
        $acadyear= AcadYear::with('ay_details')->get()->All();
        $evaldetails= EvalDetails::All();
        $evaluations = Evaluations::All();
        $eval_sets=evaluations_set::All(); 
        $departments= department::All();
        $users= User::with('user')->get()->All();
        $dept_records= department_records::All();
        $designations= Designations::All();
        $eval_results= evalresults::All();
        $desig_records= designation_records::where('user_id', Auth::user()->id)->get()->All();
        $user_id=  Auth::user()->id;

        // dd($desig_records);
    
        return view ('pages.evaluation', compact('categ', 'sem', 'acadyear', 'evaldetails', 'evaluations', 'eval_sets', 'departments', 'users', 'dept_records', 'designations', 'desig_records', 'eval_results', 'user_id'));
    }

    public function evaluations($id, $dept_id)
    {
       $eval_id= Crypt::decrypt($id);
        $depmt_id=Crypt::decrypt($dept_id);
        $sem = Sem::All();
        $categ= eval_category::All();
        $acadyear= AcadYear::All();
        $evaldetails= EvalDetails::All();
        $eval_sets= evaluations_set::where('eval_id', $eval_id)->get()->All(); 
        $evaluation = Evaluations::findorfail($eval_id);
        $departments= department::findorfail($depmt_id);
        $users= User::with('user')->get()->All();
        $employees_in_dept= department_records::where('dept_id', $depmt_id)->get()->All();
        $dept_records= department_records::All();
        $designations= Designations::with('designee')->where('dept_id_head', $depmt_id)->get()->first();
        $desig_records= designation_records::where('desig_id', $designations->id)->get()->All();
        $eval_results= evalresults::All();

        return view('pages.department_evaluation',compact('categ', 'sem', 'acadyear', 'evaldetails', 'eval_id', 'eval_sets', 'evaluation', 'departments', 'users', 'employees_in_dept', 'dept_records', 'designations', 'desig_records', 'eval_results'));
        
    }

    public function evaluate_employee($id, $emp_id)
    {
        $emp_id= Crypt::decrypt($emp_id);
        $eval_id= Crypt::decrypt($id);
        $sem = Sem::All();
        $categ= eval_category::All();
        $acadyear= AcadYear::All();
        $evaldetails= EvalDetails::All();
        $eval_sets= evaluations_set::where('eval_id', $eval_id)->get()->All(); 
        $eval_results= evalresults::All();
        $evaluation = Evaluations::findorfail($eval_id);
        $employee= User::with('user')->findorfail($emp_id);
        $service_records= service_record::where(['user_id'=>$emp_id, 'end'=>null])->get()->first();
        $positions= positions::All();
        $category= employee_categ::All();

        return view ('pages.evaluate_employee', compact('categ', 'sem', 'acadyear', 'evaldetails', 'eval_id', 'eval_sets', 'evaluation', 'employee', 'eval_results', 'service_records' ,'positions', 'category'));
    }

    public function save_evaluation(Request $request, $id, $emp_id)
    {
        $emp_id= Crypt::decrypt($emp_id);
        $eval_id= Crypt::decrypt($id);
        $evaldetails= EvalDetails::All();
        $eval_sets= evaluations_set::where('eval_id', $eval_id)->get()->All(); 


        $options_teach=$request->input('teach-kpi-');
        $options_pab=$request->input('pab-kpi-');
        $options_other=$request->input('other-kpi-');

        foreach ($eval_sets as $eval_set) {
            // dd(array_keys($request->input('teach-kpi-')));
            // dd($eval_set->id);
            if($options_teach){
            foreach (array_keys($options_teach) as $radio_teach) 
            {
                if($eval_set->kpi_id==$radio_teach)
                {
                    $res= evalresults::create([
                        'eval_set_id'=> $eval_set->id,
                        'user_id'=>$emp_id,
                        'score'=>$options_teach[$radio_teach],
                        'evaluator'=>Auth::user()->id
                    ]);
                }
            }
            }

            if($options_pab){
            foreach (array_keys($options_pab) as $radio_pab) 
            {
                if($eval_set->kpi_id==$radio_pab)
                {
                    $res= evalresults::create([
                        'eval_set_id'=> $eval_set->id,
                        'user_id'=>$emp_id,
                        'score'=>$options_pab[$radio_pab],
                        'evaluator'=>Auth::user()->id
                    ]);
                }
            }
            }

            if($options_other){
            foreach (array_keys($options_other) as $radio_other) 
            {
                if($eval_set->kpi_id==$radio_other)
                {
                    $res= evalresults::create([
                        'eval_set_id'=> $eval_set->id,
                        'user_id'=>$emp_id,
                        'score'=>$options_other[$radio_other],
                        'evaluator'=>Auth::user()->id
                    ]);
                }
            }}





        }

        $dept_records= department_records::where('user_id', $emp_id)->get()->first();
        // dd($dept_records->dept_id);
        $department= department::findorfail($dept_records->dept_id);
   
        return redirect('/evaluation/'.Crypt::encrypt($eval_id).'/'.Crypt::encrypt($department->id))->with('success', "Successfuly evaluated!");

    }

    public function evaluation_result($id, $emp_id)
    {
        $emp_id= Crypt::decrypt($emp_id);
        $eval_id= Crypt::decrypt($id);
        $sem = Sem::All();
        $categ= eval_category::All();
        $acadyear= AcadYear::All();
        $evaldetails= EvalDetails::All();
        $eval_sets= evaluations_set::where('eval_id', $eval_id)->get()->All(); 
        $eval_results= evalresults::where('user_id', $emp_id)->get()->All();
        $evaluation = Evaluations::findorfail($eval_id);
        $employee= User::with('user')->findorfail($emp_id);
        $service_records= service_record::where(['user_id'=>$emp_id, 'end'=>null])->get()->first();
        $positions= positions::All();
        $category= employee_categ::All();
        return view('pages.evaluation_result', compact('categ', 'sem', 'acadyear', 'evaldetails', 'eval_id', 'eval_sets', 'evaluation', 'employee', 'eval_results', 'service_records', 'positions', 'category'));
    }

    public function myresult($id)
    {
        
        $emp_id= Auth::user()->id;
        $eval_id= Crypt::decrypt($id);
        $sem = Sem::All();
        $categ= eval_category::All();
        $acadyear= AcadYear::All();
        $evaldetails= EvalDetails::All();
        $eval_sets= evaluations_set::where('eval_id', $eval_id)->get()->All(); 
        $eval_results= evalresults::where('user_id', $emp_id)->get()->All();
        $evaluation = Evaluations::findorfail($eval_id);
        $employee= User::with('user')->findorfail($emp_id);
        $service_records= service_record::where(['user_id'=>$emp_id, 'end'=>null])->get()->first();
        $positions= positions::All();
        $category= employee_categ::All();

         return view('pages.myevaluation', compact('categ', 'sem', 'acadyear', 'evaldetails', 'eval_id', 'eval_sets', 'evaluation', 'employee', 'eval_results', 'service_records', 'positions', 'category'));

        // return view('pages.myevaluation');



    }

    public function printmyresult($id)
    {
        
        $emp_id= Auth::user()->id;
        $eval_id= Crypt::decrypt($id);
        $sem = Sem::All();
        $categ= eval_category::All();
        $acadyear= AcadYear::All();
        $evaldetails= EvalDetails::All();
        $eval_sets= evaluations_set::where('eval_id', $eval_id)->get()->All(); 
        $eval_results= evalresults::where('user_id', $emp_id)->get()->All();
        $evaluation = Evaluations::findorfail($eval_id);
        $employee= User::with('user')->findorfail($emp_id);
        $service_records= service_record::where(['user_id'=>$emp_id, 'end'=>null])->get()->first();
        $positions= positions::All();
        $category= employee_categ::All();

         return view('pages.print_myeval_result', compact('categ', 'sem', 'acadyear', 'evaldetails', 'eval_id', 'eval_sets', 'evaluation', 'employee', 'eval_results', 'service_records', 'positions', 'category'));

        // return view('pages.myevaluation');



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
     * @param  \App\Models\UserEval  $userEval
     * @return \Illuminate\Http\Response
     */
    public function show(UserEval $userEval)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserEval  $userEval
     * @return \Illuminate\Http\Response
     */
    public function edit(UserEval $userEval)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserEval  $userEval
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserEval $userEval)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserEval  $userEval
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserEval $userEval)
    {
        //
    }
}
