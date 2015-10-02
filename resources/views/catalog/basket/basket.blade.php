@extends('app')

@section('content')
  
  <a href='javascript: window.history.go(-1)'>&laquo; back</a>
  
  <h1>Your Basket</h1>
  
    <div class="basket-items">

      @each('catalog.basket.partials.item', $items, 'item', 'catalog.basket.partials.empty')

    </div>  

    <div class="clear"></div>

    

    @unless ($items->isEmpty())
    
    <h3>Total: <span id="basket_total">£{{ $basket_total }}</span></h3>

    <div class="clear">
      <a class="btn btn-primary form-control" href="checkout">Proceed To Checkout &raquo;</a>
    </div>

    @endunless
  
@stop
