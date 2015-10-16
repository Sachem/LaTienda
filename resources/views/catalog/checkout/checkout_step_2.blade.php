@extends('app')

@section('content')

  <!--<a href='javascript: window.history.go(-1)'>&laquo; back</a>-->

  <h1>Checkout - Step 2/2</h1>

    <h2>Ordered Items</h2> 

      <div class="basket-items">

        @each('catalog.order.partials.order_item', $items, 'item')

      </div>
    
      <div class="clear"></div>

      <h3>Total: £{{ $order_total }}</h3>
    
    <hr />
    
    <h2>Delivery address</h2> 
 
      @include('partials.address_display', ['address' => $delivery_address])
   
      
    <h2>Payment</h2>
    
      <a href="{{ url('paypal/checkout/' . $order_id) }}"><img src="data:image/png;base64,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" alt="Paypal - Pay Now" /></a>

@stop