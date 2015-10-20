
@include('errors.validation')

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
 <!--
    <div class="form-group">
       {!! Form::label('Product Image') !!}
       {!! Form::file('image', null) !!}
    </div>
 -->
    <div class="form-group">
        {!! Form::label('category_id', 'Product Category') !!}
        @include('admin.partials.tree', ['list' => $category_tree, 'category_edit' => true, 'parent_id' => null, 'product_edit' => true])
    </div> 

    
    <div class="form-group">
      {!! Form::submit($submitButtonText, ['class' => 'btn btn-primary form-control']) !!}
    </div>
 
 
 @section('footer')

  <script src="//tinymce.cachefly.net/4.2/tinymce.min.js"></script>
  <script>tinymce.init({selector:'textarea'});</script>

@stop