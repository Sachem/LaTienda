@extends('app')

@section('content')
  
  <h1>Product: {{ $product->name }}</h1>
  
  <div class="product-description">
    {!! $product->description !!}
  </div>
  
  @foreach ($images as $image)

  <div class="thumbnail" style="background-image: url('/images/catalog/{{ $image->id }}.{{ $image->extension }}')"></div>

  @endforeach
  
  <div class="clear"></div>
  
  <h2 class="price">Price: {{ $product->price }}</h2>
  
  @include('catalog.basket.partials.add_button')

  
@stop
