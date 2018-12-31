@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card">
        <div class="card-header">
            Invoice
            <strong>{{Carbon\Carbon::today()->format('Y-m-d')}}</strong>
            {{--TODO: status--}}
            <span class="float-right"> <strong>Status:</strong> Pending</span>

        </div>
        <div class="card-body">
            <div class="row mb-4">
                <div class="col-sm-6">
                    <h6 class="mb-3">From:</h6>
                    <div>
                        <strong>my-shop</strong>
                    </div>
                    <div>Večna pot 113</div>
                    <div>1000 Ljubljana, Slovenija</div>
                    <div>Email: my-shop@gmail.com.</div>
                    <div>Phone: +01 123 4567</div>
                </div>
                @auth
                    <div class="col-sm-6">
                        <h6 class="mb-3">To:</h6>
                        <div>
                            <strong>{{$user->name}} {{$user->surname}}</strong>
                        </div>
                        {{--TODO: naslov kraj postna drzava--}}
                        <div>{{$user->adress->street}} {{$user->adress->street_number}}</div>
                        <div>{{$user->adress->post_number}} {{$user->adress->city}}, Slovenija</div>
                        <div>Email: {{$user->email}}</div>
                        <div>Phone: {{$user->phone}}</div>
                    </div>
                @endauth


            </div>

            <div class="table-responsive-sm">
                <table class="table table-striped">
                    <thead>
                    <tr>
                        <th class="center">#</th>
                        <th>Item</th>
                        <th>Description</th>

                        <th class="right">Unit Cost</th>
                        <th class="center">Qty</th>
                        <th class="right">Total</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($items as $item)
                        <tr>
                            <td class="center">{{$loop->index}}</td>
                            <td class="left strong">{{$item['item']['title']}}</td>
                            <td class="left">{{$item['item']['body']}}</td>

                            <td class="right">{{$item['item']['price']}}€</td>
                            <td class="center">{{$item['quantity']}}</td>
                            <td class="right">{{$item['price']}}€</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-5">

                </div>

                <div class="col-lg-4 col-sm-5 ml-auto">
                    <table class="table table-clear">
                        <tbody>
                        <tr>
                            <td class="left">
                                <strong>Total</strong>
                            </td>
                            <td class="right">
                                <strong>{{$totalPrice}}€</strong>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>

            </div>

        </div>
    </div>
</div>
@endsection