    
$(document).ready(function(){   
  
    /**
     * Add to basket button
     * 
     * @returns alert
     */
    $('.add-to-basket-button').click(function(){

      $product_id = $(this).parent().find('.basket-item-id').val();

      $.post(location.protocol + "//" + location.host + '/basket/add-item' , {product_id: $product_id}, function(data) {

        if (data == 'success')
        {
          swal("OK", "Product added to basket.", "success");
        }
        else
        {
          swal("Error", "There was a problem adding to basket.", "error");
        }

      });

    });

    /**
     * Remove from basket
     * 
     * @returns alert
     */
    $('.remove-from-basket-button').click(function(){
      
      $parent = $(this).parent();
      $item_id = $parent.find('.basket-item-id').val();
      
      $.post(location.protocol + "//" + location.host + '/basket/remove-item' , {item_id: $item_id}, function(data) {

        if (data['result'] == 'success')
        {
          $parent.parent().css('display','none');
          $('#basket_total').html(data['basket_total']);  
          
          swal("OK", "Product removed from basket.", "success");
        }
        else
        {
          swal("Error", "There was a problem removing this product from basket.", "error");          
        }

      });
      
    });
    
    /**
     * Change basket item quantity
     * 
     * @returns alert
     */
    $('.update-basket-quantity-button').click(function(){
      
      $item_id = $(this).parent().find('.basket-item-id').val();
      $quantity = $(this).parent().find('.basket-item-quantity').val();
      
      $.post(location.protocol + "//" + location.host + '/basket/change-quantity' , {item_id: $item_id, quantity: $quantity}, function(data) {

        if (data['result'] == 'success')
        {
          $('#basket_total').html(data['basket_total']);  
            
          swal("OK", "Quantity changed.", "success");
        }
        else
        {
          swal("Error", "There was a problem changing quantity of this product in your basket.", "error");          
        }

      });
      
    });
 });