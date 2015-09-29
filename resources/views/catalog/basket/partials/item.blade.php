<div class="item">
    <div class="picture" style="background-image: url(/images/catalog/{{ ! isset($item->product->images[0]) ? 'No_image_available.jpg' : $item->product->images[0]->id . '.' . $item->product->images[0]->extension }})"></div>
    <div class="name">{{ $item->product->name }}</div>
    <div class="controls">
      <input type="hidden" class="basket-item-id" value="{{ $item->id }}" />
      <input type="text" value="{{ $item->quantity }}" class="basket-item-quantity" />
      <input type="button" value="Update" class="update-basket-quantity-button" />
      <input type="button" value="Remove" class="remove-from-basket-button" />
    </div>
    <div class="clear"></div>
</div>