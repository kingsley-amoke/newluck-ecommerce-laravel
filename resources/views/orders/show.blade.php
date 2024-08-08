@extends('layout.layout')

<?php

use App\Models\User;
use App\Models\Product;
use App\Models\ProductImage;

$user = User::findorFail($order->user_id);


?>


@section('content')
<div class="w-full flex flex-col gap-10 justify-center items-center my-20">

    
    <div class="border border-slate-500 p-5">
        <h4 class="font-bold">Customer Information</h4>
    <p>Name: {{$user->name}}</p>
    <p>Email: {{$user->email}}</p>
    <p>Phone: {{$user->phone}}</p>
    <p>Address: {{$user->address}}</p>
</div>

@foreach($order->products as $item)
<?php

$product = Product::find($item['id']);
$image = ProductImage::where('product_id', $product->id)->get();


?>

<div class="border border-slate-500 p-5">
    <h4 class="font-bold">Product Information</h4>
    <div class="w-full flex justify-center items-center my-5">

        <img src="/{{$image[0]->image}}" alt={{$product->name}} class="w-32 h-32">
    </div>
    <p>
        Name: {{$product->name}}
        </p>
        <p>Price: {{$product->price}}</p>
        <p> Quantity: {{$item['quantity']}}</p>
</div>

@endforeach
@if($order->status === 'pending')
<form action="{{route('orders.delete', $order->id)}}" method="POST">
    @csrf
    <x-primary-button>
        Complete Order
    </x-primary-button>
</form>
@else
<p class="text-green-500 font-bold">Order is completed</p>
@endif

</div>
@endsection