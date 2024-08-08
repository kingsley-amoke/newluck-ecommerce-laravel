
<?php

use App\Models\User;
use App\Models\Product;

foreach($all_orders as $order){
    $user = User::find($order->user_id);
    
}

$sort;

if (isset($_GET['sort'])) {

    $sort = htmlspecialchars($_GET["sort"]);

    if($sort === 'completed'){
        $orders = $completed;
    }elseif ($sort === 'pending') {
        $orders = $pending;

    }
    else{
        $orders = $all_orders;
    }

}else{
    $orders= $all_orders;
}


?>


@extends('layout.layout')

@section('content')
<div class="flex gap-2 my-10 px-2">

    <form method="GET" action="{{route('orders.index')}}">
        @csrf
        <input type="hidden" value="all" name="sort">
        <x-primary-button>All</x-primary-button>
    </form>
    <form method="GET" action="{{route('orders.index')}}">
        @csrf
        <input type="hidden" value="pending" name="sort">
    <x-primary-button >Pending</x-primary-button>
</form>
<form method="GET" action="{{route('orders.index')}}">
    @csrf
    <input type="hidden" value="completed" name="sort">
    <x-primary-button >Completed</x-primary-button>
</form>
</div>

<div class= "my-20 px-10">
    <h2 class="text-2xl font-cold">All orders</h2>
        @if(count($orders) > 0)
        @foreach($orders as $order)
                <a href="{{route('orders.show', $order->id)}}" class="my-6 flex items-center gap-5 border-b-[1px] border-b-gray-300 pb-5">

                    <span class="capitalize">
                        {{$user->name}} 
                        <span class="lowercase">ordered for a product</span>
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