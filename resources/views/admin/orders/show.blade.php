@extends('app')

@section('content')

  <a href='javascript: window.history.go(-1)'>&laquo; back</a>

  <h1>Order #{{ $order->id }}</h1>

    <h2>Order Details</h2> 

      <div class="address-display-group">
          <label>Order created</label>
          <span>{{ $order->created_at }}</span>
      </div>

      <div class="address-display-group">
        <label>Payment status</label>
        <span>{{ $order->payment->status }}</span>
    </div>
      
    <hr />      

    <h2>Client Details</h2> 

      @include('partials.user_display', ['user' => $order->user])
      
    <hr />      
    
    <h2>Ordered Items</h2> 

      <div class="basket-items">

        @each('catalog.order.partials.order_item', $order->items, 'item')

      </div>
    
      <div class="clear"></div>

      <h3>Total: £{{ $order->payment->total }}</h3>
    
    <hr />
    
    <h2>Delivery address</h2> 
 
      @include('partials.address_display', ['address' => $order->delivery_address])
     
@stop