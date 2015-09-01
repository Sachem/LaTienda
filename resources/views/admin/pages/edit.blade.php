@extends('app')

@section('content')

  <a href='{{ url('/admin/page') }}'>&laquo; back</a>

  <h1>Edit Page: {{ $page->title }}</h1>

  <hr />
  
  {!! Form::model($page, ['method' => 'PATCH', 'action' => ['Admin\PagesController@update', $page->id]]) !!}
  
    
    @include('admin.pages.form', ['submitButtonText' => 'Update Page'])

    
  {!! Form::close() !!}
  
  @include('errors.validation')
  
@stop

