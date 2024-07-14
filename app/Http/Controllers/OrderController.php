<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function index(){
        return view('orders.index');
    }

    public function show(){
        return view('orders.show');
    }

    public function store(){

        $cart = Cart::where('user_id', Auth::user()->id)->get();

        $products = [
            
        ];

        foreach($cart as $item){
            $product = ['id' => $item->id, 'quantity' => $item->quantity];

            array_push($products, $product);
        };

        $order = new Order();

        $order->user_id = Auth::user()->id;
       $order->products = $products;

       $order->save();


        return redirect(route('index'));
    }
    
}
