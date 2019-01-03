@extends('layouts.app')

@section('content')
@auth
@if(in_array(Auth::user()->role, ['PRODAJALEC','STRANKA']) )
    <div class="container mt-3">
        <h1>
            Narocila
        </h1>
    </div>
    @if (count($orders) > 0)
        @foreach($orders as $order)
            <div class="container">
                <h3 class="list-group-item">
                    <a href="{{url('/orders/'.$order->id)}}" class="text-muted">
                       Stranka: {{$order->user->name.' '.$order->user->surname}} Datum: {{$order->created_at}} Status: {{$order->status}} Skupna cena: {{$order->total_price}}
                    </a>

                </h3>
            </div>
        @endforeach
        {{$orders->links()}}
    @else
        <p>No Orders found</p>
    @endif
@endif
@endauth
@endsection