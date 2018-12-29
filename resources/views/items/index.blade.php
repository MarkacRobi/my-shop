@extends('layouts.app')

@section('content')
    <div class="container">
        <section class="jumbotron text-center">
            <div class="container">
                <h1 class="jumbotron-heading">Album example</h1>
                <p class="lead text-muted">Something short and leading about the collection below—its contents, the creator, etc. Make it short and sweet, but not too short so folks don’t simply skip over it entirely.</p>
                <p>
                    <a href="#" class="btn btn-primary my-2">Main call to action</a>
                    <a href="#" class="btn btn-secondary my-2">Secondary action</a>
                </p>
            </div>
        </section>
        <h3 class="h3">shopping Demo-1 </h3>
        @if (count($items) > 0)
            <div class="row">
                @foreach($items as $item)
                    <div class="col-md-3 col-sm-6">
                        <div class="product-grid">
                            <div class="product-image">
                                <a href="{{url('/items/'.$item->id)}}">
                                    <img class="pic-1" src="{{ asset('/storage/item_images/'.$item->item_image) }}">
                                    <img class="pic-2" src="{{ asset('/storage/item_images/'.$item->item_image) }}">
                                </a>
                                <ul class="social">
                                    <li><a href="{{url('/items/'.$item->id)}}" data-tip="Quick View"><i class="fa fa-search"></i></a></li>
                                    <li><a href="" data-tip="Add to Cart"><i class="fa fa-shopping-cart"></i></a></li>
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
                                    {{$item->price}}
                                </div>
                                <a class="add-to-cart" href="">+ Add To Cart</a>
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