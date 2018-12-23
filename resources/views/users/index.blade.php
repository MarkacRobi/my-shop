@extends('layouts.app')

@section('content')
@auth
@if(Auth::user()->role == 'ADMIN')
    <div class="container mt-3">
        <h1>
            Prodajalci
            {{--<a href="/users/create" class="btn btn-outline-primary float-right">Kreiraj novega</a>--}}
            <a href="/users/create" role="button" class="btn btn-success btn-lg">Kreiraj novega</a>
        </h1>
    </div>
    @if (count($users) > 0)
        @foreach($users as $user)
            <div class="container">
                <h3 class="{{$user->active == '0' ? 'list-group-item text-light bg-gradient-danger' : 'list-group-item bg-gradient-success'}}">
                    <a href="/users/{{$user->id}}" class="text-white">{{$user->name}} {{$user->surname}}</a>
                    {!! Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {!! Form::close() !!}
                    <a href="/users/{{$user->id}}/edit" class="btn btn-primary float-right">Edit</a>
                    @if ($user->active === 1)
                        <form method="POST" action="/users/{{$user->id}}" class="float-right">
                            @csrf
                            <input id="active" type="number"  name="active" value="0" hidden>
                            {{--"spoofing" spremeni POST v PUT!--}}
                            {{Form::hidden('_method', 'PUT')}}
                            <button type="submit" class="btn btn-warning">
                                {{ __('Disable') }}
                            </button>
                        </form>
                    @else
                        <form method="POST" action="/users/{{$user->id}}" class="float-right">
                            @csrf
                            <input id="active" type="number"  name="active" value="1" hidden>
                            {{--"spoofing" spremeni POST v PUT!--}}
                            {{Form::hidden('_method', 'PUT')}}
                            <button type="submit" class="btn btn-success">
                                {{ __('Activate') }}
                            </button>
                        </form>
                    @endif
                </h3>
                {{--ce je prijavljen, lahko vidi to--}}
                    {{--ce je trenutni prijavljen uporabnik enak tistemu ki je kreiral, lahko ureja--}}
                {{--<small>Written on {{$user->created_at}} by {{$user->user->name}}</small>--}}
            </div>
        @endforeach
        {{$users->links()}}
    @else
        <p>No Users found</p>
    @endif
@endif
@endauth
@endsection