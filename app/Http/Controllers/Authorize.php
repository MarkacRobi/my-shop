<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;

class Authorize extends Controller
{

    use AuthenticatesUsers;
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $authorized_users = ["Ana","Pija"];

        if($_SERVER['SSL_CLIENT_VERIFY'] != 'NONE'){
            if(auth()->user()->email == $_SERVER['SSL_CLIENT_S_DN_Email']){
                return redirect()->secure('dashboard');
            }
            else {
                Auth::logout();
                return redirect('/')->with('error', 'Certifikat ne ustreza prijavnim podatkom!');
            }

        }
        else {
            Auth::logout();
            return redirect('/')->with('error', 'Ni mogoča prijava brez certifikata');
        }
    }
}
