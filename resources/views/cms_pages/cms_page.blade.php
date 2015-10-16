@extends('app')

@section('content')
  <div id='cms_content'>
    {!! $content !!}
    
    @if ($contact_form == 1)
    
      @include('partials.contact_form')
    
    @endif
  </div>
@stop
