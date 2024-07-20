<?php

use App\Models\ProductImage;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;

$rating = 0;

if (isset($_GET['rate'])) {

    $rating = htmlspecialchars($_GET["rate"]);
}


?>


@extends('layout.layout')

@section('content')
<div class="w-full flex flex-col items-center">
    @if (session('status'))
    <div class="text-green-500 font-bold font-serif">{{session('status')}}</div>
    @endif
    <div class="w-full md:w-1/2">
        <div class="mx-5 lg:mx-50 my-10 flex flex-col lg:flex-row gap-10">
            <div class="w-full md:w-1/2 flex flex-col justify-center items-center">

                <img src="/{{$firstImage}}" class="" alt="{{$product->name}}" />

                <div class="my-10 flex gap-5 overflow-auto">
                    @foreach($otherImages as $image)
                    <img src="/{{$image->image}}" class="" width={200} height={200} alt="{{$product->name}}" />
                    @endforeach
                </div>

            </div>
            <div class="w-full md:w-1/2 flex flex-col">
                <div>
                    <div class="flex justify-between items-center">
                        <h2 class="font-bold text-2xl capitalize">{{$product->name}}</h2>
                    </div>
                    <div class="my-5 flex gap-5 items-center">
                        <div class="flex items-center gap-2">
                            @for($i=0; $i < $averageRating; $i++) <i class="fa-solid fa-star text-green-400"></i>
                                @endfor
                                ({{count($reviews)}})
                        </div>
                        <a href="#reviews">Write a review </a>
                    </div>
                    <div>
                        <p class="font-bold text-xl">
                            {{($price)}}
                        </p>
                    </div>
                </div>
                <div class="my-5">
                    <p>{{$product->description}}</p>
                </div>
                <div class="flex items-center gap-3">
                    @if($product->quantity > 0)
                    In-Stock (<span class="text-black dark:text-white mx-0 px-0">
                            {{$product->quantity}}
                            </span>)  
                            @else
                            <p class="text-red-400 font-bold">Out of Stock</p>
                            @endif
                       
                    
                </div>
                @if(Auth::user())
                <div class="my-10">
                    <form action="{{route('cart.create', $product->id)}}" method="POST">
                        @csrf
                        
                        <input type="hidden" name="user" id="user" value="{{Auth::user()->id}}">
                        <input type="hidden" name="product" id="product" value="{{$product->id}}">
                        <input type="hidden" name="quantity" id="quantity" value="1">    
                        @if($product->quantity > 0)                   
                         <x-primary-button>
                            Add to cart
                        </x-primary-button>
                        @else
                        <button class="rounded-md bg-red-600 border border-slate-100 py-2 px-4 " disabled>
                            <p class="line-through uppercase font-bold text-white">Add to cart</p>
                        </button>
                        @endif
                    </form>
                    
                </div>
                @endif
            </div>
        </div>
        <div class="mx-5">
            <h4 class="font-semibold">Product Specifications</h4>
            <div>
                here
            </div>
        </div>
        {{-- <div class="mx-5">specs</div>
        <div class="mx-5">images</div> --}}
        <div id="reviews" class="mx-5">
            <h4 class="font-semibold my-5">Ratings and Reviews</h4>
            <div class="flex justify-between">

                <div>
                    <h5>Overall Rating</h5>
                    <div class="flex gap-3 my-5">
                        <p class="font-semibold text-3xl">{{$averageRating}}</p>
                        <div>

                            <div class="flex items-center gap-1">
                                @for($i=0; $i < $averageRating; $i++) <i class="fa-solid fa-star text-green-400"></i>
                                    @endfor

                            </div>
                            @if(count($reviews) > 1)
                            <p>reviews</p>
                            @else
                            <p>review</p>
                            @endif
                        </div>
                    </div>
                </div>

                <div>
                    <h5>Rate this product</h5>
                    <div class="flex gap-3 my-5">

                        
                        <form method="GET" action="{{route('products.show', $product->id)}}">
                            @csrf
                            <input type="hidden" value="1" name="rate">
                                
                                <button class="border border-slate-500 p-2 rounded-sm">
                                    <i @class([ 'fa-solid' , 'fa-star' , 'text-green-400'=> ($rating > 0),
                                        ])

                                        ></i></button>
                                    
                            </form>
                        
                            <form method="GET" action="/products/{{$product->id}}">
                                @csrf
                                <input type="hidden" value="2" name="rate">
                                <button class="border border-slate-500 p-2 rounded-sm">
                                    <i @class([ 'fa-solid' , 'fa-star' , 'text-green-400'=> ($rating > 1),
                                        ])

                                        ></i></button>
                            </form>
                       
                        
                            <form method="GET" action="/products/{{$product->id}}">
                                @csrf
                                <input type="hidden" value="3" name="rate">
                                <button class="border border-slate-500 p-2 rounded-sm">
                                    <i @class([ 'fa-solid' , 'fa-star' , 'text-green-400'=> ($rating > 2),
                                        ])

                                        ></i></button>
                            </form>
                        
                       
                            <form method="GET" action="/products/{{$product->id}}">
                                @csrf
                                <input type="hidden" value="4" name="rate">
                                <button class="border border-slate-500 p-2 rounded-sm">
                                    <i @class([ 'fa-solid' , 'fa-star' , 'text-green-400'=> ($rating > 3),
                                        ])

                                        ></i></button>
                            </form>
                       
                        
                            <form method="GET" action="/products/{{$product->id}}">
                                @csrf
                                <input type="hidden" value="5" name="rate">
                                <button class="border border-slate-500 p-2 rounded-sm">
                                    <i @class([ 'fa-solid' , 'fa-star' , 'text-green-400'=> ($rating == 5),
                                        ])

                                        ></i>
                            </form>
                        
                    </div>
                </div>
            </div>
            @if(Auth::user())
            <div class="my-10">
                <form action="{{route('product.review', $product->id)}}" method="POST" class="h-32 my-10 border border-slate-400 dark:border-none rounded-md">
                    @csrf

                    <input type="hidden" value="{{$rating}}" name="rating" id="rating">
                    <input type="hidden" value="{{Auth::user()->name}}" name="user" id="user">

                    <div class="flex w-full h-full">
                        <textarea placeholder="Review" name="review" id="review" class="text-black p-2 rounded-sm w-full h-full outline-none"></textarea>
                    </div>

                    <div class="w-full flex justify-end">

                        <input type="submit" value="Submit" class="p-2 rounded-sm my-3 bg-blue-500 hover:bg-blue-800 text-white font-bold cursor-pointer">

                    </div>


                </form>
            </div>
            @else
            <div class="w-full my-2">
                <p class="text-center font-semibold text-xl">Please <a href="{{route('login')}}" class="text-blue-300">login</a> to submit review for this product</p>
            </div>
            @endif

            <div class="my-20">

                @foreach($reviews as $review)
                <div class="w-full border border-slate-400 py-2 px-5 rounded-md flex flex-col gap-5 my-10">

                    <div class="flex justify-between items-center">
                        <p>

                            @for($i=0; $i < $review->rating; $i++) <i class="fa-solid fa-star text-green-400 sm"></i>
                                @endfor
                        </p>
                        <?php

                        $date = Carbon::parse($review->created_at);
                        $timeAgo = $date->diffForHumans();
                        ?>
                        <p>{{$timeAgo}}</p>

                    </div>
                    <p class="font-bold">{{$review->user}}</p>
                    <p class="text-base font-semi-bold">{{$review->review}}</p>


                </div>
                @endforeach

                <div class="w-full flex justify-center items-center">
                    <div class="w-2/3 my-5">

                        {{$reviews->links()}}
                    </div>

                </div>

                <div class="mt-20">
                    <h3 class="font-bold text-2xl">Related products</h3>
                    <div class="h-[20rem]">
                        <div class="mt-6 grid grid-cols-2 gap-x-6 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8">
                            @foreach($relatedProducts as $product)
                            <?php

                            $productImage = ProductImage::where('product_id', $product->id)->get();

                            $image = $productImage[0];

                            $price = Number::currency($product->price, 'NGN');
                            ?>
                            <x-product name="{{$product->name}}" price="{{$price}}" quantity="{{$product->quantity}}" category="{{$product->category}}" image="{{$image->image}}" id="{{$product->id}}" />
                            @endforeach
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection