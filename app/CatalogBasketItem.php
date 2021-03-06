<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogBasketItem extends Model
{
  protected $table = 'catalog_basket_items';
  
  public function basket()
  {
    return $this->belongsTo('App\CatalogBasket', 'basket_id');
  }
  
  public function product()
  {
    return $this->belongsTo('App\CatalogProduct', 'product_id');
  }
}
