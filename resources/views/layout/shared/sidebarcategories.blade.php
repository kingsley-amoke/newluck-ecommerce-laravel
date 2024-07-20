<?php

use App\Models\Category;

$categories = Category::tree()->get()->toTree();

?>


<div class="w-full flex flex-col gap-10 px-4 pt-5  border-t-2">
    @foreach($categories as $item)
    <x-nav-items :category="$item" />
    @endforeach
</div>