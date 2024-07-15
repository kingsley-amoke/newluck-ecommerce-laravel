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

        if(!Auth::user()->admin){
            return redirect()->route('index');
        }

        $orders = Order::orderBy('created_at', 'desc')->get();

        return view('orders.index', ['orders' => $orders]);
    }

    public function show($id){

        if(!Auth::user()->admin){
            return redirect()->route('index');
        }

        $order = Order::findorFail($id);
        return view('orders.show', ['order' => $order]);
    }

    public function store(){

        $cart = Cart::where('user_id', Auth::user()->id)->get();

        $products = [
            
        ];

        foreach($cart as $item){
            $product = ['id' => $item->product_id, 'quantity' => $item->quantity];

            array_push($products, $product);
            $item->delete();
        };

        $order = new Order();

        $order->user_id = Auth::user()->id;
       $order->products = $products;

       $order->save();




        return redirect(route('index'));
    }

    public function destroy($id){

        $order = Order::findorFail($id);

        $order->delete();

        return redirect()->route('orders.index');
    }
    
}
