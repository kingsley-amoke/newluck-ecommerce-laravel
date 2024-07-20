<?php

use App\Models\Product;
use App\Models\ProductImage;
?>


@extends('layout.layout')

@section('content')
<div class="w-full flex flex-col justify-center items-center my-20">
    @foreach($cart as $item)
    <?php
        $product = Product::find($item->product_id);

        $image = ProductImage::where('product_id', $product->id)->get();

        $price = Number::currency($product->price, 'NGN');
       
    ?>

    <div class="border border-slate-400 py-5 px-3 m-4 flex gap-20 w-full md:w-1/2">
        <img src="{{$image[0]->image}}" alt="{{$product->name}}" class="w-20 h-20">
        <div class="flex flex-col">

            <p class="font-bold text-2xl">
                {{$product->name}}
                </p>
                <p>

                    {{$price}}
                </p>
                <div class="flex justify-between items-center mt-5">
                    <div class="border border-slate-500 flex gap-4 px-3">

                        <form action="{{route('cart.decrement', $item->id)}}" method="POST">
                            @csrf
                        <button>
                            <i class="fa-solid fa-chevron-left"></i>
                        </button>
                    </form>
                    <p>
                        x{{$item->quantity}}
                        </p>
                        <form action="{{route('cart.increment', $item->id)}}" method="POST">
                            @csrf
                            <button>
                                <i class="fa-solid fa-chevron-right"></i>
                            </button>
                        </form>
                    </div>


                    <a href="{{ url('cart/'.$item->id) }}" class="font-bold ml-10">
                       <i class="fa-solid fa-trash"></i>
                    </a>
                </div>
        </div>
    </div>
    @endforeach

    <div class="my-10">
        <form action="{{route('orders.create')}}" method="POST">
            @csrf
        <x-primary-button>
            Checkout
        </x-primary-button>
    </form>
    </div>
</div>
@endsection