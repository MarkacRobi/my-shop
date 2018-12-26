@extends('layouts.app')

@section('content')
@auth
@if(Auth::user()->role == 'ADMIN')
    <div class="container mt-3">
        <h1>
            Prodajalci
            {{--<a href="/users/create" class="btn btn-outline-primary float-right">Kreiraj novega</a>--}}
            <a href="{{route('users.create')}}" role="button" class="btn btn-success btn-lg">Kreiraj novega</a>
        </h1>
    </div>
    @if (count($users) > 0)
        @foreach($users as $user)
            <div class="container">
                <h3 class="list-group-item">
                    <a href="{{url('/users/'.$user->id)}}" class="{{$user->active == '0' ? 'text-danger' : 'text-success'}}">
                        {{$user->name}} {{$user->surname}} {{$user->active == '0' ? '(Deaktiviran račun)' : ''}}
                    </a>
                    {!! Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                    {{Form::hidden('_method', 'DELETE')}}
                    {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
                    {!! Form::close() !!}
                    <a href="{{route('users.edit',$user->id)}}" class="btn btn-primary float-right">Edit</a>
                    @if ($user->active === 1)
                        <form method="POST" action="{{url('/users/'.$user->id)}}" class="float-right">
                            @csrf
                            <input id="active" type="number"  name="active" value="0" hidden>
                            {{--"spoofing" spremeni POST v PUT!--}}
                            {{Form::hidden('_method', 'PUT')}}
                            <button type="submit" class="btn btn-warning">
                                {{ __('Disable') }}
                            </button>
                        </form>
                    @else
                        <form method="POST" action="{{url('/users/'.$user->id)}}" class="float-right">
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