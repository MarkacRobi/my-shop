@extends('layouts.app')

@section('content')
    <a href="{{ url()->previous() }}" class="btn btn-default">Go Back</a>
    <h1>{{$item->title}}</h1>
    <img width="50%" src="{{ asset('/storage/item_images/'.$item->item_image) }}">
    <br><br>
    <div>
        {{$item->body}}
    </div>
    <hr>
    <small>Price: {{$item->price}}</small>
    <hr>
    {{--ce je prijavljen, lahko vidi to--}}
    {{--@auth--}}
        {{--ce je trenutni prijavljen uporabnik enak tistemu ki je kreiral, lahko ureja--}}
        {{--@if(Auth::user()->id == $item->user_id)--}}
            {{--<a href="{{route('posts.edit', $post->id)}}" class="btn btn-default">Edit</a>--}}

            {{--{!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}--}}
            {{--{{Form::hidden('_method', 'DELETE')}}--}}
            {{--{{Form::submit('Delete', ['class' => 'btn btn-danger'])}}--}}
            {{--{!! Form::close() !!}--}}
        {{--@endif--}}
    {{--@endauth--}}
@endsection