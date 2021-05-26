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

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Tasks $model)
    {
        $sem = Sem::where(['status' => 1])->get()->first();
        $users= User::All();
        $assigned= assigned_task::All();
        $tasks= Tasks::All();
        // $assigned_task = Tasks::findOrFail($task_id);
        // $the_tasks= $assigned_task->assigned_details;
        // dd($the_tasks);
       
        return view ('adminpages.tasks',   compact('sem', 'users', 'assigned', 'tasks'));
    }

    public function forassign()
    {
  


        $tasks= Tasks::All();;
          $sem = Sem::where(['status' => 1])->get()->first();
   
        $users= User::All();
        $assigned= assigned_task::All();
        // $assigned_task = Tasks::findOrFail($task_id);
        // $the_tasks= $assigned_task->assigned_details;
        // dd($the_tasks);

       
        return view ('adminpages.tasks_for_assignment', compact('sem', 'users', 'assigned', 'tasks'));
    }

     public function in_progress()
    {
  
        $tasks= Tasks::All();;
          $sem = Sem::where(['status' => 1])->get()->first();
   
        $users= User::All();
        $assigned= assigned_task::All();
        // $assigned_task = Tasks::findOrFail($task_id);
        // $the_tasks= $assigned_task->assigned_details;
        // dd($the_tasks);

       
        return view ('adminpages.tasks_in_progress', compact('sem', 'users', 'assigned', 'tasks'));
    }

    public function finished()
    {
  
        $tasks= Tasks::All();;
          $sem = Sem::where(['status' => 1])->get()->first();
   
        $users= User::All();
        $assigned= assigned_task::All();
        // $assigned_task = Tasks::findOrFail($task_id);
        // $the_tasks= $assigned_task->assigned_details;
        // dd($the_tasks);

       
        return view ('adminpages.tasks_finished', compact('sem', 'users', 'assigned', 'tasks'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view ('adminpages.add_task');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Tasks $model)
    {
        $users= User::All();
         $sem = Sem::where(['status' => 1])->get()->first();
        $desig = Tasks::create([
            'name' => $request->input('taskname'),
             'description' => $request->input('description'), 
             'due'=> $request->input('due'), 
             'sem_id' => $sem->id
        ]);
        $assigned= assigned_task::All();
        $successmsg= 'The Task is Successfully Added';
        // return view ('adminpages.tasks',  ['tasks' => $model->paginate(10)], compact('sem', 'assigned', 'users'))->with('successmsg', 'The Task is Successfully Added');
        return redirect('/tasks')->with(['sem'=>$sem, 'assigned'=>$assigned, 'users'=>$users])->with('success', 'The Task is Successfully Added');
        // return redirect()->back()->with(['sem'=>$sem, 'assigned'=>$assigned, 'users'=>$users, 'successmsg', 'The Task is Successfully Added']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function show(Tasks $tasks)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function edit(Tasks $tasks, Request $request, $id)
    {
        $task_id=Crypt::decrypt($id);
        $task = Tasks::findOrFail($task_id);
        return view('adminpages.edit_task',compact('task'));
    }

    public function delete_task($id){
        $task_id=Crypt::decrypt($id);
        $task = Tasks::findOrFail($task_id)->delete();

        $users= User::All();
         $sem = Sem::where(['status' => 1])->get()->first();
     
        $assigned= assigned_task::All();
     
       
        return redirect('/tasks')->with(['sem'=>$sem, 'assigned'=>$assigned, 'users'=>$users])->with('success', 'The Task is Deleted');
       
    }

    public function assign_task(Tasks $tasks, $id)
    {
        $task_id=Crypt::decrypt($id);
        $task = Tasks::findOrFail($task_id);
           $users= User::with('user')->get()->All();
           // $userprofile= User::with('user')->get()->All();
        return view('adminpages.assign_task',compact('task', 'users'));
    }

     public function assign_task_touser(Request $request, $id){
           
            $task_id=Crypt::decrypt($id);
            $assigned_task = Tasks::findOrFail($task_id);
            $the_tasks= $assigned_task->assigned_details;
         

            $employees= $request->get('employees');
            foreach ($employees as $employee) {
                $assigntask = assigned_task::create([
            'user_id' => $employee,
             'task_id' => $task_id
        ]);
            }


        $task = Tasks::findOrFail($task_id);
        $users= User::with('user')->get()->All();

        $assigned_task = Tasks::findOrFail($task_id);
        $the_tasks= $assigned_task->assigned_details;



        $task_milestones= $assigned_task->task_progress;
        // dd($the_tasks);

        // return view('adminpages.assigned_task',compact('task', 'users', 'the_tasks', 'task_milestones'));
        // return redirect('/tasks/'.$task_id.'/task_milestone')->with(['task'=>$task, 'users'=>$users, 'the_tasks'=>$the_tasks, 'task_milestones'=>$task_milestones]);
        return redirect()->route('task.task_assigned', $id);

     }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Tasks $tasks, $id)
    {
        $task_id=Crypt::decrypt($id);
        $users= User::All();
        $task = Tasks::findOrFail($task_id);
        $sem = Sem::where(['status' => 1])->get()->first();
         
        $task->name=$request->input('taskname');
        $task->description=$request->input('description');
        $task->due=$request->input('due');
        $task->update();

        $assigned= assigned_task::All();
        $successmsg= 'The Task is Successfully Added';
        
        return redirect('/tasks')->with(['sem'=>$sem, 'assigned'=>$assigned, 'users'=>$users])->with('success', 'The Task is Successfully Updated');

        // return view ('adminpages.tasks',  ['tasks' => $task->paginate(10)], compact('sem'))->with('successmsg', 'The Task is Successfully Edited');
         // return redirect()->back()->with('success', 'The Task is Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Tasks  $tasks
     * @return \Illuminate\Http\Response
     */
    public function destroy(Tasks $tasks)
    {
        //
    }

    public function task_assigned(Tasks $tasks, $id)
    {
        $task_id=Crypt::decrypt($id);
        $task = Tasks::findOrFail($task_id);
        $users= User::All();

        $assigned_task = Tasks::findOrFail($task_id);
        $the_tasks= $assigned_task->assigned_details;


        $task_milestones= $assigned_task->task_progress;
        // dd($the_tasks);

        return view('adminpages.assigned_task',compact('task', 'users', 'the_tasks', 'task_milestones'));
    }

    public function task_milestone( Request $request, $id)
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
          

            $assigned_finish= assigned_task::where(['task_id'=>$task_id])->get()->All();
            
            // $assigned_finish->finished=now();
            // $assigned_finish->update();
            foreach ($assigned_finish as $fin) {
                if(!isset($fin->accepted)){
                    $fin->accepted=now();
                 }
               $fin->finished=now();
               $fin->update();
            }
            $sem = Sem::where(['status' => 1])->get()->first();
          
            // $assigned= assigned_task::where(['user_id'=>Auth::user()->id])->get()->All();
            // $users= User::with('user')->findOrFail(Auth::user()->id);
        
            
            // return redirect('/usertask/'.$id.'/task_finished')->with(['sem'=> $sem, 'users'=>$users, 'task'=>$task, 'the_tasks'=>$the_tasks, 'task_milestones'=>$task_milestones, 'assigned'=>$assigned]);
             return redirect()->back();
          
            
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
     
           //  $task_progress= task_milestone::create([
           //      'user_id'=>$user_id,
           //      'task_id'=>$task_id,
           //      'remarks'=>$request->input('description'),
           //      'status'=>0
           //  ]);
           // return redirect()->back();
          
     
         

    }

    


}
