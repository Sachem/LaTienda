@extends('app')

@section('content')

  <a href='{{ url('/admin/catalog/category') }}'>&laquo; back</a>

  <h1>Edit Category: {{ $category->title }}</h1>

  <hr />
  
  {!! Form::model($category, ['method' => 'PATCH', 'action' => ['Admin\CatalogCategoryController@update', $category->id]]) !!}
  
    
    @include('admin.catalog_category.form', ['submitButtonText' => 'Update Category', 'parent_id' => $category->parent_id])

    
  {!! Form::close() !!}
  
  @include('errors.validation')
  
@stop

