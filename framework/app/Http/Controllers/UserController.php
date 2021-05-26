<?php

namespace App\Http\Controllers;
use Mail;
use App\Models\User;
use App\Models\UserProfile;
use App\Http\Requests\UserRequest;
use App\Models\positions;
use App\Models\position_type;
use App\Models\service_record;
use App\Models\employee_categ;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;


class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth',  ['except' => 'logout']);
       
    }
    /**
     * Display a listing of the users
     *
     * @param  \App\Models\User  $model
     * @return \Illuminate\View\View
     */
    public function index(User $model)
    {
        $userprofile= User::with('user')->get()->All();
        
        return view('adminpages.users',compact('userprofile'), ['users' => $model->paginate(15)]);
    }

    public function create()
    {
        $positions= positions::All();
        $position_type= position_type::All();
        $employee_categ= employee_categ::All();
        return view ('adminpages.add_user',compact('positions', 'position_type', 'employee_categ'));
    }

     public function edit($id)
    {
        $userprofile= User::with('user')->findorfail($id);
        $positions= positions::All();
        $position_type= position_type::All();
        $employee_categ= employee_categ::All();
        $service_record= service_record::where(['user_id'=> $id, 'end'=>null])->get()->first();
        return view('adminpages.edit_users', compact('userprofile', 'positions', 'position_type', 'employee_categ', 'service_record'));
    }

    public function edit_save(Request $request, $id){
        $user= User::with('user')->findorfail($id);
        $userprofile= UserProfile::where('user_id', $id)->get()->first();
        $service_record= service_record::where(['user_id'=> $id, 'end'=>null])->get()->first();

        
        $user->empID= $request->input('empID');
        $user->email= $request->input('email');
        $user->update();

        $userprofile->lname= $request->input('lname');
        $userprofile->fname= $request->input('fname');
        $userprofile->mname= $request->input('mname');
        $userprofile->name_ext= $request->input('name_ext');
        $userprofile->update();

        $service_record->started= $request->input('datehired');
        $service_record->pos_id= $request->input('pos');
        $service_record->update();

        return redirect()->route('users.index')->with('success', 'User has been updted!');
        
       


    }
    public function inactivate($id)
    {
        $userprofile= User::with('user')->findorfail($id);
        $userprofile->inactive= now();
        $userprofile->update();

        return redirect()->back()->with('success', 'A user has been suspended!');

    }

    public function reactivate($id)
    {
        $userprofile= User::with('user')->findorfail($id);
        $userprofile->inactive= null;
        $userprofile->update();

        return redirect()->back()->with('success', 'A user access has been re-activated!');
    }

    public function store(Request $request, User $model)
    {
        // $fullname= $request->input('lname').' '. $request->input('fname').' '. $request->input('mname');
    $e= $request->input('empID');
    $empID= str_replace('-', '', $e); 
    $ch_email = User::all()->where('email', $request->input('email'))->first(); 
    $ch_id=User::all()->where('empID', $empID)->first(); 
    if ($ch_email || $ch_id) {
        return  back()->with('failed', 'Email or ID already exists');
    } 
    else {

    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < 10; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }

       $user = User::create([
            'empID' => $empID,
             'email' => $request->input('email'),
             'password' => Hash::make($randomString),
            // 'name' => $fullname,

            // 'password' => Hash::make('password'),
        ]);
     $user->attachRole('user');
        $userid= User::where(['email' => $request->input('email') ])->get('id');
     
     $profile= UserProfile::create([
            'user_id'=> $userid[0]['id'],
            'lname'=> $request->input('lname'),
            'fname' => $request->input('fname'),
            'mname'=> $request->input('mname'),
            'name_ext' => $request->input('next'),
     ]);

     $service_record= service_record::create([
            'user_id'=> $userid[0]['id'],
            'pos_id'=> $request->input('pos'),
            'started'=>$request->input('datehired')
     ]);
            $lname= $request->input('lname');
            $fname = $request->input('fname');
            $mname= $request->input('mname');
            $name_ext = $request->input('next');
            $emailadd=$request->input('email');
            $name= $fname.' '.$mname.' '.$lname.' '.$name_ext;
      
      
        Mail::send(
                'email.account_created',
                ['name' => $name, 'password' => $randomString],
                function($message)use ($emailadd){
                  $message->sender('emis@pcbzambales.com');// sender
                  $message->to($emailadd);// receiver 
                  $message->subject("PCB EMIS Account"); // subject ng mail
                }
              );

        $userprofile= User::with('user')->get()->All();
        
        return view('adminpages.users',compact('userprofile'), ['users' => $model->paginate(15)])->with('success', 'A user is created!');


    }

     
     
     }
}
