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
  
  @include('catalog.basket.partials.add_button')
  
  @include('catalog.basket.partials.add_button_script')

  
@stop
