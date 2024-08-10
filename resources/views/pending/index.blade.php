

<?php

use App\Models\User;
use App\Models\Product;


?>

@extends('layout.layout')

@section('content')

<div class= "my-20 px-10">
    <h2 class="text-2xl font-cold">Pending orders</h2>
        @if(count($pending) > 0)
        @foreach($pending as $order)
                <a href="{{route('pending.show', $order->id)}}" class="my-6 flex items-center gap-5 border-b-[1px] border-b-gray-300 pb-5">

                    <span class="capitalize">
                        You 
                        <span class="lowercase">order is on transit</span>
                    </span>
                    @if($order->status === 'pending')
                    <i class="fa-regular fa-hourglass-half text-yellow-400"></i>
                    @else
                    <i class="fa-solid fa-check-circle text-green-500"></i>
                    @endif
                    </a>
                      
                
                
        @endforeach
        @else
            <p class="mx-5">There is no orders for now!!..</p>
        @endif
</div>
@endsection