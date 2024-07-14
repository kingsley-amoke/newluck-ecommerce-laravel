@extends('layout.layout')

<?php

use App\Models\User;
use App\Models\Product;

$user = User::findorFail($order->user_id);


?>


@section('content')

<div>
    <p>{{$user->id}}</p>
</div>

@foreach($order->products as $item)
<?php

$product = Product::find($item['id'])

?>

<div>
    {{$product->name}}
</div>
<p>{{$item['quantity']}}</p>
@endforeach

@endsection