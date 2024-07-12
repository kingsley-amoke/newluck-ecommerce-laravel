<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {

        

        $categories = Category::all();

        $products = Product::orderBy('created_at', 'desc')->get();

        

        return view('index', ['categories' => $categories, 'products' => $products]);
    }
}
