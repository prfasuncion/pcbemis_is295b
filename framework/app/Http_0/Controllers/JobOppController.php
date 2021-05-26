<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\JobOpp;
use App\Models\InternalApplicants;
use App\Models\ExternalApplicants;
use File;
use Mail;
use Response;
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class JobOppController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(JobOpp $model)
    {

        $job_opps= JobOpp::All();
        $external_app= ExternalApplicants::All();
        $internal_app= InternalApplicants::All();
       return view ('adminpages.jobopp',  compact('job_opps', 'external_app', 'internal_app'));
 
    }

    public function jobs(){
        $job_opps= JobOpp::paginate(5);
        return view ('job_opportunities', compact('job_opps'));
    }

    public function jobs_view($id){
        $job_id=Crypt::decrypt($id);
        $job_opp= JobOpp::findorfail($job_id);
       return view ('job_opp_apply', compact('job_opp'));
    }

    public function publish($id){

        $job_id=Crypt::decrypt($id);
         $job_opp= JobOpp::findorfail($job_id);
         $job_opp->status = 1;
         $job_opp->update();

        $job_opps= JobOpp::All();
        $external_app= ExternalApplicants::All();
        $internal_app=InternalApplicants::All();
       return redirect ('/job_opportunity')->with(['job_opps'=>$job_opps, 'external_app'=>$external_app, 'internal_app'=>$internal_app])->with('success', 'The Job Posting is published!');

    }


    public function unpublish($id){

        $job_id=Crypt::decrypt($id);
         $job_opp= JobOpp::findorfail($job_id);
         $job_opp->status = 0;
         $job_opp->update();

          $job_opps= JobOpp::All();
        $external_app= ExternalApplicants::All();
        $internal_app= InternalApplicants::All();
       return redirect ('/job_opportunity')->with(['job_opps'=>$job_opps, 'external_app'=>$external_app, 'internal_app'=>$internal_app])->with('success_un', 'The Job Posting has been unpublished!');
    }

    public function view($id){
           $job_id=Crypt::decrypt($id);
          $job_opps= JobOpp::paginate(4);
          $job= JobOpp::findorfail($job_id);
         
          $external_applicants=ExternalApplicants::where('job_id', $job_id)->paginate(4);
        
          $internal_applicants=InternalApplicants::where('job_id', $job_id)->paginate(4);

          $users= User::with('user')->get()->All();
      
         return view ('adminpages.view_job', compact('job_opps', 'job', 'external_applicants', 'internal_applicants', 'users'));
    }

    public function print_jobopp($id)
    {
          $job_id=Crypt::decrypt($id);
          $job_opps= JobOpp::paginate(4);
          $job= JobOpp::findorfail($job_id);
         return view ('adminpages.print_job_opp', compact('job_opps', 'job'));
    }

    public function apply($id, Request $request){

        $ch_email = ExternalApplicants::all()->where('email', $request->input('email'))->first(); 
        $ch_num = ExternalApplicants::all()->where('contact', $request->input('num'))->first(); 

    if ($ch_email || $ch_num) {
        return  back()->with('failed', 'Email already exists');
    } 
    else {


            $job_id=Crypt::decrypt($id);

            $fileName = uniqid().'_resume';
            $file = $request->file('resume');
            $ext = $file->getClientOriginalExtension();
            $file->move("storage/app/public", "{$fileName}.{$ext}");
            $filepath= "storage/app/public/"."{$fileName}.{$ext}";



            $imagename = uniqid().'_image';
            $file_image = $request->file('image');
            $ext_image = $file_image->getClientOriginalExtension();
            $file_image->move("storage/app/public", "{$imagename}.{$ext_image}");
            $imageepath= "storage/app/public/"."{$imagename}.{$ext_image}";

            $external_app = ExternalApplicants::create([
                'email'=> $request->input('email'),
                'bday'=> $request->input('bday'),
                'job_id' => $job_id,
                'contact' => $request->input('num'), 
                'lname'=> $request->input('lname'), 
                'fname'=> $request->input('fname'),
                'mname'=> $request->input('mname'),
                'name_ext'=> $request->input('name_ext'),
                'brgy'=> $request->input('ap_brgy'),
                'city'=> $request->input('ap_city'),
                'province'=> $request->input('ap_province'),
                'street'=>$request->input('street'),
                'intent'=>$request->input('description'),
                'image'=> $imageepath,
                'resume'=>$filepath
          

            ]);

            $external= ExternalApplicants::where('email', $request->input('email'))->get()->first();
              Mail::send('email.application_email',   ['external'=>$external],
            function($message) use ($request){
                $message->sender('emis@pcbzambales.com');// sender
                $message->to($request->input('email'));// receiver 
                $message->subject("JOB APPLICATION"); 
            }
        );

        $job_opps= JobOpp::paginate(5);

        return redirect('/jobs')->with(['job_opps'=>$job_opps])->with('success', "Your Application is successfully submitted!");
    }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view ('adminpages.add_jobopp');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

         $job = JobOpp::create([
            'job_title' => $request->input('jobtitle'),
             'job_description' => $request->input('description'), 
             // 'job_qualifications'=> $request->input('qualifications'), 
             'job_category'=> $request->input('category'), 
             'job_salary'=> $request->input('salary')
        ]);

         // return view ('adminpages.jobopp')->with('successmsg', 'The Task is Successfully Added');
          $job_opps= JobOpp::All();
           $external_app= ExternalApplicants::All();
           $internal_app=InternalApplicants::All();
         return view ('adminpages.jobopp', compact('job_opps', 'external_app', 'internal_app'))->with('successmsg', "Job Posting is successfully created!");

    }

    public function delete($id){
  

        $job_id=Crypt::decrypt($id);
         $job_opp= JobOpp::findorfail($job_id)->delete();
             $job_opps= JobOpp::All();
        $external_app= ExternalApplicants::All();
        $internal_app=InternalApplicants::All();
       return redirect ('/job_opportunity')->with(['job_opps'=>$job_opps, 'external_app'=>$external_app, 'internal_app'=>$internal_app])->with('success', 'The Job Posting is deleted!');


    }

    public function view_internal_profile($id)
    {

        $ap_id= Crypt::decrypt($id);
        $internal_app= InternalApplicants::findorfail($ap_id);
        $user_id= $internal_app->user_id;
        $userprofile= User::with('user')->findorfail($user_id);
        $educbg= user_educbg::where('user_id', $user_id)->get()->All();
        $workexp= user_workexp::where('user_id', $user_id)->get()->All();
        $eligibilities= eligibility::where('user_id', $user_id)->get()->All();
        $trainings= user_ldi::where('user_id', $user_id)->get()->All();
        $service_record= service_record::where('user_id', $user_id)->get()->sortByDesc('started')->All();
        $positions= positions::All();
        $position_type= position_type::All();
        return view('adminpages.view_internal_app_profile', compact('userprofile', 'educbg', 'workexp', 'trainings', 'eligibilities', 'service_record', 'positions', 'position_type', 'internal_app'));
   
    }

    public function print_internal_profile($id)
    {

        $ap_id= Crypt::decrypt($id);
        $internal_app= InternalApplicants::findorfail($ap_id);
        $user_id= $internal_app->user_id;
        $userprofile= User::with('user')->findorfail($user_id);
        $educbg= user_educbg::where('user_id', $user_id)->get()->All();
        $workexp= user_workexp::where('user_id', $user_id)->get()->All();
        $eligibilities= eligibility::where('user_id', $user_id)->get()->All();
        $trainings= user_ldi::where('user_id', $user_id)->get()->All();
        $service_record= service_record::where('user_id', $user_id)->get()->sortByDesc('started')->All();
        $positions= positions::All();
        $position_type= position_type::All();
        return view('adminpages.print_internal_applicant', compact('userprofile', 'educbg', 'workexp', 'trainings', 'eligibilities', 'service_record', 'positions', 'position_type', 'internal_app'));
   
    }

       public function view_external_profile($id)
    {
        $ap_id= Crypt::decrypt($id);
        $external_app= ExternalApplicants::findorfail($ap_id);
        return view('adminpages.view_external_app_profile', compact('external_app'));

    }

    public function print_external_profile($id)
    {
        $ap_id= Crypt::decrypt($id);
        $external_app= ExternalApplicants::findorfail($ap_id);
        return view('adminpages.print_external_applicant', compact('external_app'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\JobOpp  $jobOpp
     * @return \Illuminate\Http\Response
     */
    public function show(JobOpp $jobOpp)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\JobOpp  $jobOpp
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $job_id= Crypt::decrypt($id);
        $jobopp= JobOpp::findorfail($job_id);
        return view('adminpages.edit_jobopp', compact('jobopp'));
    }

    public function save_edit(Request $request, $id)
    {
        $job_id= Crypt::decrypt($id);
        $jobopp= JobOpp::findorfail($job_id);
        $jobopp->job_category= $request->input('category');
        $jobopp->job_title=  $request->input('jobtitle');
        $jobopp->job_description= $request->input('description');
        $jobopp->job_salary= $request->input('salary');

        $jobopp->update();

        $job_opps= JobOpp::All();
        $external_app= ExternalApplicants::All();
        $internal_app= InternalApplicants::All();
       return redirect ('/job_opportunity')->with(['job_opps'=>$job_opps, 'external_app'=>$external_app, 'internal_app'=>$internal_app])->with('success', 'Job Opportunity was updated!');
    }

    public function download($id){

        $ex_ap= ExternalApplicants::findorfail($id);
        $filename= $ex_ap->resume;

        return response()->file($filename);

        $dl= substr($filename, 19);
        $ext= substr($dl, strpos($dl, '.'));
        // dd($ext);
        // $name="hehe";
        // dd(Storage::All());
    //     $file=Storage::disk('public')->get($filename);
    // dd($file);

    //     return (new Response($file, 200))
    //           ->header('Content-Type', 'pdf');
        // return response()->download(storage_path('app/public/'.$dl));
     
        // return download((asset($filename)));
        // return Storage::disk('public')->download(asset($filename));
        // return Storage::get((asset($filename)),$ex_ap->lname.'_'.$ex_ap->fname.$ext);

    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\JobOpp  $jobOpp
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, JobOpp $jobOpp)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\JobOpp  $jobOpp
     * @return \Illuminate\Http\Response
     */
    public function destroy(JobOpp $jobOpp)
    {
        //
    }
}
