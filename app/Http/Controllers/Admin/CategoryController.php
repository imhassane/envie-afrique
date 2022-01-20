<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    public function index() {
        $categories = Category::all();

        return view('admin.category.index', [
            'categories' => $categories,
        ]);
    }

    public function store(Request $request) {
        $request->validate([
            'category.name' => 'required|min:3',
            'category.description' => 'required|min:10',
            'category.cover' => 'required'
        ]);

        $name = $request->category["name"];
        $description = $request->category["description"];
        $path = $request->file('category.cover')->store('covers');

        DB::table('t_category_cat')->insert([
            'cat_name' => $name,
            'cat_description' => $description,
            'cat_avatar' => $path,
            'cat_visible' => false,
        ]);

        return back();
    }

    public function update(Request $request) {
        $request->validate([
            'cat.name' => 'required|min:5',
            'cat.description' => 'required|min:10',
            'cat.visible' => 'required'
        ]);

        $cat = Category::find($request->category);
        $cat->cat_name = $request->cat["name"];
        $cat->cat_description = $request->cat["description"];
        $cat->cat_visible = $request->cat["visible"];

        $cat->save();
        return back();
    }
}
