<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class ChangePasswordController extends Controller
{

    /**
     * Show the password change form for new logged in admin user.
     *
     * @return \Illuminate\Http\Response
     */
    public function AfirstPassword()
    {
        return view('auth.passwords.first-change-admin');
    }

    /**
     * Show the password change form for new logged in user.
     *
     * @return \Illuminate\Http\Response
     */
    public function firstPassword()
    {
        return view('auth.passwords.first-change');
    }

    /**
     * Update password for new logged in user.
     *
     * @param \Illuminate\Http\Request $request Update password request from the web app
     *
     * @return \Illuminate\Http\Response
     */
    public function a_update_password(Request $request)
    {
        $this->validate($request, [
            'ancien_mot_de_passe' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = auth()->user();
        if (Hash::check($request->ancien_mot_de_passe, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->password_change_at = Carbon::now();
            $user->save();
        } else {
            Session::flash('warning', 'L\'ancien mot de passe ne correspond pas');
            return redirect()->route('admin.change-password');
        }

        Session::flash('success', 'Le mot de passe a été mis à jour');
        return redirect()->route('admin.dashboard');
    }

    /**
     * Update password for new logged in user.
     *
     * @param \Illuminate\Http\Request $request Update password request from the web app
     *
     * @return \Illuminate\Http\Response
     */
    public function update_password(Request $request)
    {
        $this->validate($request, [
            'ancien_mot_de_passe' => 'required',
            'password' => 'required|min:6|confirmed',
            'password_confirmation' => 'required'
        ]);

        $user = auth()->user();
        if (Hash::check($request->ancien_mot_de_passe, $user->password)) {
            $user->password = Hash::make($request->password);
            $user->password_change_at = Carbon::now();
            $user->save();
        } else {
            Session::flash('warning', 'L\'ancien mot de passe ne correspond pas');
            return redirect()->route('agent.change-password');
        }

        Session::flash('success', 'Le mot de passe a été mis à jour');
        return redirect()->route('agent.dashboard');
    }
}
