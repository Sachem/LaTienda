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
      {!! Form::label('discounted_price', 'Price discounted') !!}
      {!! Form::text('discounted_price', null, ['class' => 'form-control']) !!}
    </div>

<!--
    <div class="form-group">
      {!! Form::label('sku', 'SKU') !!}
      {!! Form::text('sku', null, ['class' => 'form-control']) !!}
    </div>
 --> 
    <div class="form-group">
      {!! Form::label('active', 'Active') !!}
      {!! Form::checkbox('active', 1, null, ['class' => 'form-control']) !!}
    </div>
 
 
    {!! Form::hidden('category_id', 1) !!}
    
    <div class="form-group">
      {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
    </div>