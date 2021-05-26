<?php

namespace App\Http\Controllers;

use App\Models\positions;
use App\Models\position_type;
use App\Models\employee_categ;
use App\Models\service_record;
use Illuminate\Http\Request;

class PositionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $positions= positions::All();
        $position_type= position_type::All();
        $employee_categ= employee_categ::All();
        $service_record= service_record::All();
        return view('adminpages.positions', compact('positions','position_type', 'employee_categ', 'service_record'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function postype()
    {

        $position_type= position_type::All();
        $employee_categ= employee_categ::All();
        return view('adminpages.positions_type', compact('position_type', 'employee_categ'));
    }

    public function create()
    {
        $position_type= position_type::All();
        $employee_categ= employee_categ::All();
        return view('adminpages.add_position', compact('position_type', 'employee_categ'));
    }

    public function create_type()
    {
        return view('adminpages.add_position_type');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $positions= positions::All();
        $position_type= position_type::All();
        $employee_categ= employee_categ::All();
        $position = positions::create([
            'position' => $request->input('posname'),
             'type' => $request->input('postype'), 
             'categ_id' => $request->input('category') 
           
        ]);
        return redirect('/positions')->with(['positions'=>$positions, 'position_type'=>$position_type, 'employee_categ'=>$employee_categ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\positions  $positions
     * @return \Illuminate\Http\Response
     */
    public function show(positions $positions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\positions  $positions
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request, $id)
    {
       $positions= positions::findorfail($id);

       $positions->position= $request->input('posname');
       $positions->type= $request->input('postype');
       $positions->categ_id= $request->input('category');
       $positions->update();

       return redirect()->back()->with('success', 'Position is successfully updated.');

    }

    public function delete(Request $request, $id)
    {
        $position= positions::findorfail($id)->delete();
        return redirect()->back()->with('success', 'Position was deleted');
        

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\positions  $positions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, positions $positions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\positions  $positions
     * @return \Illuminate\Http\Response
     */
    public function destroy(positions $positions)
    {
        //
    }
}
