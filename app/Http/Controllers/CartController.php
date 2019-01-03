<?php

namespace App\Http\Controllers;

use App\Cart;
use App\Http\Middleware\StrankaMiddleware;
use Illuminate\Http\Request;
use App\Item;
use DB;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{

    public function __construct()
    {
        $this->middleware(StrankaMiddleware::class);
    }

    public function getAddToCart(Request $request, $id) {
        $item = Item::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($item, $item->id);

        $request->session()->put('cart', $cart);
        if(strpos(url()->previous(), 'shopping-cart') !== false){
            return redirect('/shopping-cart') -> with('success', 'Item '.$item->title.' added to cart');
        }
        return redirect('/') -> with('success', 'Item '.$item->title.' added to cart');
    }

    public function getRemoveFromCart(Request $request, $id) {
        $item = Item::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->remove($item, $item->id);

        $request->session()->put('cart', $cart);
        return redirect('/shopping-cart') -> with('success', 'Item '.$item->title.' removed from cart');
    }

    public function getRemoveAllByIdFromCart(Request $request, $id) {
        $item = Item::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->removeAllById($item, $item->id);

        $request->session()->put('cart', $cart);
        return redirect('/shopping-cart') -> with('success', 'Item '.$item->title.' removed from cart');
    }

    public function getCart() {
        if(!Session::has('cart')) {
            return view('shop.shopping-cart')->with('items', null);
        }
        $oldCart = Session::get('cart');
        $cart = new Cart($oldCart);
        return view('shop.shopping-cart')->with('items', $cart->items)->with('totalPrice', $cart->totalPrice);
    }

    public function getReceipt() {
        if(!Session::has('cart')) {
            return view('/')->with('error', 'Napaka pri pridobitvi seje košarice za pripravo računa');
        }
        $cart = Session::get('cart');
        $user = auth()->user();
        $itemsArray = implode(",", array_keys($cart->items)); // seznam id artiklov locen z vejico
        $itemsQuantity = '';
        foreach ($cart->items as $key => $value) {
            if (!next( $cart->items )){
                $itemsQuantity = $itemsQuantity.$value['quantity'];
            }
            else {
                $itemsQuantity = $itemsQuantity.$value['quantity'].',';
            }
        }

        return view('shop.receipt')
            ->with('items', $cart->items)
            ->with('totalPrice', $cart->totalPrice)
            ->with('user',$user)
            ->with('itemsArray', $itemsArray)
            ->with('quantities', $itemsQuantity);

    }
}
