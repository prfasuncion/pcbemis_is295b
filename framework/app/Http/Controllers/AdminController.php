<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class AdminController extends Controller
{
	 public function __construct()
    {
         $this->middleware('auth');
        // $this->middleware('role:superadministrator');
    }
     public function index()
    {
          $user= User::with('user')->findorfail(Auth::user()->id);
       
        if(Auth::user()->hasRole('superadministrator'))
      {
        return view('admin.index');
      }
      
      return redirect('/login');
    }
    

    public function logout(Request $request) {
      Auth::logout();
      return redirect('/login');
    }
}
