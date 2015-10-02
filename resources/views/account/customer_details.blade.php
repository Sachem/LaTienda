@extends('app')

@section('content')

  <a href='javascript: window.history.go(-1)'>&laquo; back</a>

  <h1>Customer Details</h1>

  <!--
    <h2>Your personal data</h2> 
    
      {!! Form::model($user_address, ['method' => 'POST', 'action' => ['Account\CustomerDetailsController@postUpdateDetails'], 'class' => "form-horizontal"]) !!}

        @include('partials.register_form')
    
        <div class="form-group form-group-btn-primary">
          {!! Form::submit("Update Details", ['class' => 'btn btn-primary form-control']) !!}
        </div>
          
      {!! Form::close() !!}  
        
    <hr />
  --> 
    <h2>Your address</h2> 

      {!! Form::model($user_address, ['method' => 'POST', 'action' => ['Account\CustomerDetailsController@postUpdateAddress']]) !!}

        @include('partials.address_form')

        <div class="form-group">
          {!! Form::submit("Update Address", ['class' => 'btn btn-primary form-control']) !!}
        </div>

      {!! Form::close() !!}
      

@stop