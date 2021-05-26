<?php

namespace App\Http\Controllers;
use App\Models\User;
use App\Http\Requests\ProfileRequest;
use App\Http\Requests\PasswordRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Auth;
class ProfileController extends Controller
{
    /**
     * Show the form for editing the profile.
     *
     * @return \Illuminate\View\View
     */
    public function edit()
    {
        $user= User::findorfail(Auth::user()->id);
        

        if(Auth::user()->hasRole('superadministrator'))
        {
            $view = 'layouts.adminapp';
    
        } 
        else {
            $view = 'layouts.app';
           
        }

        return view('profile.edit', compact('view', 'user'));
        // return view('profile.edit');
    }

    public function change_pass()
    {
        $user= User::findorfail(Auth::user()->id);
        

        if(Auth::user()->hasRole('superadministrator'))
        {
            $view = 'layouts.adminapp';
    
        } 
        else {
            $view = 'layouts.app';
           
        }

        return view('profile.change_pass', compact('view', 'user'));
        // return view('profile.edit');
    }

    /**
     * Update the profile
     *
     * @param  \App\Http\Requests\ProfileRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProfileRequest $request)
    {
        auth()->user()->update($request->all());

        return back()->withStatus(__('Profile successfully updated.'));
    }

    public function profile_picture(Request $request)
    {
        if ($request->hasFile('image')) {
            $imagename = uniqid().'_image';
            $file_image = $request->file('image');
            $ext_image = $file_image->getClientOriginalExtension();
            $file_image->move("storage/app/public", "{$imagename}.{$ext_image}");
            $imageepath= "storage/app/public/"."{$imagename}.{$ext_image}";

        $user= User::findorfail(Auth::user()->id);
        $user->image= $imageepath;
        $user->update();  
        }

        return back()->withStatusPassword(__('Image successfully updated.'));

    }

    /**
     * Change the password
     *
     * @param  \App\Http\Requests\PasswordRequest  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);

        return back()->withStatusPassword(__('Password successfully updated.'));
    }
    public function change_password(PasswordRequest $request)
    {
        auth()->user()->update(['password' => Hash::make($request->get('password'))]);
        $user= User::findorfail(Auth::user()->id);
        $user->email_verified_at= now();
        $user->update();


        return redirect('/home');
    }
}
