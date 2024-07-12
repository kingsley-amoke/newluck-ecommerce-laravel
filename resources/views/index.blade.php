<?php

use App\Models\ProductImage;
use Illuminate\Support\Number;
?>

@extends('layout.layout')


@section('content')
<main class="">
  <p class="text-center text-green-400 font-bold text-xl">{{session('success')}}</p>
  <x-hero />

  <div class="my-10 flex justify-center items-center">

    <div class="grid grid-cols-2 grid-rows-2 gap-3 lg:gap-5 md:w-1/2 md:h-[40rem] mx-5">

      @foreach($categories as $category)
      <x-categories name="{{$category->name}}" slug="{{$category->id}}" image="{{$category->image}}" />
      @endforeach
    </div>

  </div>
  <div class="">
    <div class="mx-auto max-w-2xl px-4 py-16 sm:px-6 sm:py-24 lg:max-w-7xl lg:px-8">
      <div class="flex justify-between items-center">
        <h2 class="text-2xl font-bold tracking-tight">
          Our Newest products
        </h2>

        <a class="text-primary flex items-center gap-x-1" href="/products">
          See All
          <span>
            <i class="fa-solid fa-arrow-right"></i>
          </span>
        </a>
      </div>
      <div class="mt-6 grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">

        @foreach($products as $product)
        <?php



        $productImage = ProductImage::where('product_id', $product->id)->get();

        if (count($productImage) > 0) {

          $image = $productImage[0]->image;
        } else {
          $image = 'images/products/no-image.jpg';
        }

        $price = Number::currency($product->price, 'NGN');
        ?>
        <x-product name="{{$product->name}}" price="{{$price}}" quantity="{{$product->quantity}}" category="{{$product->category}}" image="{{$image}}" id="{{$product->id}}" />
        @endforeach
      </div>
    </div>
  </div>
</main>
@endsection