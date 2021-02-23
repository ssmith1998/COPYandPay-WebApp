<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class RegisterController extends Controller
{

    protected function register(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        //check if user exists by email
        $foundUser =  User::where('email', $request->input('email'))->first();

        if (!$foundUser) {
            $user = new User();
            $user->password = Hash::make($request->input('password'));
            $user->email = $request->input('email');
            $user->save();

            return redirect()->route('login')->with('success', 'registered succesfully please login.');
        } else {
            return Redirect::back()->withErrors('There is already a user registered with that email address');
        }
    }
}
