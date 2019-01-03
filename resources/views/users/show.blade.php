@extends('layouts.app')

@section('content')
    <a href="{{ url()->previous() }}" class="btn btn-default">Go Back</a>

    <h1>Profile</h1>
    <div>
       <label class="font-weight-bold">Name:</label> {{$user->name}}
    </div>
    <div>
        <label class="font-weight-bold">Surname: </label> {{$user->surname}}
    </div>
    <div>
        <label class="font-weight-bold">Phone:</label> {{$user->phone}}
    </div>
    <div>
        <label class="font-weight-bold">Email:</label> {{$user->email}}
    </div>
    <div>
        <label class="font-weight-bold">Role:</label> {{$user->role}}
    </div>
    <hr>
    {{--ce je prijavljen, lahko vidi to--}}
    @auth
        {{--ce je trenutni prijavljen uporabnik enak tistemu ki je kreiral, lahko ureja--}}
        @if(Auth::user()->role == 'ADMIN' && $user->role == 'PRODAJALEC' || Auth::user()->id === $user->id)
            <a href="{{route('users.edit',$user->id)}}" class="btn btn-default">Edit Profile</a>
        @endif
    @endauth
@endsection