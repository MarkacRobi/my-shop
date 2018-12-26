@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <h1 class="header">ADMIN DASHBOARD</h1>
    </div>
    <div class="row justify-content-center">
        <div class="sm col-md-4 m-0 p-0" style="height: 200px;">
            <a href="{{ route('users.index') }}">
                <button type="button" class="btn btn-outline-info w-100 h-100" >
                    <h1>
                        Urejanje podajalcev
                    </h1>
                </button>
            </a>
        </div>
        <div class="sm col-md-4 m-0 p-0" style="height: 200px;">
            <a href="{{route('users.index')}}">
                <button type="button" class="btn btn-outline-dark w-100 h-100" >
                    <h1>
                        Urejanje profila
                    </h1>
                </button>
            </a>
        </div>
    </div>
</div>
@endsection
