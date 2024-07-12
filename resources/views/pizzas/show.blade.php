@extends('layout.layout')


@section('content')
<p>{{$pizza -> name}}</p>

@foreach($pizza->toppings as $topping)
    <p>{{$topping}}</p>
@endforeach
@endsection