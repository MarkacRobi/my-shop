<?php

namespace App\Http\Controllers;

use App\Http\Middleware\admin;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use DB;

class UsersController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(){
        $users =User::where('role', 'PRODAJALEC')->orderBy('name', 'asc')->paginate(10);
        return view('users.index')->with('users', $users);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //validacija
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'role' => ['required', 'in:PRODAJALEC,STRANKA'],
        ]);
        //create User
        $user = new User;
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->role = $request->input('role');
        $user->save();

        return redirect('/users') -> with('success', 'User '.$user->name.' Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $currentUser = auth()->user();
        //preveri ce je admin, ki ureja prodajalca ali ureja svoj profil
        if(($currentUser->role == 'ADMIN' && $user->role == 'PRODAJALEC') || $currentUser->id === $user->id){
            return view('users.show')->with('user', $user);
        }
        else {
            return redirect('/')->with('error', 'Unauthorized Page');
        }

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        $currentUser = auth()->user();
        //preveri ce je admin, ki ureja prodajalca ali ureja svoj profil
        if(($currentUser->role == 'ADMIN' && $user->role == 'PRODAJALEC') || $currentUser->id === $user->id){
            return view('users.edit')->with('user', $user);
        }
        else {
            return redirect('/')->with('error', 'Unauthorized Page');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $currentUser = auth()->user();
        //preveri ce je activate/disable accounta
        if($request->has('active')) {
            //preveri ce admin spreminja prodajalca
            if($currentUser->role == 'ADMIN' && $user->role == 'PRODAJALEC') {
                //validiraj da je 0 al 1
                $this->validate($request, [
                    'active' => ['required', 'boolean'],
                ]);
                $user->active = $request->input('active');
                $user->save();
                return redirect('/users') -> with('success', 'User '.$user->name.' active updated to '.$user->active);
            }
            else {
                return redirect('/')->with('error', 'Unauthorized Page');
            }

        }

        //preveri ce je admin, ki ureja prodajalca ali ureja svoj profil
        if(!(($currentUser->role == 'ADMIN' && $user->role == 'PRODAJALEC') || $currentUser->id === $user->id)){
            return redirect('/')->with('error', 'Unauthorized Page');
        }
        //validacija
        $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'surname' => ['required', 'string', 'max:255'],
            'phone' => ['nullable', 'string'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);

        //update User
        $user->name = $request->input('name');
        $user->surname = $request->input('surname');
        $user->phone = $request->input('phone');
        $user->email = $request->input('email');
        if($request->has('password')){
            $user->password = Hash::make($request->input('password'));
        }
        $user->save();
        if($currentUser->role == 'ADMIN'){
            return redirect('/users') -> with('success', 'User '.$user->name.' Updated');
        }
        else {
            return redirect('/dashboard') -> with('success', 'User '.$user->name.' Updated');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $currentUser = auth()->user();
        //preveri za pravilnega uporabnika
        if(!(($currentUser->role == 'ADMIN' && $user->role == 'PRODAJALEC') || $currentUser->id === $user->id)){
            return redirect('/')->with('error', 'Unauthorized Page');
        }

        if($currentUser->role == 'ADMIN') {
            $user->delete();
            return redirect('/users')->with('success', 'User Removed');
        }
        else {
            auth()->logout();
            $user->delete();
            return redirect('')->with('success', 'Your account has been deleted!');
        }

    }
}
