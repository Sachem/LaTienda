
    <li>
        <a href='{{ url('product/'.$product->id.'/'.str_slug($product->name)) }}'>{{ $product->name }}</a>
         @include('catalog.basket.partials.add_button')
  
    </li>
    