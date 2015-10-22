@extends('app')

@section('content')
  
  <h1>Search results for: {{ $keyword }}</h1>
  
  <ul>
    
      @each('catalog.partials.product_on_list', $products, 'product', 'catalog.partials.empty')
    
  </ul>
  
 {!! $products->appends(['keyword' => $keyword])->render() !!}
  
@stop
