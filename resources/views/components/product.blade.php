

<div class="group relative">
      <a href="/products/{{$id}}">
        <div class="aspect-square w-full overflow-hidden rounded-md bg-gray-200 group-hover:opacity-75 lg:h-80 relative">
          <img
            src="/{{$image}}"
            alt="{{$name}}"
            class="w-full h-full lg:h-full lg:w-full"
            
          />
          <div class="absolute top-2 right-2 p-2 text-white bg-black text-sm font-semibold">
            In-Stock ({{$quantity}})
          </div>
        </div>
        <div class="mt-4 flex justify-between">
          <div>
            <h3 class="text-sm font-bold capitalize">{{$name}}</h3>
            <p class="mt-1 text-sm font-extralight">
              {{$category}}
            </p>
          </div>
          <p class="text-sm font-medium">{{$price}}</p>
        </div>
      </a>
    </div>