<?php

namespace App\Http\Controllers;

use App\Models\AcadYear;
use App\Models\Sem;
use Illuminate\Http\Request;

class AcadyearController extends Controller
{
    //
        public function index(AcadYear $model)
    {
      $acadyear= AcadYear::All();
      $sem= Sem::All();
    	 return view('adminpages.acadyear', compact('sem', 'acadyear'));
    }


      public function create()
    {
    	$acadyear = AcadYear::all();
        return view ('adminpages.add_acadyear', compact('acadyear'));
    }



     public function store(AcadYear $model, Request $request)
    {
         $user = AcadYear::create([
            'start_ay' => $request->input('start_ay'),
             'end_ay' => $request->input('end_ay_text')
        ]);

          $sems= collect(["First Semester", "Second Semester", "Mid Year"]);
          $count= $sems->count();

        for ($x=0; $x<$count; $x++)
          		$sem= Sem::create([
                'name'=> $sems[$x], 
                'ay_id'=> $user->id, 
                'status'=>0
                ]);

         $sem= Sem::All();
        $acadyear= AcadYear::All();
       return view('adminpages.acadyear', compact('sem', 'acadyear'))->with('success', 'Academic Year was created successfully');
    }


}
