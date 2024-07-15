@extends('layout.layout')

<?php

use App\Models\User;
use App\Models\Product;

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

$product = Product::find($item['id'])

?>

<div class="border border-slate-500 p-5">
    <h4 class="font-bold">Product Infofrmation</h4>
    <p>
        Name: {{$product->name}}
        </p>
        <p>Price: {{$product->price}}</p>
        <p> Quantity: {{$item['quantity']}}</p>
</div>

@endforeach
<form action="{{route('orders.delete', $order->id)}}" method="POST">
    @csrf
    <x-primary-button>
        Complete Order
    </x-primary-button>
</form>

</div>
@endsection