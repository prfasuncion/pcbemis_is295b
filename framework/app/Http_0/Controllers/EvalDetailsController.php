<?php

namespace App\Http\Controllers;

use App\Models\eval_category;
use App\Models\Evaluations;
use App\Models\EvalDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EvalDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categ= eval_category::All();
        $eval_details= EvalDetails::All();
        
         return view ('adminpages.evalkpi', compact('categ', 'eval_details'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function delete($id)
    {
        $detail_id= Crypt::decrypt($id);
        $details = EvalDetails::findorfail($detail_id)->delete();

         $categ= eval_category::All();
        $eval_details= EvalDetails::All();
        
         return redirect ('/evaluation_kpi')->with(['categ'=>$categ, 'eval_details'=>$eval_details])->with('success', 'KPI has been deleted!');

    }

    public function edit_kpi( $id){
        $detail_id= Crypt::decrypt($id);
        $details = EvalDetails::findorfail($detail_id);

        $categ= eval_category::All();
        return view('adminpages.edit_evalkpi', compact('details', 'categ'));
    }

    public function edit_save(Request $request, $id){
        $detail_id= Crypt::decrypt($id);
        $detail = EvalDetails::findorfail($detail_id);

        $detail->eval_categ_id= $request->input('categ');
        $detail->kpi= $request->input('kpi');

        $detail->update();

        $categ= eval_category::All();
        $eval_details= EvalDetails::All();
        
         return redirect ('/evaluation_kpi')->with(['categ'=>$categ, 'eval_details'=>$eval_details])->with('success', 'KPI has been updated!');


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


        $job = EvalDetails::create([
            'eval_categ_id' => $request->input('categ'),
             'kpi' => $request->input('kpi')
             
        ]);

        return redirect()->back();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EvalDetails  $evalDetails
     * @return \Illuminate\Http\Response
     */
    public function show(EvalDetails $evalDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EvalDetails  $evalDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(EvalDetails $evalDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EvalDetails  $evalDetails
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, EvalDetails $evalDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EvalDetails  $evalDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(EvalDetails $evalDetails)
    {
        //
    }
}
