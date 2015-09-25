@extends('app')

@section('content')

  <a href='{{ url('/admin/catalog/category') }}'>&laquo; back</a>

  <h1>Delete Category: {{ $category->name }}</h1>

  <hr />
  
  Are you sure you want to delete this category?
  
  <br />
  <br />
  
  {!! Form::model($category, ['method' => 'DELETE', 'action' => ['Admin\CatalogCategoryController@destroy', $category->id]]) !!}
      
    <div class="form-group">
      {!! Form::submit('Yes, delete it!', ['class' => 'btn btn-primary form-control']) !!}
    </div>
    
  {!! Form::close() !!}
  
@stop

