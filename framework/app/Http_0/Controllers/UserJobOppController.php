<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\JobOpp;
use App\Models\ExternalApplicants;
use App\Models\InternalApplicants;
use App\Models\UserJobOpp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UserJobOppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $job_opps = JobOpp::where(['job_category' => 'internal', 'status'=> 1])->paginate(3);
        $joboppor = JobOpp::where(['job_category' => 'internal', 'status'=> 1])->get()->All();
        $applications= InternalApplicants::where('user_id',  Auth::user()->id)->get()->All(); 
        $myjobopps= JobOpp::All();
        return view('pages.jobopp', compact('job_opps', 'applications', 'joboppor', 'myjobopps'));
    }

    public function viewjob($id){
         $job_id=Crypt::decrypt($id);
         $job_opp= JobOpp::findorfail($job_id);
        
        return view('pages.viewjob', compact('job_opp'));
    }

    public function view_application($id){

         $job_id=Crypt::decrypt($id);

         $job_opp= JobOpp::findorfail($job_id);

        $application= InternalApplicants::where(['user_id'=> Auth::user()->id, 'job_id'=> $job_id])->get()->first();
      
        return view('pages.myapplications', compact('job_opp', 'application'));
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
        $job_id=Crypt::decrypt($request->input('id'));
        $internal_app = InternalApplicants::create([
                'user_id'=> Auth::user()->id,
                'job_id' => $job_id,  
                'intent' => $request->input('intent')
            ]);

         $job_opps = JobOpp::where(['job_category' => 'internal', 'status'=> 1])->paginate(3);

         $myjobopps= JobOpp::All();

      
        $joboppor = JobOpp::where(['job_category' => 'internal', 'status'=> 1])->get()->All();
        $applications= InternalApplicants::where('user_id',  Auth::user()->id)->get()->All(); 

        return redirect('/user_jobopportunity')->with(['job_opps'=>$job_opps, 'applications' => $applications, 'joboppor' => $joboppor, 'myjobopps'=>$myjobopps])->with('success', "Your Application is successfully submitted!");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserJobOpp  $userJobOpp
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserJobOpp  $userJobOpp
     * @return \Illuminate\Http\Response
     */
    public function edit(UserJobOpp $userJobOpp)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserJobOpp  $userJobOpp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserJobOpp $userJobOpp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserJobOpp  $userJobOpp
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserJobOpp $userJobOpp)
    {
        //
    }
}
