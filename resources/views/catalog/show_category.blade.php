@extends('app')

@section('content')
  
  <h1>Category: {{ $category->name }}</h1>
  
  <ul>
    
      @each('catalog.partials.product_on_list', $products, 'product', 'catalog.partials.empty')
    
  </ul>
  
  @include('partials.pagination', ['paginator' => $products])
  
@stop
