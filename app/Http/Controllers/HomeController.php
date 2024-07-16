<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function index()
    {

        

        $categories = Category::all();

        $products = Product::orderBy('created_at', 'desc')->paginate(12);

        if(Auth::user()){

            $cart = Cart::where('user_id', Auth::user()->id)->get();
        }else{
            $cart = [];
        }


        

        return view('index', ['categories' => $categories, 'products' => $products, 'cart' => $cart]);
    }
}
