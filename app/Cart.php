<?php

namespace App;

class Cart
{
//    protected $fillable = [
//        'title', 'body', 'price', 'item_image '  ,
//    ];
    public $items = null;
    public $totalQuantity = 0;
    public $totalPrice = 0;

    public function __construct($oldCart)
    {
        if($oldCart) {
            $this->items = $oldCart->items;
            $this->totalQuantity = $oldCart->totalQuantity;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add($item, $id) {
        $storedItem = ['quantity' => 0, 'price' => $item->price, 'item' => $item];
        if($this->items) {
            if(array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
            }
        }
        $storedItem['quantity']++;
        $storedItem['price'] = $item->price * $storedItem['quantity'];
        $this->items[$id] = $storedItem;
        $this->totalQuantity++;
        $this->totalPrice += $item->price;
    }

    public function remove($item, $id) {
        if($this->items) {
            if(array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
//                ce je zadnji, izbrisi iz kosarice
                if($storedItem['quantity'] <= 1){
                    unset($this->items[$id]);
                }
                else {
                    $storedItem['quantity']--;
                    $storedItem['price'] = $item->price * $storedItem['quantity'];
                    $this->items[$id] = $storedItem;
                }
                $this->totalQuantity--;
                $this->totalPrice -= $item->price;
            }
        }
    }

    public function removeAllById($item, $id) {
        if($this->items) {
            if(array_key_exists($id, $this->items)) {
                $storedItem = $this->items[$id];
                unset($this->items[$id]);

                $this->totalQuantity-= $storedItem['quantity'];
                $this->totalPrice -= $item->price * $storedItem['quantity'];
            }
        }
    }

}