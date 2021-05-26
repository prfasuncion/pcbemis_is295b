<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Auth;
use App\Models\user_educbg;
use App\Models\user_workexp;
use App\Models\user_ldi;
use App\Models\eligibility;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UserProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userprofile= User::with('user')->findOrFail(Auth::user()->id);
       
        return view ('pages.userprofile', compact('userprofile'));
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
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function show(UserProfile $userProfile)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function edit(UserProfile $userProfile)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $profile= UserProfile::where('user_id', Auth::user()->id)->get()->first();
        $profile->lname= $request->input('surname');
        $profile->fname= $request->input('fname');
        $profile->mname= $request->input('mname');
        $profile->name_ext= $request->input('name_ext');
        $profile->date_of_birth= $request->input('date_of_birth');
        $profile->place_of_birth= $request->input('place_of_birth');
        $profile->sex= $request->input('sex');
        $profile->name_ext= $request->input('name_ext');
        $profile->civil_status= $request->input('civil_status');
        $profile->height= $request->input('height');
        $profile->weight= $request->input('weight');
        $profile->blood_type= $request->input('blood_type');
        $profile->citizenship= $request->input('citizenship');
        $profile->gsis= $request->input('gsis');
        $profile->pagibig= $request->input('pagibig');
        $profile->philhealth= $request->input('philhealth');
        $profile->sss= $request->input('sss');
        $profile->tin= $request->input('tin');
        $profile->tin= $request->input('tel_no');
        $profile->mobile= $request->input('mobile');
        $profile->res_house_no= $request->input('res_house_no');
        $profile->res_street= $request->input('res_street');
        $profile->res_village= $request->input('res_village');
        $profile->res_province= $request->input('r_prov');
        $profile->res_municipality= $request->input('r_city');
        $profile->res_brgy= $request->input('r_brgy');
        $profile->res_zipcode= $request->input('res_zipcode');

        $profile->perm_house_no= $request->input('perm_house_no');
        $profile->perm_street= $request->input('perm_street');
        $profile->perm_village= $request->input('perm_village');
        $profile->perm_province= $request->input('p_prov');
        $profile->perm_municipality= $request->input('p_city');
        $profile->perm_brgy= $request->input('p_brgy');
        $profile->perm_zipcode= $request->input('perm_zipcode');

        $profile->update();

        return redirect()->back()->with('success', 'Profile has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserProfile  $userProfile
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserProfile $userProfile)
    {
        //
    }
    public function educbg(user_educbg $model)
    {
        $user_id= Auth::user()->id;
        $user_educbg= user_educbg::where(['user_id' => $user_id ])->get()->sortByDesc('ed_from')->All();
        return view ('pages.educbg', compact('user_educbg', 'user_id'));
    }
    public function eligibility(){
        $user_id= Auth::user()->id;
        $user_eligibility= eligibility::where(['user_id' => $user_id ])->get()->sortByDesc('date_exam')->All();
        return view ('pages.eligibility', compact('user_eligibility', 'user_id'));
    }


     public function workexp(user_workexp $model)
    {
        $user_id= Auth::user()->id;
        $user_workexp= user_workexp::where(['user_id' => $user_id ])->get()->sortByDesc('from')->All();
        return view ('pages.workexp', compact('user_workexp', 'user_id'));
    }
     public function awards()
    {
  
        return view ('pages.educbg');
    }
      public function ldi()
    {
        $user_id= Auth::user()->id;
        $user_ldi= user_ldi::where(['user_id' => $user_id ])->get()->sortByDesc('from')->All();
        return view ('pages.ldi', compact('user_ldi', 'user_id'));
        
    }
      public function educstore(Request $request)
    {   
        $level= $request->input('level');
        $school=$request->input('schoolname');
        $degree=$request->input('degree');
        $from=$request->input('from');
        $to=$request->input('to');
        $unitsearned=$request->input('unitsearned');
        $year_grad= $request->input('yeargraduated');
        $awards=$request->input('awards');
        $user_id=Auth::user()->id;

        $useredbg = user_educbg::create([
        'user_id'=>$user_id,
        'level'=>$level,
        'school'=>$school,
        'degree'=>$degree,
        'ed_from'=>$from,
        'ed_to'=>$to,
        'units_earned'=>$unitsearned,
        'year_graduated'=>$year_grad,
        'award'=>$awards
    
        ]);

       
        $user_educbg= user_educbg::where(['user_id' => $user_id ])->get()->sortByDesc('ed_from')->All();
        return view ('pages.educbg', compact('user_educbg', 'user_id'));
    }

     public function eligibility_store(Request $request)
    {   
        $eligibility= $request->input('eligibility');
        $rating=$request->input('rating');
        $date_exam=$request->input('date_exam');
        $place=$request->input('place');
        $license_number=$request->input('license');
        $validity=$request->input('date_valid');
       
        $user_id=Auth::user()->id;

        $user_eligibility = eligibility::create([
        'user_id'=>$user_id,
        'eligibility'=>$eligibility,
        'rating'=>$rating,
        'date_exam'=>$date_exam,
        'place'=>$place,
        'license'=>$license_number,
        'validity'=>$validity
    
        ]);

       
        $user_eligibility= eligibility::where(['user_id' => $user_id ])->get()->sortByDesc('date_exam')->All();
        return view ('pages.eligibility', compact('user_eligibility', 'user_id'));
    }

    public function educ_update(Request $request, $id){

        $user_id=Crypt::decrypt($id);
    
        $educbg = user_educbg::findOrFail($user_id);

        $educbg->level= $request->input('level');
        $educbg->school=$request->input('schoolname');
        $educbg->degree=$request->input('degree');
        $educbg->ed_from=$request->input('from');
        $educbg->ed_to=$request->input('to');
        $educbg->units_earned=$request->input('unitsearned');
        $educbg->year_graduated= $request->input('yeargraduated');
        $educbg->award=$request->input('awards');
        // $educbg->user_id=Auth::user()->id;

        $educbg->update();
         $user_educbg= user_educbg::where(['user_id' => $user_id ])->get()->sortByDesc('ed_from')->All();
        // return view('pages.educbg', compact('user_educbg', 'user_id'));

         return redirect('userprofile/educ')->with(['user_educbg'=> $user_educbg, 'user_id'=>$user_id]);

    }

    public function eligibility_update(Request $request, $id){

        $user_id=Crypt::decrypt($id);
    
        $eligibility = eligibility::findOrFail($user_id);

        $eligibility->eligibility= $request->input('eligibility');
        $eligibility->rating=$request->input('rating');
        $eligibility->date_exam=$request->input('date_exam');
        $eligibility->place=$request->input('place');
        $eligibility->license=$request->input('license');
        $eligibility->validity=$request->input('date_valid');
       
        // $educbg->user_id=Auth::user()->id;

        $eligibility->update();
         $user_eligibility= eligibility::where(['user_id' => $user_id ])->get()->sortByDesc('date_exam')->All();
        // return view('pages.educbg', compact('user_educbg', 'user_id'));

         return redirect('userprofile/eligibility')->with(['user_eligibility'=> $user_eligibility, 'user_id'=>$user_id]);

    }

    public function educ_delete($id){
        $user_id=Crypt::decrypt($id);
        $user_educbg= user_educbg::where(['user_id' => $user_id ])->get()->sortByDesc('ed_from')->All();
       $educbg = user_educbg::findOrFail($user_id)->delete();
          return redirect('userprofile/educ')->with(['user_educbg'=> $user_educbg, 'user_id'=>$user_id]);
    }

    public function eligibility_delete($id){
        $user_id=Crypt::decrypt($id);
        $user_eligibility= eligibility::where(['user_id' => $user_id ])->get()->sortByDesc('date_exam')->All();
       $eligibility = eligibility::findOrFail($user_id)->delete();
          return redirect('userprofile/eligibility')->with(['user_eligibility'=> $user_eligibility, 'user_id'=>$user_id]);
    }



    public function workexp_store(Request $request){
        

        $position= $request->input('position');
        $from=$request->input('workfrom');
        $to=$request->input('workto');
        $company=$request->input('company');
        $salary=$request->input('salary');
        $sgrade=$request->input('sgrade');
        $appointment= $request->input('appointment');
        $gov_service= $request->input('gov_service');
        $user_id=Auth::user()->id;

        $userworkexp = user_workexp::create([
        'user_id'=>$user_id,
        'position'=>$position,
        'from'=>$from,
        'to'=>$to,
        'company'=>$company,
        'salary'=>$salary,
        'sgrade'=>$sgrade,
        'appointment'=>$appointment,
        'gov_service'=>$gov_service,
    
        ]);

        $user_workexp= user_workexp::where(['user_id' => $user_id ])->get()->sortByDesc('from')->All();
        return view ('pages.workexp', compact('user_workexp', 'user_id'));


    }
    public function workexp_update(Request $request, $id){
         $user_id=Crypt::decrypt($id);
    
        $workexp = user_workexp::findOrFail($user_id);

        $workexp->position= $request->input('position');
        $workexp->from=$request->input('workfrom');
        $workexp->to=$request->input('workto');
        $workexp->company=$request->input('company');
        $workexp->salary=$request->input('salary');
        $workexp->sgrade=$request->input('sgrade');
        $workexp->appointment= $request->input('appointment');
        $workexp->gov_service= $request->input('gov_service');
        // $workexp->user_id=Auth::user()->id;

        $workexp->update();
         $user_workexp= user_workexp::where(['user_id' => $user_id ])->get()->sortByDesc('from')->All();
      
         return redirect('userprofile/work_experience')->with(['user_workexp'=> $user_workexp, 'user_id'=>$user_id]);

    }

    public function workexp_delete($id){
        $user_id=Crypt::decrypt($id);
        $user_workexp= user_workexp::where(['user_id' => $user_id ])->get()->sortByDesc('from')->All();
       $workexp = user_workexp::findOrFail($user_id)->delete();
          return redirect('userprofile/work_experience')->with(['user_workexp'=> $user_workexp, 'user_id'=>$user_id]);
    }

    public function ldi_store(Request $request){

        $training= $request->input('training');
        $from=$request->input('from');
        $to=$request->input('to');
        $hours=$request->input('hours');
        $type=$request->input('type');
        $conducted=$request->input('conducted');
        $user_id=Auth::user()->id;

        $userldi = user_ldi::create([
        'user_id'=>$user_id,
        'training'=>$training,
        'from'=>$from,
        'to'=>$to,
        'hours'=>$hours,
        'type'=>$type,
        'conducted'=>$conducted
        ]);

        $user_ldi= user_ldi::where(['user_id' => $user_id ])->get()->sortByDesc('from')->All();
        return view ('pages.ldi', compact('user_ldi', 'user_id'));
        }

    public function ldi_update(Request $request, $id){

        $user_id=Crypt::decrypt($id);
    
        $ldi = user_ldi::findOrFail($user_id);

        $ldi->training= $request->input('training');
        $ldi->from=$request->input('from');
        $ldi->to=$request->input('to');
        $ldi->hours=$request->input('hours');
        $ldi->type=$request->input('type');
        $ldi->conducted=$request->input('conducted');
       
        // $workexp->user_id=Auth::user()->id;

        $ldi->update();
         $user_ldi= user_ldi::where(['user_id' => $user_id ])->get()->sortByDesc('from')->All();
      
         return redirect('userprofile/ldi')->with(['user_ldi'=> $user_ldi, 'user_id'=>$user_id]);

    }

     public function ldi_delete($id){
        $user_id=Crypt::decrypt($id);
        $user_ldi= user_ldi::where(['user_id' => $user_id ])->get()->sortByDesc('from')->All();
       $ldi = user_ldi::findOrFail($user_id)->delete();
          return redirect('userprofile/ldi')->with(['user_ldi'=> $user_ldi, 'user_id'=>$user_id]);
    }

}
