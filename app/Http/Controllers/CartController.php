<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Arr;

class CartController extends Controller
{
    public function index() {
        $cart = session()->get('cart');
        $items = [];
        $total_price = 0;

        if(!$cart) $cart = [];

        foreach ($cart as $id => $item) {
            array_push($items, $item);
            $total_price += $item['quantity'] * $item['price'];
        }


        return view('cart', [
            'items' => $items,
            'total_price' => $total_price
        ]);
    }

    public function store(Request $request) {
        $item = $request->item;
        $cart = session()->get('cart');
        $total_price = 0;
        $delivery_fees = 3;

        if(!$cart) {
            $cart = [
                $item["id"] => Arr::add($item, "quantity", 1)
            ];
        } else {
            if(isset($cart[$item["id"]]))
                $cart[$item["id"]]["quantity"]++;
            else
                $cart = Arr::add($cart, $item["id"], Arr::add($item, "quantity", 1));
        }

        foreach ($cart as $id => $it) {
            $total_price += $it["quantity"] * $it["price"];
            // $delivery_fees += $it["quantity"] * 3;
        }

        session()->put('cart', $cart);
        session()->put('total_price', $total_price);
        session()->put('delivery_fees', $delivery_fees);

        return back()->with('cart_update', "Le panier a été mis à jour");
    }

    public function reduceItem(Request $request) {
        $item = $request->item;
        $this->updateCartItem($item, -1);
        return back()->with('status', "Le panier a été mis à jour");
    }

    public function addItem(Request $request) {
        $item = $request->item;
        $this->updateCartItem($item, 1);
        return back()->with('status', "Le panier a été mis à jour");
    }

    private function updateCartItem($item, $quantity) {
        $cart = session()->get('cart');
        $total_price = 0;
        $delivery_fees = 3;

        if(!$cart) abort(400);
        if(!isset($cart[$item])) abort(404);

        $cart[$item]["quantity"] += $quantity;
        if($cart[$item]["quantity"] == 0) {
            unset($cart[$item]);
        }

        foreach ($cart as $id => $it) {
            $total_price += $it["quantity"] * $it["price"];
            // $delivery_fees += $it["quantity"] * 3;
        }

        session()->put('cart', $cart);
        session()->put('total_price', $total_price);
        session()->put('delivery_fees', $delivery_fees);
    }
}
