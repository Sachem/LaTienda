    <div class="form-group">
      {!! Form::label('name', 'Name') !!}
      {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>
  
    <div class="form-group">
      {!! Form::label('description', 'Description') !!}
      {!! Form::textarea('description', null, ['class' => 'form-control']) !!}
    </div>
  
    <div class="form-group">
      {!! Form::label('price', 'Price') !!}
      {!! Form::text('price', null, ['class' => 'form-control']) !!}
    </div>
  
    <div class="form-group">
      {!! Form::label('price_discounted', 'Price discounted') !!}
      {!! Form::text('price_discounted', null, ['class' => 'form-control']) !!}
    </div>

<!--
    <div class="form-group">
      {!! Form::label('sku', 'SKU') !!}
      {!! Form::text('sku', null, ['class' => 'form-control']) !!}
    </div>
 --> 
    <div class="form-group">
      {!! Form::label('visible', 'Visible') !!}
      {!! Form::checkbox('visible', 1, null, ['class' => 'form-control']) !!}
    </div>
    
    <div class="form-group">
      {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
    </div>