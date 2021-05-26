<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\exit_answers;
use App\Models\interview_questions;
use App\Models\UserExitApplication;
use App\Models\Tasks;
use App\Models\assigned_task;
use App\Models\Sem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UserExitApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $exit_app= UserExitApplication::where('user_id', Auth::user()->id)->get()->All();
        $user_id= Auth::user()->id;
        // $tasks= Tasks::where('user_id', $user_id)->get()->All();
        $tasks= assigned_task::where(['user_id'=> $user_id, 'finished' => null])->get()->All(); 
   
        return view('pages.user_exitapplication', compact('exit_app','user_id', 'tasks'));
    }

    public function my_application($id)
    {
        $exit_id= Crypt::decrypt($id);
        $exit_app=UserExitApplication::findorfail($exit_id);
        return view ('pages.my_application', compact('exit_app'));
    }

    public function view_exit_app()
    {
        $exit_applicants= UserExitApplication::All();
        $userprofile= User::with('user')->get()->All();
        $exit_answers= exit_answers::get()->All();
        return view('adminpages.exit_applications', compact('exit_applicants', 'userprofile', 'exit_answers'));
    }

 

    public function cancel($id){
        $exit_application= UserExitApplication::findorfail($id);
        $exit_application->status= 2;
        $exit_application->update();

        return redirect()->back()->with('success', 'Exit Application has been cancelled');
    }

    public function exit_application($id)
    {
        $exitapp_id= Crypt::decrypt($id);
        $exit_applicant= UserExitApplication::findorfail($exitapp_id);
        $user= User::with('user')->findorfail($exit_applicant->user_id);
        $tasks= assigned_task::where(['user_id'=>$exit_applicant->user_id, 'finished'=>null])->get()->All();
        // dd($tasks);
        return view('adminpages.view_exit_app', compact('exit_applicant', 'exit_applicant', 'user', 'tasks'));
    }

    public function print_exit_application($id)
    {
        $exitapp_id= Crypt::decrypt($id);
        $exit_applicant= UserExitApplication::findorfail($exitapp_id);
        $user= User::with('user')->findorfail($exit_applicant->user_id);
        $tasks= assigned_task::where(['user_id'=>$exit_applicant->user_id, 'finished'=>null])->get()->All();
        // dd($tasks);
        return view('adminpages.print_exit_app', compact('exit_applicant', 'exit_applicant', 'user', 'tasks'));
    }


    public function exit_interview()
    {
        $questions= interview_questions::All();
        return view('pages.exit_interview', compact('questions'));
    }

    public function view_exit_interview($id)
    {
        $user_id= Crypt::decrypt($id);
        $exit_answers= exit_answers::where('user_id', $user_id)->get()->All();
        $questions= interview_questions::All();
        $user= User::with('user')->findorfail($user_id);
        return view('adminpages.view_exit_interview', compact('exit_answers', 'questions', 'user') );
    }

   

    public function print_exit_interview($id)
    {
        $user_id= Crypt::decrypt($id);
        $exit_answers= exit_answers::where('user_id', $user_id)->get()->All();
        $questions= interview_questions::All();
        $user= User::with('user')->findorfail($user_id);
        return view('adminpages.print_exit_interview', compact('exit_answers', 'questions', 'user') );
    }

    public function exit_save(Request $request)
    {
        $questions= interview_questions::All();
        $answers= $request->input('answer');

        foreach ($questions as $question) {
             foreach (array_keys($answers) as $ans) 
            {
                if($question->id==$ans)
                {
                   
                    $exit_answers=exit_answers::create([
                        'user_id'=>Auth::user()->id,
                        'question_id'=>$ans,
                        'answer'=>$answers[$ans]
                    ]);
                }
            }
        }

        $user= User::findorfail(Auth::user()->id);
        $user->inactive= now();
        $user->update();

        return redirect()->route('logout');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.exit_apply');
    }

    public function approve($id)
    {
       $exit= UserExitApplication::findorfail($id);
       $exit->Approved= now();
       $exit->update();

       return redirect('/exit_applications')->with('success', 'Exit Application is Approved');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        $exit= UserExitApplication::create([
            'user_id'=>Auth::user()->id,
            'letter'=>$request->input('letter')
        ]);

        return redirect('/user_exitapplication')->with('success', 'Exit Application has been submitted');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\UserExitApplication  $userExitApplication
     * @return \Illuminate\Http\Response
     */
    public function show(UserExitApplication $userExitApplication)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserExitApplication  $userExitApplication
     * @return \Illuminate\Http\Response
     */
    public function edit(UserExitApplication $userExitApplication)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserExitApplication  $userExitApplication
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserExitApplication $userExitApplication)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserExitApplication  $userExitApplication
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserExitApplication $userExitApplication)
    {
        //
    }
}
