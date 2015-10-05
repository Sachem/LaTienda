@extends('app')

@section('content')

  <!--<a href='javascript: window.history.go(-1)'>&laquo; back</a>-->

  <h1>Checkout - Step 2/2</h1>

    <h2>Ordered Items</h2> 

      <div class="basket-items">

        @each('catalog.checkout.partials.order_item', $items, 'item')

      </div>
    
      <div class="clear"></div>

      <h3>Total: £{{ $order_total }}</h3>
    
    <hr />
    
    <h2>Delivery address</h2> 
 
      @include('partials.address_display', ['address' => $delivery_address])
   
      


@stop