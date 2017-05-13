<?php

namespace App\Http\Controllers\Auth;

use Auth;
use Hash;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use App\Http\Requests\ChangePasswordRequest;

class PasswordController extends Controller
{

    /**
     * @param ChangePasswordRequest $request
     * @return mixed
     */
    public function update(ChangePasswordRequest $request)
    {
        $user = Auth::user();

        if (!Hash::check($request->input('old_password'), $user->password)) {
            return redirect()->back()->withErrors(trans('session.update_password_error'));
        }

        $user->password = Hash::make($request->input('password'));

        $user->save();

        $request->session()->flash('success', trans('session.update_password_success'));

        return back();
    }
}
