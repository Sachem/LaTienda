@extends('app')

@section('content')
  
  <h1>Category: {{ $category->name }}</h1>
  
  <ul>
    @foreach ($products as $product)
    <li><a href='{{ url('product/'.$product->id) }}'>{{ $product->name }}</a></li>
    @endforeach
  </ul>
  
@stop
