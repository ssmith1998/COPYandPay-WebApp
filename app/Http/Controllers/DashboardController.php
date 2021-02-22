<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Payment;

class DashboardController extends Controller
{

    public function index()
    {

        //get logged in user 
        /** @var User $loggedInUser */
        $loggedInUser = Auth::user();

        // find all payments
        // /** @var Payment[] $payments*/
        // $payments = $loggedInUser::has('payments')->get();

        // dd($payments);




        return view('dashboard', ['user' => $loggedInUser]);
    }
}
