

<div class="group relative">
      <a href="/products/{{$id}}">
        <div class="aspect-square w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:h-auto relative">
          <img
            src="/{{$image}}"
            alt="{{$name}}"
            class="w-full h-full lg:h-full lg:w-full"
            
          />
          <div class="absolute top-2 right-2 p-2 text-sm font-semibold">
            @if($quantity > 0)
            <p class="text-white bg-black ">

              In-Stock ({{$quantity}})
            </p>
                          
            @else
            <p class="text-red-600 font-bold bg-gray-100">
              Out-Of-Stock

            </p>
            @endif
          </div>
        </div>
        <div class="mt-4 flex justify-between gap-2">
          <div>
            <h3 class="text-[0.7rem] font-bold capitalize">{{$name}}</h3>
            <p class="mt-1 text-sm font-extralight">
              {{$category}}
            </p>
          </div>
          <p class="text-[0.6rem] font-medium ">{{$price}}</p>
        </div>
      </a>
    </div>