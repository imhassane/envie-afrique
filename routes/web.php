<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CustomerController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/produit/{productId}', [HomeController::class, 'product'])->name('product');
Route::get('/sitemap.xml', [\App\Http\Controllers\SitemapController::class, 'index'])->name('sitemap');

Route::get("/panier", [CartController::class, 'index'])->name('cart');
Route::post("/panier", [CartController::class, 'store']);
Route::post("/panier/diminuer/{item}", [CartController::class, 'reduceItem'])->name('cart-reduce');
Route::post("/panier/ajouter/{item}", [CartController::class, 'addItem'])->name('cart-add');

Route::get('/commande', [OrderController::class, 'index'])->name('order');
Route::post('/commande', [OrderController::class, 'store']);
Route::get('/commande/succes', [HomeController::class, 'success'])->name('order-success');
Route::get('/comamnde/error', [HomeController::class, 'error'])->name('order-error');

Route::get('/commande/track/{orderId}', [OrderController::class, 'track'])->name('track');

Route::prefix('admin')->group(function() {
    Route::get("/", [AdminController::class, 'index'])->name('admin:home');

    Route::prefix('category')->group(function() {
        Route::get('/', [CategoryController::class, 'index'])->name('admin:category:index');
        Route::post('/', [CategoryController::class, 'store']);
        Route::post("/{category}/edit", [CategoryController::class, 'update'])->name('admin:category:update');
    });

    Route::prefix('product')->group(function() {
        Route::get("/", [ProductController::class, 'index'])->name('admin:product:index');
        Route::get("/new", [ProductController::class, 'new'])->name('admin:product:new');
        Route::post('/new', [ProductController::class, 'store']);

        Route::get('/{product}', [ProductController::class, 'update'])->name('admin:product:update');
        Route::put('/{product}', [ProductController::class, 'saveUpdate']);
        Route::put('/{product}/suggest', [ProductController::class, 'suggest'])->name('admin:product:suggest');
    });

    Route::prefix('customer')->group(function() {
        Route::get('/', [CustomerController::class, 'index'])->name('admin:customer:index');
    });

    Route::prefix('order')->group(function() {
        Route::get('/', [\App\Http\Controllers\Admin\OrderController::class, 'index'])->name('admin:order:index');

        Route::post('/preparation/start', [\App\Http\Controllers\Admin\OrderController::class, 'startPreparation'])->name('admin:order:start_preparation');
        Route::post('/preparation/end', [\App\Http\Controllers\Admin\OrderController::class, 'endPreparation'])->name('admin:order:end_preparation');
        Route::post('/delivery/start', [\App\Http\Controllers\Admin\OrderController::class, 'startDelivery'])->name('admin:order:start_delivery');
        Route::post('/delivery/end', [\App\Http\Controllers\Admin\OrderController::class, 'endDelivery'])->name('admin:order:end_delivery');
        Route::post('/roll-status', [\App\Http\Controllers\Admin\OrderController::class, 'rollStatusBack'])->name('admin:order:roll_status_back');
    });
});
