@extends('app')

@section('content')

  <a href='javascript: window.history.go(-1)'>&laquo; back</a>

  <h1>Checkout - Step 1/2</h1>

    <h2>Items in your basket</h2> 

      <div class="basket-items">

        @each('catalog.order.partials.order_item', $items, 'item')

      </div>
    
      <div class="clear"></div>

      <h3>Total: £{{ $basket_total }}</h3>
    
    <hr />
    
    <h2>Delivery address</h2> 

    {!! Form::model($delivery_address, ['method' => 'POST', 'url' => 'checkout/confirmation']) !!}
    
      @include('partials.address_form')
      
      <div class="form-group">
        {!! Form::submit("Proceed To Payment &raquo;", ['class' => 'btn btn-primary form-control']) !!}
      </div>
      
    {!! Form::close() !!}
      


@stop