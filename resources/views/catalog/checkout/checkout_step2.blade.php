@extends('app')

@section('content')

  <a href='javascript: window.history.go(-1)'>&laquo; back</a>

  <h1>Checkout - Step 2/2</h1>

    <h2>Chosen Items</h2> 

      <div class="basket-items">

        @each('catalog.checkout.partials.basket_item', $items, 'item')

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