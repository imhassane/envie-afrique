<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index() {
        $products = Product::all();

        return view('admin.product.index', [
            'products' => $products,
        ]);
    }

    public function new() {
        return view('admin.product.new');
    }

    public function store(Request $request) {
        $request->validate([
            'p.name' => 'required|min:2',
            'p.price' => 'required',
            'p.description' => 'required|min:10',
            'p.cover' => 'required',
            'p.country' => 'required',
            'p.article' => 'required'
        ]);

        $p = $request->p;
        $path = $request->file('p.cover')->store('covers');

        DB::table('t_product_pro')->insert([
            'pro_name' => $p["name"],
            'pro_description' => $p["description"],
            'pro_cover' => $path,
            'pro_price' => $p["price"],
            'pro_article' => $p["article"],
            'pro_country' => $p['country']
        ]);

        return back();
    }

    public function update(Request $request) {
        $p = Product::find($request->product);
        return view('admin.product.update', [
            'p' => $p
        ]);
    }

    public function saveUpdate(Request $request) {
        $request->validate([
            'p.name' => 'required|min:2',
            'p.price' => 'required',
            'p.description' => 'required|min:10',
            'p.country' => 'required',
            'p.article' => 'required',
            'p.status' => 'required'
        ]);

        $p = $request->p;
        $product = Product::find($request->product);

        $path = $request->file('p.cover');
        if(!is_null($path))
            $path = $path->store('covers');

        $product->pro_name = $p["name"];
        $product->pro_description = $p["description"];
        if(!is_null($path))
            $product->pro_cover = $path;

        $product->pro_status = $p['status'];
        $product->pro_price = $p["price"];
        $product->pro_article = $p["article"];
        $product->pro_country = $p['country'];

        $product->save();

        return back();
    }

    public function suggest(Request $request) {
        $p = Product::find($request->product);

        DB::table('t_product_pro')->update(['pro_suggestion' => false]);
        $p->pro_suggestion = true;
        $p->save();

        return back();
    }
}
