<?php

namespace App\Http\Controllers;
use Auth;
use App\Models\UserSelfService;
use App\Models\service_record;
use App\Models\positions;
use App\Models\position_type;
use App\Models\User;
use App\Models\UserProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class UserSelfServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $service_record= service_record::where('user_id', Auth::user()->id)->get()->All();
       
        $positions= positions::All();
        $position_type= position_type::All();
        $document_requests= UserSelfService::where('user_id', Auth::user()->id)->get()->sortByDesc('created_at')->All();
        return view('pages.request', compact('service_record', 'positions', 'position_type', 'document_requests'));
    }

    public function view_requests(){

        $document_requests=UserSelfService::All();
        $userprofile= User::with('user')->get()->All();
        return view('adminpages.requests', compact('document_requests', 'userprofile'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $document= $request->input('document');
        $req= UserSelfService::create([
            'user_id'=>Auth::user()->id,
            'document'=>$document,
            'purpose'=>$request->input('purpose')
        ]);

        return redirect()->back()->with('success', 'A request for '.$document.' has been created!');
    }

    public function document_ready(Request $request, $id, $emp_id)
    {

        $doc_req_id= Crypt::decrypt($id);
        $user_id= Crypt::decrypt($emp_id);
        $remarks= $request->input('remarks');
        $req= UserSelfService::findorfail($doc_req_id);
        $req->status =1;
        $req->remarks= $remarks;
        $req->update();

        return redirect()->back()->with('success', 'Request is completed! Document is ready for release!');
    }

    public function document_release(Request $request, $id, $emp_id)
    {
     
        $doc_req_id= Crypt::decrypt($id);
        $user_id= Crypt::decrypt($emp_id);
        $req= UserSelfService::findorfail($doc_req_id);
        $req->status =2;
        $req->update();

        return redirect()->back()->with('success', 'Request is completed! Document was released!');
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
     * @param  \App\Models\UserSelfService  $userSelfService
     * @return \Illuminate\Http\Response
     */
    public function show(UserSelfService $userSelfService)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserSelfService  $userSelfService
     * @return \Illuminate\Http\Response
     */
    public function edit(UserSelfService $userSelfService)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserSelfService  $userSelfService
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserSelfService $userSelfService)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserSelfService  $userSelfService
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserSelfService $userSelfService)
    {
        //
    }
}
