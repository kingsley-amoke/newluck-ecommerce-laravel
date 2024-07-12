

<?php
use App\Models\ProductImage;
use Illuminate\Support\Number;

?>

@extends('layout.layout')


@section('content')
<div class="w-full px-10 my-20">
  <h2 class="text-center font-bold text-2xl my-2">All Products</h2>
      <div class="mt-6 grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
      @foreach($products as $product)  
      <?php

       $productImage = ProductImage::where('product_id', $product->id)->get();

       $image = $productImage[0];

       $price = Number::currency($product->price, 'NGN');
      ?>
      <x-product name="{{$product->name}}" price="{{$price}}" quantity="{{$product->quantity}}" category="{{$product->category}}" image="{{$image->image}}" id="{{$product->id}}"/>
      @endforeach
      </div>
      <div class="w-full flex justify-center items-center">
        <div class="w-2/3 my-5">

          {{$products->links()}}
        </div>

      </div>
    </div>
@endsection