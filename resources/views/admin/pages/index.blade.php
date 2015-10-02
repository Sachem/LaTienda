@extends('app')

@section('content')
  <a href="{{ url('/admin/page/create') }}">Create New Page</a>
  <h1>Pages</h1>
  <ul>
    @foreach ($pages as $page)
    <li><a href='{{ url('/admin/page/'.$page->id.'/edit') }}'>{{ $page->title }}</a></li>
    @endforeach
  </ul>
@stop
