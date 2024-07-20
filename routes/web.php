<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Middleware\VerifyCsrfToken;
use App\Models\Cart;
use App\Models\Pizza;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('index');

Route::get('/dashboard', function () {

    $cart = Cart::where('user_id', Auth::user()->id)->get();
    if (Auth::user()->admin) {



        return view('dashboard',  ['cart' => $cart]);
    } else {
        return redirect()->route('index');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//categories routes

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/create', [CategoryController::class, 'create'])->middleware(['auth', 'verified'])->name('categories.create');
Route::get('/categories/{category:slug}', [CategoryController::class, 'show'])->name('categories.show');

Route::post('/categories/create', [CategoryController::class, 'store'])->middleware(['auth', 'verified']);

//products routes

Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->name('products.create')->middleware(['auth', 'verified']);
Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');

Route::post('/products/create', [ProductController::class, 'store'])->middleware(['auth', 'verified']);


//product images

Route::get('products/{productId}/upload', [ProductImageController::class, 'index'])->middleware(['auth', 'verified'])->name('images.upload');

Route::post('products/{productId}/upload', [ProductImageController::class, 'store'])->middleware(['auth', 'verified']);
Route::get('product-image/{productImageId}/delete', [ProductImageController::class, 'destroy'])->middleware(['auth', 'verified'])->name('images.delete');


//reviews and ratings

Route::post('products/{productId}/review', [ReviewController::class, 'store'])->middleware(['auth', 'verified'])->name('product.review');

//cart

Route::get('cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/products/{id}', [CartController::class, 'store'])->name('cart.create');
Route::get('cart/{id}', [CartController::class, 'destroy'])->name('cart.delete');
Route::post('cart/{id}', [CartController::class, 'increment'])->name('cart.increment');
Route::post('cart/{id}/add', [CartController::class, 'decrement'])->name('cart.decrement');

//orders

Route::get('orders', [OrderController::class, 'index'])->middleware(['auth', 'verified'])->name('orders.index');
Route::get('orders/{id}', [OrderController::class, 'show'])->middleware('auth', 'verified')->name('orders.show');
Route::post('cart', [OrderController::class, 'store'])->name('orders.create');
Route::post('orders/{id}', [OrderController::class, 'destroy'])->middleware('auth', 'verified')->name('orders.delete');





require __DIR__ . '/auth.php';
