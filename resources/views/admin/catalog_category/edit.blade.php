@extends('app')

@section('content')

  <a href='{{ url('/admin/catalog/category') }}'>&laquo; back</a>

  <h1>Edit Category: {{ $category->name }}</h1>

  <hr />
  
  {!! Form::model($category, ['method' => 'PATCH', 'action' => ['Admin\CatalogCategoryController@update', $category->id]]) !!}
  
    
    @include('admin.catalog_category.form', ['submitButtonText' => 'Update Category', 'checked_id' => $category->parent_id])

    
  {!! Form::close() !!}
  
@stop

