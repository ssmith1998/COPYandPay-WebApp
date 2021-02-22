<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{

    protected function register(Request $request)
    {

        $validated = $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);

        $user = new User();
        $user->password = Hash::make($request->input('password'));
        $user->email = $request->input('email');
        $user->save();

        return redirect()->route('login');
    }
}
