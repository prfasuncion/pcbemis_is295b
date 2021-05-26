<?php

namespace App\Http\Controllers;

use App\Models\interview_questions;
use Illuminate\Http\Request;

class interview_questionsController extends Controller
{
    public function index()
    {
    	$questions= interview_questions::All();
    	return view('adminpages.interview_questions',compact('questions'));
    }

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

        $exit_question= interview_questions::create([
        	'question'=>$request->input('question')
        ]);

        return redirect()->back()->with('success',  'A question is added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sem  $sem
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sem  $sem
     * @return \Illuminate\Http\Response
     */
    public function edit()
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
    public function update(Request $request, $id)
    {
    	$exit= interview_questions::findorfail($id);
    	$exit->question= $request->input('question');
    	$exit->update();

        return redirect()->back()->with('success', 'The question was updated successfully');
    }

    public function delete(Request $request, $id)
    {
    	$exit= interview_questions::findorfail($id)->delete();
    	

        return redirect()->back()->with('success', 'The question was deleted.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sem  $sem
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
    }
}
