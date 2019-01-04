@extends('layouts.app')

@section('content')
@auth
@if(in_array(Auth::user()->role, ['PRODAJALEC','STRANKA']) )
    <div class="col-md-12">
        <h4>Naročila</h4>
        @if (count($orders) > 0)
        <div class="table-responsive">
            <table id="mytable" class="table table-bordred table-striped">
                <thead>
                    <th>Stranka</th>
                    <th>Datum</th>
                    <th>Skupna cena</th>
                    <th>Status</th>
                </thead>
                <tbody>
                @foreach($orders as $order)
                        <tr>
                            <a href="{{url('/orders/'.$order->id)}}">
                                <td>{{$order->user->name.' '.$order->user->surname}}</td>
                                <td>{{$order->created_at}}</td>
                                <td>{{$order->total_price}}</td>
                                <td>{{$order->status}}</td>
                                <td><a href="{{url('/orders/'.$order->id)}}" class="btn btn-outline-secondary">Show</a></td>
                            </a>
                        </tr>
                @endforeach
                {{$orders->links()}}
                </tbody>
            </table>
        </div>
        @else
            <p>No Orders found</p>
        @endif
    </div>
@endif
@endauth
@endsection