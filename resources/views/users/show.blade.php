@extends('layouts.app')

@section('content')
    @if (Auth::user()->role == 'ADMIN')
        <a href="/users" class="btn btn-default">Go Back</a>
    @else
        <a href="/dashboard" class="btn btn-default">Go Back</a>
    @endif

    <h1>Profile</h1>
    <div>
        {{$user->name}}
    </div>
    <div>
        {{$user->surname}}
    </div>
    <div>
        {{$user->phone}}
    </div>
    <div>
        {{$user->email}}
    </div>
    <div>
        {{$user->role}}
    </div>
    <hr>
    {{--ce je prijavljen, lahko vidi to--}}
    @auth
        {{--ce je trenutni prijavljen uporabnik enak tistemu ki je kreiral, lahko ureja--}}
        @if(Auth::user()->role == 'ADMIN' && $user->role == 'PRODAJALEC' || Auth::user()->id === $user->id)
            <a href="/users/{{$user->id}}/edit" class="btn btn-default">Edit Profile</a>
        @endif
    @endauth
@endsection