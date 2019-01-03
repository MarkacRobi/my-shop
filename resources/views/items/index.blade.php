@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">My Shop</h1>
                <p class="lead text-muted">This is best shop ever!.</p>
                @auth
                    @if (Auth::user()->role == 'PRODAJALEC')
                        <p>
                            <a href="{{url('/items/create')}}" class="btn btn-primary my-2">Create item</a>
                        </p>
                    @endif
                @endauth
            </div>
        </section>
        <h3 class="h3">Vsi artikli </h3>
        @if (count($items) > 0)
            <div class="row">
                @foreach($items as $item)
                    <div class="col-md-3 col-sm-6">
                        <div class="product-grid">
                            <div class="product-image">
                                <a href="{{url('/items/'.$item->id)}}">
                                    <img class="pic-1" src="{{strpos($item->item_image, 'http') === 0 ? $item->item_image : asset('/storage/item_images/'.$item->item_image) }}">
                                    <img class="pic-2" src="{{strpos($item->item_image, 'http') === 0 ? $item->item_image : asset('/storage/item_images/'.$item->item_image) }}">
                                </a>
                                <ul class="social">
                                    <li><a href="{{url('/items/'.$item->id)}}" data-tip="Quick View"><i class="fa fa-search"></i></a></li>
                                    @auth
                                        @if(Auth::user()->role == 'STRANKA')
                                        <li><a href="{{ route('item.addToCart', $item->id) }}" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
                                        @endif
                                    @endauth
                                </ul>
                            </div>
                            <ul class="rating mt-0 mb-2">
                                @for ($i = 0; $i < 5; $i++)
                                    @if ($item->rating > $i)
                                        <li class="fa fa-star"></li>
                                    @else
                                        <li class="fa fa-star disable"></li>
                                    @endif
                                @endfor
                            </ul>
                            <div class="product-content">
                                <h3 class="title"><a href="#">{{$item->title}}</a></h3>
                                <div class="price">
                                    {{$item->price}}€
                                </div>
                                @auth
                                    @if(Auth::user()->role == 'STRANKA')
                                    <a class="add-to-cart" href="{{ route('item.addToCart', $item->id) }}">+ Add To Cart</a>
                                    @endif
                                @endauth
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <p>No items found</p>
        @endif
    </div>
    <hr>


@endsection