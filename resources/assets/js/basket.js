    
$(document).ready(function(){    
    /**
     * Remove from basket
     * 
     * @returns alert
     */
    $('.remove-from-basket-button').click(function(){
      
      $parent = $(this).parent();
      $item_id = $parent.find('.basket-item-id').val();
      
      $.post('basket/remove-item' , {item_id: $item_id}, function(data) {

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
      
      $.post('basket/change-quantity' , {item_id: $item_id, quantity: $quantity}, function(data) {

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