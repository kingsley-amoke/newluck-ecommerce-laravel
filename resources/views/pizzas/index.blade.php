@extends('layout.layout')


@section('content')

@foreach($pizzas as $pizza)
<p class="text-center">
    {{$pizza->name}} - {{$pizza->base}} - {{$pizza->type}}
</p>
@endforeach

@endsection