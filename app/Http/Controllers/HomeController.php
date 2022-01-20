<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Dymantic\InstagramFeed\Profile;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {

        $suggestion = Product::where('pro_suggestion', true)->first();
        $meals = Product::where('pro_status', 'ACTIVE')->get();
        $feed = [
            'https://images.unsplash.com/photo-1604329756574-bda1f2cada6f?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=870&q=80',
            'https://images.unsplash.com/photo-1587287964686-f7453994571d?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=435&q=80',
            'https://images.unsplash.com/photo-1579619002916-88cd4c81a70c?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1031&q=80',
            'https://images.unsplash.com/photo-1561741858-cefa7ca99edf?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=774&q=80'
        ];

        return view('welcome', [
            'suggestion' => $suggestion,
            'meals' => $meals,
            'feed' => $feed,
        ]);
    }

    public function success() {
        $total_price = session()->get('total_price');
        $delivery_fees = session()->get('delivery_fees');

        session()->put('cart', array());
        session()->put('total_price', 0);
        session()->put('delivery_fees', 0);

        return view('success', [
            'total_price' => $total_price + $delivery_fees,
            'delivery_fees' => $delivery_fees,
        ]);
    }

    public function error() {
        return view('error', []);
    }

    public function product(Request $request, $productId) {
        $pro = Product::where('pro_id', $productId)->first();

        if(!$pro) return abort(404);

        return view('product', [
            'pro' => $pro,
        ]);
    }
}
