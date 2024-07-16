<?php

use App\Models\Category;

$categories = Category::all();

?>


<div class="w-full flex flex-col gap-10 px-4 pt-5  border-t-2">
    @foreach($categories as $item)
    <a href="{{route('categories.show', $item->id)}}">
        <h3 class="font-bold">{{$item->name}}</h3>
    </a>
    @endforeach
</div>