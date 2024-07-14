
@extends('layout.layout')



@section('content')
    

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex flex-col md:flex-row flex-wrap gap-5">
                    <x-primary-button>
                       <a href="{{route('products.create')}}">
                        Add Product
                        </a>
                    </x-primary-button>
                    <x-primary-button>
                        <a href="{{route('categories.create')}}">
                            Add New Category
                            </a>
                    </x-primary-button>
                    <x-primary-button>
                        <a href="{{route('orders.index')}}">
                            See Orders
                            </a>
                    </x-primary-button>
                    
                </div>
            </div>
        </div>
    </div>
@endsection
