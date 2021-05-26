<?php

namespace App\Http\Controllers;

use App\Models\AcadYear;
use App\Models\Sem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class SemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Respons
     */
    public function index(Request $request, $id)
    {
        $ay_id=Crypt::decrypt($id);
         $sem = AcadYear::findOrFail($ay_id);
         $the_sem= $sem->ay_details;
       
         return view('adminpages.sem',compact('the_sem', 'sem'));
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
     * @param  \App\Models\Sem  $sem
     * @return \Illuminate\Http\Response
     */
    public function show(Sem $sem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sem  $sem
     * @return \Illuminate\Http\Response
     */
    public function edit(Sem $sem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Sem  $sem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Sem $sem, $id)
    {
         $sem_id=Crypt::decrypt($id);
       
         $mysem = Sem::findOrFail($sem_id);
      
         $ay_id=$mysem->ay_id;
         $sem = AcadYear::findOrFail($ay_id);
         $the_sem= $sem->ay_details;

         Sem::where('status', 1)->update(['status' => 0]);
         $mysem->status=1;
         $mysem->update();
       
         return redirect()->back()->with($mysem->name . " is activated");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sem  $sem
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sem $sem)
    {
        //
    }
}
