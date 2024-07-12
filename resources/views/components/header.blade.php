<?php

use App\Models\Category;

$categories = Category::all()

    ?>

<div class="flex items-center justify-between mx-auto max-w-2xl px-4 sm:px-6 lg:max-w-7xl my-5 ">
        <a href='/'>
          <h1 class="text-3xl md:text-5xl font-extrabold font-mono text-blue-400">
            New<span class="text-red-600 font-serif font-thin text-xl">
              Luck
            </span>
          </h1>
        </a>

        <nav class="hidden gap-12 lg:flex 2xl:ml-16">
          @foreach($categories as $item)
            <a href="/categories/{{$item->id}}" class="capitalize">{{$item->name}}</a>
          @endforeach
        </nav>

        <div class="flex justify-center items-center gap-5">

        <a href="#">
            <i class="fa-solid fa-search"></i>
          
        </a>

        <a href="#">

            <i class="fa-regular fa-user"></i>

        </a>

        <a href="#">


            <i class="fa-solid fa-cart-shopping"></i>
        </a>
        <!-- <x-button title="Clicl here" to="/pizzas"/> -->
        </div>
      </div>