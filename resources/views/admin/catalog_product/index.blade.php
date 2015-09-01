@extends('app')

@section('content')
  <a href="{{ url('/admin/catalog/product/create') }}">Add Product</a>
  <h1>Products</h1>
  <ul>
    @foreach ($products as $product)
    <li><a href='{{ url('/admin/catalog/product/'.$page->id.'/edit') }}'>{{ $product->name }}</a></li>
    @endforeach
  </ul>
@stop
