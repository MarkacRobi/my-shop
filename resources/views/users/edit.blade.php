@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Edit profile') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{url('/users/'.$user->id)}}">
                            @csrf

                            <div class="form-group row">
                                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

                                <div class="col-md-6">
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $user->name}}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="surname" class="col-md-4 col-form-label text-md-right">{{ __('Surname') }}</label>

                                <div class="col-md-6">
                                    <input id="surname" type="text" class="form-control{{ $errors->has('surname') ? ' is-invalid' : '' }}" name="surname" value="{{ $user->surname}}" required autofocus>

                                    @if ($errors->has('surname'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('surname') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone') }}</label>

                                <div class="col-md-6">
                                    <input id="phone" type="number" class="form-control" name="phone" value="{{ $user->phone }}" autofocus>

                                    @if ($errors->has('phone'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('phone') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $user->email }}" required>

                                    @if ($errors->has('email'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('New password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password">

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm new Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" >
                                </div>
                            </div>
                            @auth
                                @if(Auth::user()->role == 'STRANKA')
                                    {{--Naslov obvezen za stranko--}}
                                    <div id="adress">
                                        <div class="form-group row" id="City">
                                            <label for="city" class="col-md-4 col-form-label text-md-right">{{ __('City') }}</label>

                                            <div class="col-md-6">
                                                <input id="city" type="text" class="form-control{{ $errors->has('city') ? ' is-invalid' : '' }}" name="city" value="{{ $user->adress->city }}" required autofocus>

                                                @if ($errors->has('city'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('city') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row" id="Post number">
                                            <label for="post_number" class="col-md-4 col-form-label text-md-right">{{ __('Post number') }}</label>

                                            <div class="col-md-6">
                                                <input id="post_number" type="number" class="form-control{{ $errors->has('post_number') ? ' is-invalid' : '' }}" name="post_number" value="{{ $user->adress->post_number }}" required autofocus>

                                                @if ($errors->has('post_number'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('post_number') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row" id="Street">
                                            <label for="street" class="col-md-4 col-form-label text-md-right">{{ __('Street') }}</label>

                                            <div class="col-md-6">
                                                <input id="street" type="text" class="form-control{{ $errors->has('street') ? ' is-invalid' : '' }}" name="street" value="{{ $user->adress->street }}" required autofocus>

                                                @if ($errors->has('street'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('street') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="form-group row" id="Street number">
                                            <label for="street_number" class="col-md-4 col-form-label text-md-right">{{ __('Street number') }}</label>

                                            <div class="col-md-6">
                                                <input id="street_number" type="number" class="form-control{{ $errors->has('street_number') ? ' is-invalid' : '' }}" name="street_number" value="{{ $user->adress->street_number }}" required autofocus>

                                                @if ($errors->has('street_number'))
                                                    <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $errors->first('street_number') }}</strong>
                                                </span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endauth
                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    {{--"spoofing" spremeni POST v PUT!--}}
                                    {{Form::hidden('_method', 'PUT')}}
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Confirm') }}
                                    </button>
                                    <a href="{{ url()->previous() }}" class="btn btn-danger">Cancel</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center">
            <span class="h3 text-danger">Trajno izbrisanje računa! </span>
            {!! Form::open(['action' => ['UsersController@destroy', $user->id], 'method' => 'POST', 'class' => 'float-right'
            , 'onclick' => "return confirm('Are you sure you want to Remove?');"])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
        </div>
    </div>
@endsection
