<div class="item">
    <div class="picture" style="background-image: url(/images/catalog/{{ ! isset($item->product->images[0]) ? '-' : $item->product->images[0]->id . '.' . $item->product->images[0]->extension }})"></div>
    <div class="name">{{ $item->product->name }}</div>
    <div class="controls">
      <input type="hidden" class="item_id" value="{{ $item->id }}" />
      <input type="text" value="{{ $item->quantity }}" class="item-quantity" />
      <input type="button" value="Remove" class="remove-from-basket" />
    </div>
    <div class="clear"></div>
</div>