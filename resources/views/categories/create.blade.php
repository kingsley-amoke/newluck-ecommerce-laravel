<?php

use App\Models\Category;

$categories = Category::whereNull('parent_id')->get();

?>

@extends('layout.layout')

@section('content')
<div class="w-full flex flex-col justify-center items-center my-20">
    <h3 class="font-bold text-2xl my-5">Add Category</h3>
    <form action="{{route('categories.create')}}" method="POST" enctype="multipart/form-data" class="flex flex-col gap-5 border border-slate-500 p-5">
        @csrf
        <label for="name" class="font-bold">
            Category Name
        </label>
        <input type="text" name="name" id="name" class="outline-none border border-slate-500 rounded-md text-black p-2">
        <label for="slug" class="font-bold">Slug</label>
        <input name="slug" id="slug" class="outline-none border border-slate-500 rounded-md text-black p-2">
        <label for="parent_id" class="font-bold">Choose Parent</label>
        <select name="parent_id" id="parent_id" class="outline-none border border-slate-500 rounded-md text-black p-2">
            @foreach($categories as $category)
                <option value="{{$category->id}}">{{$category->name}}</option>
            @endforeach
        </select>
        <label for="image" class="font-bold">Cover Image</label>
        <input type="file" name="image" id="image">
        <input type="submit" value="Upload" class="border border-slate-400 bg-blue-500 hover:bg-blue-700 uppercase px-3 py-2 font-bold rounded-sm text-white">
    </form>
</div>
@endsection