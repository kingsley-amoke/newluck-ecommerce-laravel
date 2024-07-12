<?php

use App\Models\ProductImage;
use Illuminate\Support\Number;

?>

@extends('layout.layout')

@section('content')
<div class="w-full px-10 my-20">
<h2 class="text-center font-bold text-2xl mb-5 capitalize">{{$category->name}}</h2>
      @if(count($products) > 0)
      <div class="mt-6 grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
            @foreach($products as $product)
            <?php
            $productImage = ProductImage::where('product_id', $product->id)->get();

            if (count($productImage) > 0) {

                  $image = $productImage[0]->image;
            }else{
                  $image = '';
            }



            $price = Number::currency($product->price, 'NGN');
            ?>
            <x-product name="{{$product->name}}" price="{{$price}}" quantity="{{$product->quantity}}" category="{{$product->category}}" image="{{$image}}" id="{{$product->id}}" />
            @endforeach
            <div class="w-full flex justify-center items-center">
        <div class="w-2/3 my-5">

          {{$products->links()}}
        </div>

      </div>
      </div>
      @else
      <div class="my-5">
            <p class="font-semibold text-xl text-center">No product here..</p>
      </div>
      @endif
</div>
@endsection