@props(['category'])

<x-dropdown align="right" width="48">
    <x-slot name="trigger">
      
        <button>
            {{$category->name }}

            <i class="fa fa-caret-down"></i></button>

        
    </x-slot>

    <x-slot name="content">
       <div>
        <x-nav-link :href="route('categories.show', $category->id)" :active="request()->routeIs('categories.show', $category->id)" class="capitalize">
            {{$category->name }}
        </x-nav-link>
       </div>
        @foreach($category->children as $child)
        <div>
            <x-nav-link :href="route('categories.show', $child->id)" :active="request()->routeIs('categories.show', $child->id)" class="capitalize">
                {{$child->name }}
            </x-nav-link>
        </div>
   @endforeach

    </x-slot>

</x-dropdown>