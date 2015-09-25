@extends('app')

@section('content')

  <a href='{{ url('/admin/catalog/product') }}'>&laquo; back</a>

  <h1>Edit Product: {{ $product->title }}</h1>

  <hr />
  
  {!! Form::model($product, ['method' => 'PATCH', 'action' => ['Admin\CatalogProductController@update', $product->id], 'files' => true]) !!}
  
    
    @include('admin.catalog_product.form', ['submitButtonText' => 'Update Product', 'checked_id' => $product->category_id])

    
  {!! Form::close() !!}
  
  <h2>Upload Product Images</h2>
  
  
  {!! Form::open(['url' => 'admin/catalog/dropzoneUpload', 'class' => 'dropzone', 'id' => "my-dropzone"]) !!}
  
    <!--<div class="fallback">
      <input name="file" type="file" multiple />
    </div>-->
  
  {!! Form::close() !!}
  
  <script>
    <!-- 3 -->
    Dropzone.options.myDropzone = {
        addRemoveLinks: true ,
        init: function() {
            thisDropzone = this;
            <!-- 4 -->
            $.get('{{ URL::to('admin/catalog/dropzoneGet') }}' , function(data) {

                <!-- 5 -->
                $.each(data, function(key,value){
/*
                    var mockFile = { name: value.name, size: value.size };

                    thisDropzone.options.addedfile.call(thisDropzone, mockFile);

                    thisDropzone.options.thumbnail.call(thisDropzone, mockFile, '/images/catalog/'+value.name);
*/

                    var file = { serverId: value.name, size: value.size };

                    thisDropzone.options.addedfile.call(thisDropzone, file);

                    thisDropzone.options.thumbnail.call(thisDropzone, file, '/images/catalog/'+value.name);
                });

            });
        
        
            this.on("success", function(file, response) {
              file.serverId = response; 
            });

            this.on("removedfile", function(file) {
              if (!file.serverId) { return; }
              $.post('{{ URL::to('admin/catalog/dropzoneRemove') }}'+"?id=" + file.serverId); 
            });	
        }
    };
  </script>

  
  @include('errors.validation')
  
@stop

