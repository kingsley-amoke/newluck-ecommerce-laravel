<?php

use Illuminate\Support\Carbon;


$rating = 0;

if(isset($_GET['rate'])){

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

                <img src="/{{$firstImage}}" class="w-full h-full" width={500} height={500} alt="{{$product->name}}" />

                <div class="my-10 flex gap-5 overflow-auto">
                    @foreach($otherImages as $image)
                    <img src="/{{$image->image}}" class="w-full h-full" width={200} height={200} alt="{{$product->name}}" />
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
                    Qty
                    <div class="bg-gray-200 py-2 px-4 flex gap-5 items-center text-black">
                        <i class="fa-solid fa-chevron-left"></i>
                        {{$product->quantity}}
                        <i class="fa-solid fa-chevron-right"></i>
                    </div>
                </div>
            </div>
        </div>
        <div class="mx-5">
            <h4 class="font-semibold">Product Specifications</h4>
            <div>
                here
            </div>
        </div>
        <div class="mx-5">specs</div>
        <div class="mx-5">images</div>
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

                        <div class="border border-slate-500 p-2 rounded-sm }">

                            <form method="GET" action="/products/{{$product->id}}">
                                @csrf
                                <input type="hidden" value="1" name="rate">
                                <button><i @class([ 'fa-solid' , 'fa-star' , 'text-green-400'=> ($rating > 0),
                                        ])

                                        ></i></button>
                            </form>
                        </div>
                        <div class="border border-slate-500 p-2 rounded-sm">
                        <form method="GET" action="/products/{{$product->id}}">
                                @csrf
                                <input type="hidden" value="2" name="rate">
                                <button><i @class([ 'fa-solid' , 'fa-star' , 'text-green-400'=> ($rating > 1),
                                        ])

                                        ></i></button>
                            </form>
                        </div>
                        <div class="border border-slate-500 p-2 rounded-sm">
                        <form method="GET" action="/products/{{$product->id}}">
                                @csrf
                                <input type="hidden" value="3" name="rate">
                                <button><i @class([ 'fa-solid' , 'fa-star' , 'text-green-400'=> ($rating > 2),
                                        ])

                                        ></i></button>
                            </form>
                        </div>
                        <div class="border border-slate-500 p-2 rounded-sm">
                        <form method="GET" action="/products/{{$product->id}}">
                                @csrf
                                <input type="hidden" value="4" name="rate">
                                <button><i @class([ 'fa-solid' , 'fa-star' , 'text-green-400'=> ($rating > 3),
                                        ])

                                        ></i></button>
                            </form>
                        </div>
                        <div class="border border-slate-500 p-2 rounded-sm">
                        <form method="GET" action="/products/{{$product->id}}">
                                @csrf
                                <input type="hidden" value="5" name="rate">
                                <button><i @class([ 'fa-solid' , 'fa-star' , 'text-green-400'=> ($rating == 5),
                                        ])

                                        ></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
            <div class="my-10">
                <form action="/products/{{$product->id}}/review" method="POST" class="h-32 my-10 border border-slate-400 dark:border-none rounded-md">
                    @csrf

                    <input type="hidden" value="{{$rating}}" name="rating" id="rating">

                    <div class="flex w-full h-full">
                        <textarea placeholder="Review" name="review" id="review" class="text-black p-2 rounded-sm w-full h-full outline-none"></textarea>
                    </div>

                    <div class="w-full flex justify-end">

                        <input type="submit" value="Submit" class="p-2 rounded-sm my-3 bg-blue-500 hover:bg-blue-800 text-white font-bold cursor-pointer">

                    </div>


                </form>
            </div>

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
                    <p class="font-bold">user</p>
                    <p class="text-base font-semi-bold">{{$review->review}}</p>


                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
@endsection