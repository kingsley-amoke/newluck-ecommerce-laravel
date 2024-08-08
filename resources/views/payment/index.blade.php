<?php

use App\Models\Product;
use App\Models\ProductImage;

function sum_array($item1, $item2) {
  return floatval($item1) +floatval($item2);
}

$initial_value = 0;

$product_prices = [];

foreach($order as $cart_item){
  $product = Product::find($cart_item->product_id);

  $total = floatval($product->price) * intval($cart_item->quantity);

  array_push($product_prices, $total);
}

$accumulated_price = array_reduce($product_prices, "sum_array", "initial_value");

$formated_price = Number::currency($accumulated_price, 'NGN');


?>

{{-- @extends('layout.layout')


@section('content') --}}
<x-guest-layout>
  
  <div class="w-full my-10 dark:text-white">
  <h3 class="text-center">Order summary</h3>

</div>
<div class="w-full flex flex-col justify-center items-center dark:text-white">

  <div class="border border-gray-300 rounded-sm p-10 mx-2">
    
    @foreach($order as $item)
    <?php
        $product = Product::find($item->product_id);

        $quantity = $item->quantity;

        $price = Number::currency($product->price, 'NGN');

        $total = Number::currency(floatval($product->price) * intval($quantity), 'NGN');

        $image = ProductImage::where('product_id', $product->id)->get();
       
    ?>
    <h2 class="font-bold">Product: {{$product->name}}</h2>
    <div class="flex justify-between items-center">
<div>

  <h3>Price: {{$price}}</h3>
  <h3>Quantity: {{$quantity}}</h3>
  <h3>Total: {{$total}}</h3>
</div>
<div>
  <img src="{{$image[0]->image}}" alt="{{$product->name}}" class="w-20 h-20">
</div>
    </div>
      <div class="w-full my-5 bg-gray-300 h-[0.1rem]"></div>
    @endforeach
    <h3 >Total Price: {{$formated_price}}<span id="price" class="hidden">{{$accumulated_price}}</span></h3>
  </div>
  </div>
    
    <form id="paymentForm" class="w-full flex justify-center items-center my-10">
      <div class="form-submit">
        <x-primary-button onclick="payWithPaystack()">
          Proceed to payment
        </x-primary-button>
    
      </div>
    </form>

<script type="text/javascript">

let price =  document.getElementById('price').innerText;

  const paymentForm = document.getElementById('paymentForm');

  paymentForm.addEventListener('submit', payWithPaystack, false);

  function payWithPaystack(e){
    e.preventDefault();


    let handler = PaystackPop.setup({
      key: "{{ env('PAYSTACK_PUBLIC_KEY')}}",
      email: "{{ env('MERCHANT_EMAIL') }}",
      amount: parseFloat(price) * 100,
      metadata: {
        custom_fields: [

          {
            display_name: "Laptop",
            variable_name: "Laptop",
            value: "Laptop",
          },
          {
            display_name: "Quantity",
            variable_name: "Quantity",
            value: "1",
          }
        ]
      },
      onClose: function(){
        window.location.href = "http://127.0.0.1:8000/failure"
      },
      callback: function(response){

        window.location.href = response.redirecturl;
      }
    });
    handler.openIframe();
  }

</script>

</x-guest-layout>
{{-- @endsection --}}