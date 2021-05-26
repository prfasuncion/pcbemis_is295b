<?php

namespace App\Http\Controllers\Auth;

use Auth;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Laratrust\Traits\LaratrustUserTrait;
use App\Models\User;

class LoginController extends Controller
{
    use LaratrustUserTrait;
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    // protected $redirectTo = RouteServiceProvider::HOME;
    protected function authenticated(Request $request, $user)
    {
        if ($user->hasRole('superadministrator'))
        {
            return redirect('/admin');
        }
        elseif(isset($user->inactive)){
             return redirect()->route('logout');
        }
        elseif(!isset($user->email_verified_at))
        {
            $user= User::with('user')->findorfail($user->id);
            return redirect()->route('profile.change_pass', compact('user'));
        }
      
       
    }
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request) {
  Auth::logout();
  return redirect('/login');
}

}

