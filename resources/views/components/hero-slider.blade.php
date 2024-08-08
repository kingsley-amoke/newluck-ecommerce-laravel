
@props(["images"])


@foreach($images as $image)

<div>
  <img src="{{$image}}" alt="...">
</div>

@endforeach