@extends('layouts.app')

@section('content')
    <h1>Create Item</h1>
    {!! Form::open(['action' => 'ItemsController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}
    <div class="form-group">
        {{Form::label('title', 'Title')}}
        {{Form::text('title', '', ['class' => 'form-control', 'placeholder' => 'Title'])}}
    </div>
    <div class="form-group">
        {{Form::label('body', 'Body')}}
        {{Form::textarea('body', '', ['class' => 'form-control', 'placeholder' => 'Body text'])}}
    </div>
    <div class="form-group">
        {{Form::label('price', 'Price')}}
        {{Form::text('price', '', ['class' => 'form-control', 'placeholder' => 'Price'])}}
    </div>
    <div class="form-group">
        {{Form::File('item_image')}}
    </div>
    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}}
    {!! Form::close() !!}
@endsection