<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Blokira ce nisi prijavljen
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_id = auth()->user()->id;
        $user = User::find($user_id);
        if($user->role !== 'ADMIN'){
            return view('dashboard')->with('posts', $user->posts);
        }
        else {
            return view('dashboards.adminDashboard');
//            return redirect('/users');
        }
    }
}
