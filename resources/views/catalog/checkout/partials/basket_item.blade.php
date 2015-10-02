<div class="item">
    <div class="picture" style="background-image: url(/images/catalog/{{ ! isset($item->product->images[0]) ? 'No_image_available.jpg' : $item->product->images[0]->id . '.' . $item->product->images[0]->extension }})"></div>
    <div class="name">{{ $item->product->name }}</div>
    <div class="price">{{ $item->product->price }}</div>
    <div class="quantity"> x {{ $item->quantity }}</div>
    <div class="item_total"><b>{{ $item->product->price * $item->quantity }}</b></div>
    <div class="clear"></div>
</div>