
<?php

use App\Models\User;
use App\Models\Product;

foreach($orders as $order){
    $user = User::find($order->user_id);
    
}

?>


@extends('layout.layout')

@section('content')
<div class="w-full flex flex-col justify-center items-center my-20 px-10 gap-20">
    <h2 class="text-2xl font-cold">All orders</h2>
    <div class="flex flex-col md:flex-row md:flex-wrap gap-10">
        @foreach($orders as $order)

            <div class="p-4 border border-slate-500" > 
                <div class="my-6">

                    <span class="text-xl font-semibold capitalize">
                        {{$user->name}} </span>
                        <span>ordered for a product </span>
                    </div>
                        
                            <a href="{{route('orders.show', $order->id)}}">
                                <x-primary-button>
                                    View
                                </x-primary-button>
                            </a>
                      
                    </div>

        
            
        </div>
        @endforeach
    </div>
</div>
@endsection