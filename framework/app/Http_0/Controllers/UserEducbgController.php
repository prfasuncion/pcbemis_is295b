<?php

namespace App\Http\Controllers;

use App\Models\user_educbg;
use Illuminate\Http\Request;

class UserEducbgController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     
     $ed= user_educbg::create([
            'level' => $request->input('level'),
             
        ]);
    
       return response()->json(
            [
                'success' => true,
                'message' => 'Data inserted successfully'
            ]);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\user_educbg  $user_educbg
     * @return \Illuminate\Http\Response
     */
    public function show(user_educbg $user_educbg)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\user_educbg  $user_educbg
     * @return \Illuminate\Http\Response
     */
    public function edit(user_educbg $user_educbg)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\user_educbg  $user_educbg
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, user_educbg $user_educbg)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\user_educbg  $user_educbg
     * @return \Illuminate\Http\Response
     */
    public function destroy(user_educbg $user_educbg)
    {
        //
    }
 
   
}
