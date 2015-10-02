<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogBasket extends Model
{
  protected $table = 'catalog_baskets';
  
  public function items()
  {
    return $this->hasMany('App\CatalogBasketItem', 'basket_id');
  }
}
