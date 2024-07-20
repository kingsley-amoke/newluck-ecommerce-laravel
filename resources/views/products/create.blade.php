

@extends('layout.layout')

@section('content')
<div class="w-full flex flex-col justify-center items-center my-20 mx-2">
    <h3 class="font-bold text-2xl my-5">Add Product</h3>
    <form action="/products/create" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5 border border-slate-500 p-5 w-full md:w-1/2 lg:w-1/3">
        @csrf
        <label for="name" class="font-bold">
            Product Name
        </label>
        <input type="text" name="name" id="name" class="outline-none border border-slate-500 rounded-md text-black p-2">
        <label for="description" class="font-bold">Description</label>
        <textarea name="description" id="description" class="outline-none border border-slate-500 rounded-md text-black p-2"></textarea>
        <label for="slug" class="font-bold">Slug</label>
        <input name="slug" id="slug" class="outline-none border border-slate-500 rounded-md text-black p-2">
        <label for="price" class="font-bold">Price</label>
        <input type="number" name="price" id="price" class="outline-none border border-slate-500 rounded-md text-black p-2">
        <label for="quantity" class="font-bold">Quantity</label>
        <input type="number" name="quantity" id="quantity" class="outline-none border border-slate-500 rounded-md text-black p-2">
        <select name="category" class="outline-none border border-slate-500 rounded-md text-black p-2 capitalize">
           

            @foreach($categories as $category)
                <option value="{{$category->name}}" class="capitalize">{{$category->name}}</option>

            @endforeach
            
        </select>
        <input type="submit" value="Upload" class="border border-slate-400 bg-blue-500 hover:bg-blue-700 uppercase px-3 py-2 font-bold rounded-sm text-white">
    </form>
</div>
@endsection