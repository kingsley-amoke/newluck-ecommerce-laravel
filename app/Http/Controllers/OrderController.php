<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
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

        $pending = Order::orderBy('created_at', 'desc')->where('status', 'pending')->get();

        $completed = Order::orderBy('created_at', 'desc')->where('status', 'completed')->get();

        return view('orders.index', ['all_orders' => $orders, 'completed'=> $completed, 'pending'=>$pending]);
    }

    public function show($id){

        if(!Auth::user()->admin){
            return redirect()->route('index');
        }

        $order = Order::findorFail($id);
        return view('orders.show', ['order' => $order]);
    }

    public function store($paymentId){

        $payment = Payment::find($paymentId);

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

       $payment->order_id = $order->id;
       $payment->save();



        return redirect(route('payment.success'));
    }


    public function destroy($id){

        $order = Order::findorFail($id);

        foreach($order->products as $item){
            $product = Product::findorFail($item['id']);

            $product->quantity -= $item['quantity'];

            $product->save();
        }

        $order->status = "completed";
        $order->save();


        return redirect()->route('orders.index');
    }
    
}
