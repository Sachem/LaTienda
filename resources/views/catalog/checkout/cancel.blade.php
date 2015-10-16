@extends('app')

@section('content')

  <h1>Checkout - Payment Cancelled</h1>

  We are sorry you didn't finish your payment. You can still go to <a href="{{ url('account/orders') }}">Your Orders</a> to complete your payment.

@stop