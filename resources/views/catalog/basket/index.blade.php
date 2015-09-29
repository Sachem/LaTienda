@extends('app')

@section('content')
  <a href='javascript: window.history.go(-1)'>&laquo; back</a>
  <h1>Your Basket</h1>
  
  <div class="basket-items">
      
    @foreach ($items as $item)
    
      @include('catalog.basket.partials.item')
      
    @endforeach
    
  </div>  
  
@stop
