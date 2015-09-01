@extends('app')

@section('content')

  <a href='{{ url('/admin/catalog/product') }}'>&laquo; back</a>

  <h1>Add New Product</h1>

  <hr />
  
  {!! Form::open(['url' => 'admin/catalog/product']) !!}
  
    
    @include('admin.catalog_product.form', ['submitButtonText' => 'Add Product']);

    
  {!! Form::close() !!}
  
@stop

