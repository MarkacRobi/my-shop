@extends('layouts.app')

@section('content')
    <div class="card shopping-cart">
        <div class="card-header bg-dark text-light">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
            Shopping cart
            <a href="" class="btn btn-outline-info btn-sm float-right">Continue shopping</a>
            <div class="clearfix"></div>
        </div>
        @if (Session::has('cart'))
            <div class="card-body">
                @foreach ($items as $item)
                    <!-- PRODUCTS -->
                    <div class="row">
                        <div class="col-12 col-sm-12 col-md-2 text-center">
                            <img class="img-responsive" src="http://placehold.it/120x80" alt="prewiew" width="120" height="80">
                        </div>
                        <div class="col-12 text-sm-center col-sm-12 text-md-left col-md-6 pt-4">
                            <h4 class="product-name"><strong>{{$item['item']['title']}}</strong></h4>
                        </div>
                        <div class="col-12 col-sm-12 text-sm-center col-md-4 text-md-right row pt-4">
                            <div class="col-3 col-sm-3 col-md-6 text-md-right" style="padding-top: 5px">
                                <h6><strong>{{$item['price']}} <span class="text-muted">x</span></strong></h6>
                            </div>
                            <div class="col-4 col-sm-4 col-md-4">
                                <div class="quantity">
                                    <input type="button" value="+" class="plus">
                                    <input type="number" step="1" max="99" min="1" value="{{$item['quantity']}}" title="Qty" class="qty"
                                           size="4">
                                    <input type="button" value="-" class="minus">
                                </div>
                            </div>
                            <div class="col-2 col-sm-2 col-md-2 text-right">
                                <button type="button" class="btn btn-outline-danger btn-xs">
                                    <a><i class="fa fa-trash" aria-hidden="true"></i></a>
                                </button>
                            </div>
                        </div>
                    </div>
                    <hr>
                @endforeach
                <!-- END PRODUCT -->
                <div class="float-right">
                    <a href="" class="btn btn-outline-secondary float-right">
                        Update shopping cart
                    </a>
                </div>
            </div>
            <div class="card-footer">
                <div class="coupon col-md-5 col-sm-5 no-padding-left float-left">
                    <div class="row">
                        <div class="col-6">
                            <input type="text" class="form-control" placeholder="cupone code">
                        </div>
                        <div class="col-6">
                            <input type="submit" class="btn btn-default" value="Use cupone">
                        </div>
                    </div>
                </div>
                <div class="float-right" style="margin: 10px">
                    <a href="{{route('item.shoppingCart.receipt')}}" class="btn btn-success float-right">Checkout</a>
                    <div class="float-right" style="margin: 5px">
                        Total price: <b>{{$totalPrice}}€</b>
                    </div>
                </div>
            </div>
        @else
            <div class="row">
                <div class="col-sm-6 col-md-6  mx-auto">
                    <h2>No Items in Cart!</h2>
                </div>
            </div>
        @endif
    </div>
@endsection