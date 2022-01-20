<?php

namespace App\Http\Controllers;

use App\Models\Product;

class SitemapController extends Controller
{
    public function index() {

        $meals = Product::where('pro_status', 'ACTIVE')->get();

        return response()
                ->view('sitemap', [
                    'meals' => $meals,
                ])
                ->header('Content-Type', 'text/xml');
    }
}
