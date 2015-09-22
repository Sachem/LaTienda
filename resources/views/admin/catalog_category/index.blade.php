@extends('app')

@section('content')
  <a href="{{ url('/admin/catalog/category/create') }}">Add Category</a>
  <h1>Categories</h1>
  
  <!--<ul>
    @foreach ($categories as $category)
    <li><a href='{{ url('/admin/catalog/category/'.$category->id.'/edit') }}'>{{ $category->name }}</a></li>
    @endforeach
  </ul>-->
  
  @include('admin.partials.tree', ['list' => $category_tree, 'category_edit' => false])
  
@stop
