<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\UserProfile;
use App\Models\AcadYear;
use App\Models\Sem;
use App\Models\Designations;
use App\Models\designation_records;
use App\Models\UserDesignation;
use Illuminate\Http\Request;
use Auth;

class UserDesignationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $designations= Designations::with('designee')->get()->All();
        $desig_records= designation_records::where('user_id', Auth::user()->id)->get()->All();
     

        return view('pages.designation', compact('designations', 'desig_records'));
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
     * @param  \App\Models\UserDesignation  $userDesignation
     * @return \Illuminate\Http\Response
     */
    public function show(UserDesignation $userDesignation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\UserDesignation  $userDesignation
     * @return \Illuminate\Http\Response
     */
    public function edit(UserDesignation $userDesignation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\UserDesignation  $userDesignation
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, UserDesignation $userDesignation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\UserDesignation  $userDesignation
     * @return \Illuminate\Http\Response
     */
    public function destroy(UserDesignation $userDesignation)
    {
        //
    }
}
