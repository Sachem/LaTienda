@extends('app')

@section('content')
  <a href="{{ url('/admin/catalog/category/create') }}">Add Category</a>
  <h1>Categories</h1>
  
  @include('admin.partials.tree', ['list' => $category_tree, 'category_edit' => false])
  
@stop
