    
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
          alert('Product added to basket.');
        }
        else
        {
          alert('There was a problem adding to basket!');
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

        if (data == 'success')
        {
          $parent.parent().css('display','none');
          alert('Product removed from basket.');
        }
        else
        {
          alert('There was a problem removing this product from basket!');
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

        if (data == 'success')
        {
          alert('Quantity changed.');
        }
        else
        {
          alert('There was a problem changing quantity of this product in your basket!');
        }

      });
      
    });
 });