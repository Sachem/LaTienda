@extends('app')

@section('content')
  
  <h1>Category: {{ $category->name }}</h1>
  
  <ul>
    @foreach ($products as $product)
    <li>
        <a href='{{ url('product/'.$product->id.'/'.str_slug($product->name)) }}'>{{ $product->name }}</a>
         @include('catalog.basket.partials.add_button')
  
    </li>
    @endforeach
  </ul>
  
  @include('partials.pagination', ['paginator' => $products])
  
  @include('catalog.basket.partials.add_button_script')
  
@stop
