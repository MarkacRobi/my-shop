@extends('layouts.app')

@section('content')
    <a href="{{url('/posts')}}" class="btn btn-default">Go Back</a>
    <h1>{{$post->title}}</h1>
    <div>
        {{$post->body}}
    </div>
    <hr>
    <small>Written on {{$post->created_at}} by {{$post->user->name}}</small>
    <hr>
    {{--ce je prijavljen, lahko vidi to--}}
    @auth
        {{--ce je trenutni prijavljen uporabnik enak tistemu ki je kreiral, lahko ureja--}}
        @if(Auth::user()->id == $post->user_id)
            <a href="{{route('posts.edit', $post->id)}}" class="btn btn-default">Edit</a>

            {!! Form::open(['action' => ['PostsController@destroy', $post->id], 'method' => 'POST', 'class' => 'float-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Delete', ['class' => 'btn btn-danger'])}}
            {!! Form::close() !!}
        @endif
    @endauth
@endsection