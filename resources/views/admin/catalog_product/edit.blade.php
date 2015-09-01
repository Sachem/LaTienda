@extends('app')

@section('content')

  <a href='{{ url('/admin/catalog/product') }}'>&laquo; back</a>

  <h1>Edit Product: {{ $product->title }}</h1>

  <hr />
  
  {!! Form::model($product, ['method' => 'PATCH', 'action' => ['Admin\CatalogProductController@update', $product->id]]) !!}
  
    
    @include('admin.catalog_product.form', ['submitButtonText' => 'Update Product'])

    
  {!! Form::close() !!}
  
  @include('errors.validation')
  
@stop

