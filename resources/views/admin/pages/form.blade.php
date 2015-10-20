

@include('errors.validation')

    <div class="form-group">
      {!! Form::label('title', 'Title') !!}
      {!! Form::text('title', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
      {!! Form::label('path', 'URL') !!}
      {!! Form::text('path', null, ['class' => 'form-control']) !!}
    </div>
  
    <div class="form-group">
      {!! Form::label('content', 'Content') !!}
      {!! Form::textarea('content', null, ['class' => 'form-control']) !!}
    </div>
  
    <div class="form-group">
      {!! Form::label('meta_description', 'Meta Description') !!}
      {!! Form::text('meta_description', null, ['class' => 'form-control']) !!}
    </div>
  
    <div class="form-group">
      {!! Form::label('contact_form', 'Include Contact Form') !!}
      {!! Form::checkbox('contact_form', 1, null, ['class' => 'form-control']) !!}
    </div>
  
    <div class="form-group">
      {!! Form::label('visible', 'Visible') !!}
      {!! Form::checkbox('visible', 1, null, ['class' => 'form-control']) !!}
    </div>
    
    <div class="form-group">
      {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
    </div>

@section('footer')

  <script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
  <script>tinymce.init({selector:'textarea'});</script>

@stop