<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PaystackPaymentController extends Controller
{
    public function index(){
        
        $cart = Cart::where('user_id', Auth::user()->id)->get();


        return view('payment.index', ['order' => $cart]);
    }

    public function callback(Request $request){
       
        $reference = $request->reference;
        $secret_key = env('PAYSTACK_SECRET_KEY');

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.paystack.co/transaction/verify/$reference",

            CURLOPT_RETURNTRANSFER => true,
        
            CURLOPT_ENCODING => "",
        
            CURLOPT_MAXREDIRS => 10,
        
            CURLOPT_TIMEOUT => 30,
        
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        
            CURLOPT_CUSTOMREQUEST => "GET",
        
            CURLOPT_HTTPHEADER => array(
        
              "Authorization: Bearer $secret_key",
        
              "Cache-Control: no-cache",
        
            ),
        
    
        ));

        $response = curl_exec($curl);

        $err = curl_error($curl);
      
      
        curl_close($curl);

        $response = json_decode($response);

       if($response->data->status == 'success'){
        $obj = new Payment;
        $obj->user_id = Auth::user()->id;
        $obj->payment_id = $reference;
        $obj->amount = $response->data->amount / 100;
        $obj->currency = $response->data->currency;
        $obj->payment_status = 'Completed';
        $obj->payment_method = 'Paystack';
        $obj->save();


       return redirect()->action([PaystackPaymentController::class, 'success'], ['paymentId' => $obj->id]);

       }else{
        return redirect()->route('payment.failure');
       }

            
    }

    public function success($paymentId){

      

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

       $payment = Payment::findorFail($paymentId);

       $payment->order_id = $order->id;
       $payment->save();

        return view('payment.success');
    }

    public function failure(){
        return view('payment.failure');
    }
}
