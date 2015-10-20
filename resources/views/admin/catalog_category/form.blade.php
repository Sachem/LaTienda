
@include('errors.validation')

    <div class="form-group">
      {!! Form::label('name', 'Name') !!}
      {!! Form::text('name', null, ['class' => 'form-control']) !!}
    </div>

    <div class="form-group">
        {!! Form::label('parent_id', 'Parent Category') !!}
        @include('admin.partials.tree', ['list' => $category_tree, 'category_edit' => true, 'product_edit' => false])
    </div>    
        
    <div class="form-group">
      {!! Form::label('active', 'Active') !!}
      {!! Form::checkbox('active', 1, null, ['class' => 'form-control']) !!}
    </div>
    
    <div class="form-group">
      {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
    </div>