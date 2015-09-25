@extends('app')

@section('content')

  <a href='{{ url('/admin/catalog/category') }}'>&laquo; back</a>

  <h1>Add New Category</h1> 

  <hr />
  
  {!! Form::open(['url' => 'admin/catalog/category']) !!}
  
    
    @include('admin.catalog_category.form', ['submitButtonText' => 'Add Category', 'parent_id' => null])

    
  {!! Form::close() !!}
  
@stop

