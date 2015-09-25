@extends('app')

@section('content')

  <a href='{{ url('/admin/catalog/product') }}'>&laquo; back</a>

  <h1>Add New Product</h1>

  <hr />
  
  {!! Form::open(['url' => 'admin/catalog/product', 'files' => true]) !!}
  
    
    @include('admin.catalog_product.form', ['submitButtonText' => 'Add Product', 'checked_id' => null])

    
  {!! Form::close() !!}
  
@stop

