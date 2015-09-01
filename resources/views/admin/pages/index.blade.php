@extends('app')

@section('content')
  <h1>Pages</h1>
  <ul>
    @foreach ($pages as $page)
    <li><a href='{{ url('/admin/page/'.$page->id.'/edit') }}'>{{ $page->title }}</a></li>
    @endforeach
  </ul>
@stop
