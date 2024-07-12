<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DefaultController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PizzaController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductImageController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index']);

Route::get('/pizzas', [PizzaController::class, 'index']);
Route::get('/pizzas/create', [PizzaController::class, 'create']);
Route::get('/pizzas/{id}', [PizzaController::class, 'show']);

Route::post('/pizzas', [PizzaController::class, 'store']);


//categories routes

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/categories/create', [CategoryController::class, 'create']);
Route::get('/categories/{category:slug}', [CategoryController::class, 'show']);

Route::post('/categories/create', [CategoryController::class, 'store']);

//products routes

Route::get('/products', [ProductController::class, 'index']);
Route::get('/products/create', [ProductController::class, 'create']);
Route::get('/products/{id}', [ProductController::class, 'show']);

Route::post('/products/create', [ProductController::class, 'store']);


//product images

Route::get('products/{productId}/upload', [ProductImageController::class, 'index']);
Route::post('products/{productId}/upload', [ProductImageController::class, 'store']);
Route::get('product-image/{productImageId}/delete', [ProductImageController::class, 'destroy']);

//reviews and ratings

Route::post('products/{productId}/review', [ReviewController::class, 'store']);
