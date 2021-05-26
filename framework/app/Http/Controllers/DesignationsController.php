<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\AcadYear;
use App\Models\Sem;
use App\Models\Designations;
use App\Models\designation_records;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class DesignationsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Designations $model)
    {
        $userprofile= User::with('user')->get()->All();
        $designations= Designations::with('designee')->get()->All();
        $desig_records= designation_records::All();
        return view ('adminpages.designations', compact('designations', 'userprofile','desig_records')  );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view ('adminpages.add_designation');
    }

    public function designate_new($id)
    {
        $userprofile= User::with('user')->get()->All();
        $desig_id=Crypt::decrypt($id);
        $designations= Designations::findOrFail($desig_id);
          $desig_records= designation_records::All();

        return view ('adminpages.designate_new', compact('designations', 'userprofile', 'desig_records'));
    }


    public function designee($id)
    {
        $userprofile= User::with('user')->get()->All();
        $desig_id=Crypt::decrypt($id);
        $designations= Designations::with('designee')->findOrFail($desig_id);
        $desig_records= designation_records::All();

        return view ('adminpages.designee', compact('designations', 'userprofile', 'desig_records'));
    }

    public function remove_designee($id)
    {

        $desig_id=$id;
        $designations= designation_records::findOrFail($desig_id)->delete();
        return redirect()->back()->with('success', 'Designee has been removed');
    }

     public function designate_store($id, Request $request)
    {
        $desig_id=Crypt::decrypt($id);  
        $designations= Designations::findOrFail($desig_id);
        $designee= Designations::with('designee')->get()->All();
        $desig_records= designation_records::All();
        

        foreach ($desig_records as $record) {
            if($record->desig_id==$desig_id && !isset($record->until)){
               
                $designee_update= designation_records::findOrFail($record->id); 
                $designee_update->until= $request->input('date_desig');
                $designee_update->update();

            }

               }
       
            $desig = designation_records::create([
            'desig_id' => $desig_id,
            'user_id' => $request->input('selectedemp'),
            'date_designated' => $request->input('date_desig')
             ]);

             $userprofile= User::with('user')->get()->All();
        return redirect('/designations/'.$id)->with(['designations'=>$designations, 'userprofile'=>$userprofile])->with('success', "New Employee was designated");
    
       
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Designations $model, Request $request)
    {
         $desig = Designations::create([
            'desig_title' => $request->input('desigtitle'),
             'desig_description' => $request->input('description')
        ]);
          
        $userprofile= User::with('user')->get()->All();
        $designations= Designations::with('designee')->get()->All();
        $desig_records= designation_records::All();
   

        return view ('adminpages.designations', compact('designations', 'userprofile','desig_records') )->with('successmsg', 'The Designation is Successfully Added');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Designations  $designations
     * @return \Illuminate\Http\Response
     */
    public function show(Designations $designations)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Designations  $designations
     * @return \Illuminate\Http\Response
     */
    public function edit(Designations $designations, Request $request, $id)
    {
        
         $desig_id=Crypt::decrypt($id);
         $desig = Designations::findOrFail($desig_id);
        return view('adminpages.edit_desig',compact('desig'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Designations  $designations
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Designations $designations, $id)
    {
          $desig_id=Crypt::decrypt($id);
       
         $designation = Designations::findOrFail($desig_id);
      
         
        $designation->desig_title=$request->input('desigtitle');
        $designation->desig_description=$request->input('description');
        $designation->update();


          $userprofile= User::with('user')->get()->All();
        $designations= Designations::with('designee')->get()->All();
        $desig_records= designation_records::All();
   

        return view ('adminpages.designations', compact('designations', 'userprofile','desig_records') )->with('successmsg', 'The Designation is Successfully Updated');
    }

    public function delete($id){

        

        $desig_id=Crypt::decrypt($id);
        $designation = Designations::findOrFail($desig_id)->delete();

        $userprofile= User::with('user')->get()->All();
        $designations= Designations::with('designee')->get()->All();
        $desig_records= designation_records::All();
        return redirect ('/designations')->with(['designations'=>$designations, 'userprofile'=>$userprofile,'desig_records'=>$desig_records])->with('success', 'The Designation is Deleted');;

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Designations  $designations
     * @return \Illuminate\Http\Response
     */
    public function destroy(Designations $designations)
    {
        //
    }
}
