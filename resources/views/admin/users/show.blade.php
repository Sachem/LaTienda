@extends('app')

@section('content')

  <a href='javascript: window.history.go(-1)'>&laquo; back</a>

  <h1>User #{{ $user->id }}</h1>

    <h2>User Details</h2> 

      @include('partials.user_display', ['user' => $user])
      
    
    <h2>User default address</h2> 
 
    @if (! $user->addresses->isEmpty())
    
      @include('partials.address_display', ['address' => $user->addresses[0]])
   
    @else
      
      No address added
      
    @endif
     
@stop