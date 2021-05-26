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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EvaluationsController extends Controller
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

      return view ('adminpages.evaluations', compact('categ', 'sem', 'acadyear', 'evaldetails', 'evaluations', 'eval_sets'));
    }




    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
     public function setevaluation($id)
    {   
        $eval_id= Crypt::decrypt($id);
        $sem = Sem::All();
        $categ= eval_category::All();
        $acadyear= AcadYear::All();
        $evaldetails= EvalDetails::All();
        return view('adminpages.set_evaluation', compact('categ', 'sem', 'acadyear', 'evaldetails', 'eval_id'));

    }

    public function resetevaluation($id)
    {   
        $eval_id= Crypt::decrypt($id);

        $eval_sets= evaluations_set::where('eval_id', $eval_id)->delete();

        $sem = Sem::All();
        $categ= eval_category::All();
        $acadyear= AcadYear::All();
        $evaldetails= EvalDetails::All();


        return view('adminpages.set_evaluation', compact('categ', 'sem', 'acadyear', 'evaldetails', 'eval_id'));

    }
    public function delete_evaluation($id){
            $eval_id= Crypt::decrypt($id);
            $evaluation= Evaluations::findorfail($eval_id)->delete();


            return redirect()->back();
    }

    public function publish_evaluation($id){
            $eval_id= Crypt::decrypt($id);
            $evaluation= Evaluations::findorfail($eval_id); 

              $evaluation->status= 1;
            $evaluation->published= now();
            $evaluation->update();

            return redirect()->back()->with('success', 'Evaluation has been published, employees may now be evaluated. ');
    }

    public function viewpublished_evaluation($id){

        $eval_id= Crypt::decrypt($id);
        $sem = Sem::All();
        $categ= eval_category::All();
        $acadyear= AcadYear::All();
        $evaldetails= EvalDetails::All();
        $eval_sets= evaluations_set::where('eval_id', $eval_id)->get()->All(); 
        $evaluation = Evaluations::findorfail($eval_id);
        $departments= department::All();
        $users= User::with('user')->get()->All();
        $employees_in_dept= department_records::All();
    
   
            return view('adminpages.view_published_evaluation', compact('categ', 'sem', 'acadyear', 'evaldetails', 'eval_id', 'eval_sets', 'evaluation', 'departments', 'users', 'employees_in_dept'));
    }

     public function admin_evaluate_employee($id, $emp_id)
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
        $service_records= service_record::where('user_id', $emp_id)->get()->all();
        $positions= positions::All();
        $category= employee_categ::All();

        return view ('adminpages.admin_evaluate_employee', compact('categ', 'sem', 'acadyear', 'evaldetails', 'eval_id', 'eval_sets', 'evaluation', 'employee', 'eval_results', 'service_records', 'positions', 'category'));
    }

    public function admin_save_evaluation(Request $request, $id, $emp_id)
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
   
        return redirect('/evaluations/'.Crypt::encrypt($eval_id).'/'.Crypt::encrypt($department->id))->with('success', "Successfuly evaluated!");

    }

    public function department_evaluation($id, $dept_id)
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

        return view('adminpages.dept_evaluation',compact('categ', 'sem', 'acadyear', 'evaldetails', 'eval_id', 'eval_sets', 'evaluation', 'departments', 'users', 'employees_in_dept', 'dept_records', 'designations', 'desig_records', 'eval_results'));
    }

    public function view_evaluation($id){
        $eval_id= Crypt::decrypt($id);
        $sem = Sem::All();
        $categ= eval_category::All();
        $acadyear= AcadYear::All();
        $evaldetails= EvalDetails::All();
        $eval_sets= evaluations_set::where('eval_id', $eval_id)->get()->All(); 
        $evaluation = Evaluations::findorfail($eval_id);

        return view ('adminpages.view_evaluation', compact('categ', 'sem', 'acadyear', 'evaldetails', 'eval_id', 'eval_sets', 'evaluation'));
    }

    public function set_store(Request $request, $id){

        $eval_id= Crypt::decrypt($id);
        $details= $request->input('eval_id');
        $check= $request->input('eval_include');

        // dd($request->input('eval_include'));
        $eval_kpis= $request->input('eval_include');
        foreach ($eval_kpis as $kpi) {
            $set= evaluations_set::create([
            'eval_id'=>$eval_id,
            'kpi_id'=>$kpi

        ]);
        }

        $sem = Sem::All();
        $categ= eval_category::All();
        $acadyear= AcadYear::All();
        $evaldetails= EvalDetails::All();
         $eval_sets=evaluations_set::All(); 
        // return view('adminpages.set_evaluation', compact('categ', 'sem', 'acadyear', 'evaldetails', 'eval_id'));
        return redirect()->route('evaluations.index', $id)->with(['categ'=>$categ, 'sem'=>$sem, 'acadyear'=>$acadyear, 'evaldetails'=>$evaldetails, 'eval_id'=>$eval_id, 'eval_sets'=>$eval_sets])->with('success', 'Evaluation KPIs has been set!');
        
    }

    public function create()
    {

        $sem = Sem::All();
        $categ= eval_category::All();
        $acadyear= AcadYear::with('ay_details')->get()->All();
        $evaldetails= EvalDetails::All();
        $evaluations = Evaluations::All();

      return view ('adminpages.create_evaluation', compact('categ', 'sem', 'acadyear', 'evaldetails', 'evaluations'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
      
        $eval= Evaluations::create([
            'sem_id'=> $request->input('sem_selected')
        ]);

        $sem = Sem::All();
        $categ= eval_category::All();
        $acadyear= AcadYear::with('ay_details')->get()->All();
        $evaldetails= EvalDetails::All();
        $evaluations = Evaluations::All();

      return redirect('/evaluations')->with(['categ'=>$categ, 'sem'=>$sem, 'acadyear'=>$acadyear, 'evaldetails'=>$evaldetails, 'evaluations'=>$evaluations ])->with('success', 'Evaluation is created!');

    }

    public function show_evaluation($id)
    {
            $eval_id= Crypt::decrypt($id);
            $evaluation= Evaluations::findorfail($eval_id); 

           
            $evaluation->released= now();
            $evaluation->update();

            return redirect()->back()->with('success', 'Evaluation results has been shown to employees.');
    }

    public function hide_evaluation($id)
    {
            $eval_id= Crypt::decrypt($id);
            $evaluation= Evaluations::findorfail($eval_id); 

           
            $evaluation->released= null;
            $evaluation->update();

            return redirect()->back()->with('success', 'Evaluation results has been shown to employees.');
    }

    public function employee_evaluation_result($id, $emp_id)
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
          $service_records= service_record::where(['user_id'=> $emp_id, 'end'=> null])->get()->first();
        // dd($service_records);
        $positions= positions::All();
        $category= employee_categ::All();

        return view('adminpages.view_employee_evaluation', compact('categ', 'sem', 'acadyear', 'evaldetails', 'eval_id', 'eval_sets', 'evaluation', 'employee', 'eval_results', 'service_records', 'positions', 'category'));
    }

    public function admin_print_result($id, $emp_id)
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
        $service_records= service_record::where(['user_id'=> $emp_id, 'end'=> null])->get()->first();
       
        $positions= positions::All();
        $category= employee_categ::All();

        return view('adminpages.print_evaluation_result', compact('categ', 'sem', 'acadyear', 'evaldetails', 'eval_id', 'eval_sets', 'evaluation', 'employee', 'eval_results', 'service_records', 'positions', 'category'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Evaluations  $evaluations
     * @return \Illuminate\Http\Response
     */
    public function show(Evaluations $evaluations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Evaluations  $evaluations
     * @return \Illuminate\Http\Response
     */
    public function edit(Evaluations $evaluations)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Evaluations  $evaluations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
      dd('sdsd');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Evaluations  $evaluations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Evaluations $evaluations)
    {
        //
    }
}
