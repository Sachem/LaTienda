<input type="button" value="Add To Basket" id="add-to-basket" />

<script>
  $('#add-to-basket').click(function(){
    
    $.post('{{ URL::to('basket/addItem') }}' , {product_id: {{ $product->id }}}, function(data) {
     
      if (data == 'success')
      {
        alert('Product added to basket.');
      }
      else
      {
        alert('There was a problem adding to basket!');
      }

    });
    
  });
</script>
  