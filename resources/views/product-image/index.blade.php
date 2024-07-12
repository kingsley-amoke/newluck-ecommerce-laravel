@extends('layout.layout')

@section('content')
<section class="w-full h-2/3 flex flex-col gap-5 justify-center items-center my-20 mx-5">
    <div>

        @if (session('status'))
        <div class="text-green-500 font-bold font-serif">{{session('status')}}</div>
        @endif
        @if (session('success'))
        <div class="text-green-500 font-bold font-serif">{{session('success')}}</div>
        @endif
        
        <div>
            <div class="flex justify-between items-center mb-10">
                <h3 class="font-bold text-2xl">Upload Product Images
                </h3>


                <x-button title="Back" to="/products/{{$product->id}}" />
            </div>
            <div class="bg-grey-300 border border-slate-300 py-5 px-2">


                <h5 class="text-center uppercase my-5 font-bold">Product Name: {{ $product->name }}</h5>
                <hr>

                @if ($errors->any())
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{$error}}</li>
                    @endforeach
                </ul>
                @endif

                <form action="{{ url('products/'.$product->id.'/upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf

                    <div class="m-10">
                        <label class="text-end text-sm">(Max - 5 images only)</label><br />
                        <input type="file" name="images[]" multiple class="form-control" />
                    </div>
                    <div class="my-3 flex justify-end">
                        <button type="submit" class="border border-slate-400 bg-blue-500 hover:bg-blue-700 uppercase px-3 py-2 font-bold rounded-sm ">Upload</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

    <div class="flex">
        @foreach ($productImages as $prodImg)
        <div class="flex flex-col justify-center items-center">

            <img src="{{ asset($prodImg->image) }}" class=" p-2 m-3 contain-size w-32 h-32" alt="Img" />
            <a href="{{ url('product-image/'.$prodImg->id.'/delete') }}" class="text-center font-bold">Delete</a>
        </div>
        @endforeach
    </div>

</section>
@endsection