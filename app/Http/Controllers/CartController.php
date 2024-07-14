<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function index()
    {
        $cart = Cart::where('user_id', Auth::user()->id)->get();


        return view('cart.index', ['cart' => $cart]);
    }


    public function store($id)
    {

        $cart = new Cart();

        $product = Cart::where('product_id', $id)->get();


        if (count($product) > 0) {


            $product[0]->quantity += 1;

            $product[0]->save();
        } else {


            $cart->quantity = request('quantity');

            $cart->user_id = request('user');
            $cart->product_id = request('product');



            $cart->save();
        }



        return redirect(route('products.show', $id))->with('message', 'Thanks for your order');
    }

    public function increment($id){
        $cart = Cart::findorFail($id);

        $cart->quantity += 1;

        $cart->save();

        return redirect(route('cart.index'));

        
    }

    public function decrement($id){
        $cart = Cart::findorFail($id);

        if($cart->quantity > 1){
            $cart->quantity -= 1;
        } else{
            $cart->delete();
        }

        $cart->save();

        return redirect(route('cart.index'));
    }

    public function destroy($id)
    {

        $cart = Cart::findorFail($id);


        $cart->delete();

        return redirect(route('cart.index'));
    }
}
