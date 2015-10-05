@extends('app')

@section('content')

  <a href='javascript: window.history.go(-1)'>&laquo; back</a>

  <h1>Customer Details</h1>


    <h2>Your personal data</h2> 
    
      {!! Form::open(['method' => 'POST', 'action' => ['Account\CustomerDetailsController@postUpdateDetails'], 'class' => "form-horizontal"]) !!}

        <div class="form-group">
          <label class="col-md-4 control-label">Name</label>
          <div class="col-md-6">
            <input type="text" class="form-control" name="username" value="{{ $user_details['username'] }}">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">E-Mail Address</label>
          <div class="col-md-6">
            <input type="email" class="form-control" name="email" value="{{ $user_details['email'] }}">
          </div>
        </div>
    
        <div class="form-group form-group-btn-primary">
          {!! Form::submit("Update Details", ['class' => 'btn btn-primary form-control']) !!}
        </div>
          
      {!! Form::close() !!}  
        
    <hr />

    <h2>Your password</h2> 
    
      {!! Form::open(['method' => 'POST', 'action' => ['Account\CustomerDetailsController@postChangePassword'], 'class' => "form-horizontal"]) !!}

        <div class="form-group">
          <label class="col-md-4 control-label">Old Password</label>
          <div class="col-md-6">
            <input type="password" class="form-control" name="old_password">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">New Password</label>
          <div class="col-md-6">
            <input type="password" class="form-control" name="password">
          </div>
        </div>

        <div class="form-group">
          <label class="col-md-4 control-label">Confirm New Password</label>
          <div class="col-md-6">
            <input type="password" class="form-control" name="password_confirmation">
          </div>
        </div>
    
        <div class="form-group form-group-btn-primary">
          {!! Form::submit("Change Password", ['class' => 'btn btn-primary form-control']) !!}
        </div>
          
      {!! Form::close() !!}  
        
    <hr />

    <h2>Your address</h2> 

      {!! Form::model($user_address, ['method' => 'POST', 'action' => ['Account\CustomerDetailsController@postUpdateAddress']]) !!}

        @include('partials.address_form')

        <div class="form-group">
          {!! Form::submit("Update Address", ['class' => 'btn btn-primary form-control']) !!}
        </div>

      {!! Form::close() !!}
      

@stop