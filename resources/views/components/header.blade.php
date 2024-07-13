<?php

use App\Models\Category;

$categories = Category::all();


    ?>



<div class="flex items-center justify-between mx-auto max-w-2xl px-4 sm:px-6 lg:max-w-7xl my-5 ">
        <x-application-logo />

        <nav class="hidden gap-12 lg:flex 2xl:ml-16">
          @foreach($categories as $item)
            <a href="/categories/{{$item->id}}" class="capitalize">{{$item->name}}</a>
          @endforeach
        </nav>

        <div class="flex justify-center items-center gap-5" id="cart">

            @include('layout.shared.search')
          


              <i class="fa-regular fa-user"></i>
          

        <a href="#">

         
              <i class="fa-solid fa-cart-shopping"></i>
         
        </a>
        <!-- <x-button title="Clicl here" to="/pizzas"/> -->
        </div>
      </div>