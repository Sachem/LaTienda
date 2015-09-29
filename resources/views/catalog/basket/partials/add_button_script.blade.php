<script>
  $('.add-to-basket-button').click(function(){
    
    $product_id = $(this).parent().find('.basket-item-id').val();
    
    $.post('{{ URL::to('basket/add-item') }}' , {product_id: $product_id}, function(data) {
     
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