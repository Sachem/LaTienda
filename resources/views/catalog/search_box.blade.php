@extends('app')

@section('content')
  
  <h1>Search for products</h1>
  
  {!! Form::open(['method' => 'GET', 'url' => 'search-result']) !!}
  
    <div class="form-group">
      {!! Form::label('keyword', 'Keyword') !!}
      {!! Form::text('keyword', null, ['class' => 'form-control']) !!}
    </div>
  
    
    <div class="form-group">
      {!! Form::submit('Search', ['class' => 'btn btn-primary form-control']) !!}
    </div>
  
  {!! Form::close() !!}
@stop
