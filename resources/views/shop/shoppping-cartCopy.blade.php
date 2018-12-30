@extends('layouts.app')

@section('content')
    @if (Session::has('cart'))
        <div class="row">
            <div class="col-sm-6 col-md-6 mx-auto">
                <ul class="list-group">
                    @foreach ($items as $item)
                        <li class="list-group-item">
                            <strong>{{$item['item']['title']}}</strong>
                            <span class="badge-success">{{$item['price']}}</span>
                            <div class="btn-group btn-group-sm">
                                <button class="btn btn-primary xs dropdown-toggle" data-toggle="dropdown">
                                    Action <span class="caret"></span>
                                    <ul class="dropdown-menu">
                                        <li><a href="$">Reduce by 1</a></li>
                                        <li><a href="$">Reduce All</a></li>
                                    </ul>
                                </button>
                            </div>
                            <span class="badge badge-secondary float-right">{{$item['quantity']}}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6 col-md-6  mx-auto">
                <strong>Total: {{$totalPrice}}</strong>
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-sm-6 col-md-6  mx-auto">
                <button type="button" class="btn btn-success">Checkout</button>
            </div>
        </div>
    @else
        <div class="row">
            <div class="col-sm-6 col-md-6  mx-auto">
                <h2>No Items in Cart!</h2>
            </div>
        </div>
    @endif
@endsection