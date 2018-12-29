@extends('layouts.app')

@section('content')
    <h1>Posts</h1>
    @if (count($posts) > 0)
        @foreach($posts as $post)
            <div class="container">
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-md-4 col-sm-4">
                            <img width="100%" src="{{ asset('/storage/cover_images/'.$post->cover_image) }}">
                        </div>
                    </div>
                    <div class="col-md-8 col-sm-8">
                        <a href="{{url('/posts/'.$post->id)}}">{{$post->title}}</a>
                    </div>
                </div>
                <small>Written on {{$post->created_at}} by {{$post->user !== null ? $post->user->name : '/'}}</small>
            </div>
        @endforeach
        {{$posts->links()}}
    @else
        <p>No posts found</p>
    @endif
@endsection