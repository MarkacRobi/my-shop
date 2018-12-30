<?php

namespace App\Http\Controllers;

use App\Cart;
use Illuminate\Http\Request;
use App\Item;
use DB;
use Illuminate\Support\Facades\Session;


class CartController extends Controller
{
    public function getAddToCart(Request $request, $id) {
        $item = Item::find($id);
        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);
        $cart->add($item, $item->id);

        $request->session()->put('cart', $cart);

        return redirect('/') -> with('success', 'Item '.$item->title.' added to cart');
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
        return view('shop.receipt')->with('items', $cart->items)->with('totalPrice', $cart->totalPrice);
    }
}
