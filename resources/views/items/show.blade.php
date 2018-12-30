@extends('layouts.app')

@section('content')
    <a href="{{ url()->previous() }}" class="btn btn-default">Go Back</a>
    <h1>{{$item->title}}</h1>
    <img width="50%" src="{{ asset('/storage/item_images/'.$item->item_image) }}">
    <br><br>
    <div>
        <span class="font-weight-bold">Description</span>
        <p class="body">{{$item->body}}</p>
    </div>
    <hr>
    <div class="font-weight-bold">Price: {{$item->price}}</div>
    <hr>
    @auth
        @if(Auth::user()->role == 'PRODAJALEC')
            <a href="{{route('items.edit', $item->id)}}" class="btn btn-default">Edit</a>

            {!! Form::open(['action' => ['ItemsController@destroy', $item->id], 'method' => 'POST', 'class' => 'float-right',
            'onclick' => "return confirm('Are you sure you want to Remove?');"])!!}
            {{Form::hidden('_method', 'DELETE')}}
            {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
    @endauth
@endsection