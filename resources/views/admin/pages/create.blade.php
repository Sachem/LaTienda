@extends('app')

@section('content')

  <a href='{{ url('/admin/page') }}'>&laquo; back</a>

  <h1>Create New Page</h1>

  <hr />
  
  {!! Form::open(['url' => 'admin/page']) !!}
  
    
    @include('admin.pages.form', ['submitButtonText' => 'Add Page'])

    
  {!! Form::close() !!}
  
@stop

