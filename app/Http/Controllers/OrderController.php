<?php

namespace App\Http\Controllers;

use App\Item;
use App\Order;
use Illuminate\Http\Request;
use App\Http\Middleware\ProdajalecMiddleware;
use App\Http\Middleware\StrankaMiddleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Expr\Array_;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(auth()->user()->role == 'STRANKA'){
            $orders = Order::where('user_id', auth()->user()->id)
                ->where('status', 'POTRJENO')
                ->orwhere('status', 'ODDANO')
                ->orwhere('status', 'STORNIRANO')
                ->orderBy('created_at', 'desc')->paginate(12);
            return view('orders.index')->with('orders', $orders);
        }
        else {
            $orders = Order::where('status', 'ODDANO')->orderBy('created_at', 'desc')->paginate(12);
            return view('orders.index')->with('orders', $orders);
        }
    }

    public function indexPotrjena(){

        if(!auth()->user()->role == 'PRODAJALEC'){
            redirect('/')->with('error', 'Unauthorized Page');
        }

        $orders = Order::where('status', 'POTRJENO')->orderBy('created_at', 'desc')->paginate(12);
        return view('orders.index')->with('orders', $orders);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   //validate
        $this->validate($request, [
            'itemsArray' => ['required', 'string'],
            'quantities' => ['required', 'string'],
            'totalPrice' => ['required','numeric']
        ]);

        //Create Order
        $order = new Order;
        $order->items = $request->input('itemsArray');
        $order->quantities = $request->input('quantities');
        $order->status = 'ODDANO';
        $order->total_price = $request->input('totalPrice');
        $order->user_id = auth()->user()->id;
        $order->save();
        return redirect('/') -> with('success', 'Order Created');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order = Order::find($id);
        $itemsArray = explode(',', $order->items);
        $itemsQuantity = explode(',', $order->quantities);
        $items = [];
        for($i = 0; $i < count($itemsArray); $i++){
            $item = Item::find($itemsArray[$i]);
            $items[] = ['quantity' => $itemsQuantity[$i], 'price' => $item->price, 'item' => $item];
        }

        return view('shop.receipt')
            ->with('items', $items)
            ->with('order', $order)
            ->with('totalPrice', $order->total_price)
            ->with('user',$order->user);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if(!auth()->user()->role == 'PRODAJALEC'){
            redirect('/')->with('error', 'Unauthorized Page');
        }
        //validacija
        $this->validate($request, [
            'status' => ['required', 'in:POTRJENO,PREKLICANO,STORNIRANO']
        ]);


        $order = Order::find($id);
        //če želi stornirat, preveri ali je bilo potrjeno
        if($request->input('status') == 'STORNIRANO' && $order->status != 'POTRJENO'){
            return redirect()->back()->with('error', 'Cannot change status '.$order->status.' to STORNIRANO');
        }
        //preveri če je naročilo že stornirano, potem zavrni spremembe
        else if($order->status == 'STORNIRANO'){
            return redirect()->back()->with('error', 'Cannot modify status '.$order->status);
        }
        else {
            $order->status = $request->input('status');
            $order->save();
            return redirect('/orders')-> with('success', 'Narocilo '.$order->status);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
