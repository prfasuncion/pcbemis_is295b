<?php

namespace App\Http\Controllers;

use Auth;
use App\Models\Tasks;
use App\Models\Sem;
use App\Models\User;
use App\Models\UserProfile;
use App\Models\assigned_task;
use App\Models\task_milestone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UserTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tasks $model)
    {
        $sem = Sem::where(['status' => 1])->get()->first();
        $task= Tasks::with(['assigned_details'=> function($query){
            $query->where('user_id', '=', Auth::user()->id);
        }])->get()->All();
        // $task= Tasks::All();
      
       // dd($task->assigned_details);
        $assigned= assigned_task::where(['user_id'=>Auth::user()->id])->get()->All();
        $users= User::with('user')->findOrFail(Auth::user()->id);
        // $assigned_task = Tasks::findOrFail($task_id);
        // $the_tasks= $assigned_task->assigned_details;
        // dd($the_tasks);
       // dd($users);
        return view ('pages.task',  ['tasks' => $model->paginate(10)], compact('sem','users','task', 'assigned'));
        
    }

    public function ongoing(Tasks $model){
        $sem = Sem::where(['status' => 1])->get()->first();
        $task= Tasks::with(['assigned_details'=> function($query){
            $query->where('user_id', '=', Auth::user()->id);
        }])->get()->All();
        // $task= Tasks::All();
      
       // dd($task->assigned_details);
        $assigned= assigned_task::where(['user_id'=>Auth::user()->id])->get()->All();
        $users= User::with('user')->findOrFail(Auth::user()->id);
        // $assigned_task = Tasks::findOrFail($task_id);
        // $the_tasks= $assigned_task->assigned_details;
        // dd($the_tasks);
       // dd($users);
        return view ('pages.task_ongoing',  ['tasks' => $model->paginate(10)], compact('sem','users','task', 'assigned'));

    }

    public function finished(Tasks $model){
        $sem = Sem::where(['status' => 1])->get()->first();
        $task= Tasks::with(['assigned_details'=> function($query){
            $query->where('user_id', '=', Auth::user()->id);
        }])->get()->All();
      
        $assigned= assigned_task::where(['user_id'=>Auth::user()->id])->get()->All();
        $users= User::with('user')->findOrFail(Auth::user()->id);
    
        return view ('pages.task_finished',  ['tasks' => $model->paginate(10)], compact('sem','users','task', 'assigned'));

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
     * @param  \App\Models\UserTask  $userTask
     * @return \Illuminate\Http\Response
     */
    public function show(UserTask $userTask)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserTask  $userTask
     * @return \Illuminate\Http\Response
     */
    public function edit(UserTask $userTask)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserTask  $userTask
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserTask $userTask)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserTask  $userTask
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserTask $userTask)
    {
        //
    }

    public function on_goingtask( $id)
    {
        $task_id=Crypt::decrypt($id);
        $task = Tasks::findOrFail($task_id);
        $users= User::All();
         $user_id= Auth::user()->id;
        $assigned_task = Tasks::findOrFail($task_id);
        $the_tasks= $assigned_task->assigned_details;
        $task_milestones= $assigned_task->task_progress;

        $assigned_accepted= assigned_task::where(['user_id'=>$user_id, 'task_id'=>$task_id])->get()->first();
        $assigned_accepted->accepted=now();
        $assigned_accepted->update();

        return view('pages.ongoingtask',compact('task', 'users', 'the_tasks', 'task_milestones'));
    }

    public function task_finished( $id)
    {
        $task_id=Crypt::decrypt($id);
        $task = Tasks::findOrFail($task_id);
        $users= User::All();
        $user_id= Auth::user()->id;
        $assigned_task = Tasks::findOrFail($task_id);
        $the_tasks= $assigned_task->assigned_details;
        $task_milestones= $assigned_task->task_progress;
        $assigned_accepted= assigned_task::where(['user_id'=>$user_id, 'task_id'=>$task_id])->get()->first();

        return view('pages.finishedtask',compact('task', 'users', 'the_tasks', 'task_milestones', 'assigned_accepted'));
    }

    public function task_milestone(Tasks $model, Request $request, $id)
    {

        $task_id=Crypt::decrypt($id);
        $task = Tasks::findOrFail($task_id);
        $users= User::All();
        $user_id= Auth::user()->id;

        $assigned_task = Tasks::findOrFail($task_id);
        $the_tasks= $assigned_task->assigned_details;
        $task_milestones= $assigned_task->task_progress;

        if($request->finish == "finish")
        {
            $task_milestone= task_milestone::create([
                'user_id'=>$user_id,
                'task_id'=>$task_id,
                'remarks'=>$request->input('description'),
                'status'=>1
            ]);
          

            $assigned_finish= assigned_task::where(['user_id'=>$user_id, 'task_id'=>$task_id])->get()->first();
            $assigned_finish->finished=now();
            $assigned_finish->update();
            
            $sem = Sem::where(['status' => 1])->get()->first();
            // $task= Tasks::with(['assigned_details'=> function($query){
            //     $query->where('user_id', '=', Auth::user()->id);
            // }])->get()->All();
          
            $assigned= assigned_task::where(['user_id'=>Auth::user()->id])->get()->All();
            $users= User::with('user')->findOrFail(Auth::user()->id);
        
            // return view ('pages.finishedtask',  ['tasks' => $model->paginate(10)], compact('sem','users','task', 'the_tasks', 'task_milestones','assigned'));
            return redirect('/usertask/'.$id.'/task_finished')->with(['sem'=> $sem, 'users'=>$users, 'task'=>$task, 'the_tasks'=>$the_tasks, 'task_milestones'=>$task_milestones, 'assigned'=>$assigned]);

            
        }
        else if($request->addmilestone == "milestone")
        {
            $task_progress= task_milestone::create([
                'user_id'=>$user_id,
                'task_id'=>$task_id,
                'remarks'=>$request->input('description'),
                'status'=>0
            ]);
           return redirect()->back();
          
        }
        // return redirect('userprofile/educ')->with(['user_educbg'=> $user_educbg, 'user_id'=>$user_id]);
           
           // ->with('success', 'your message,here');   

    }
}
