@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <a href="{{ url()->previous() }}" class="btn btn-default">Go Back</a>
                <h1>{{$item->title}}</h1>
                <img width="100%" src="{{strpos($item->item_image, 'http') === 0 ? $item->item_image : asset('/storage/item_images/'.$item->item_image) }}">
                <br><br>
                <div class="product-grid mb-1 pb-0 border-0">
                    <ul class="rating mb-1 pb-0">
                        @for ($i = 0; $i < 5; $i++)
                            @if ($item->rating->rating > $i)
                                <li class="fa fa-star"></li>
                            @else
                                <li class="fa fa-star disable"></li>
                            @endif
                        @endfor
                    </ul>
                </div>
                <div>
                    <span class="font-weight-bold">Description</span>
                    <p class="body">{{$item->body}}</p>
                </div>
                <hr>
                <div class="font-weight-bold">Price: {{$item->price}}€</div>
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
                    @if (Auth::user()->role == 'STRANKA')
                        <form method="POST" action="{{url('items/'.$item->id.'/rating')}}" class="float-left mb-5">
                            @csrf
                            <label for="rating" class="font-weight-bold">Oceni(0-5):</label>
                            <input id="rating" type="number"  name="rating" value="0" max="5" min="0">
                            <button type="submit" class="btn btn-primary">
                                {{ __('Oceni') }}
                            </button>
                        </form>
                    @endif
                @endauth
            </div>
        </div>
    </div>
@endsection