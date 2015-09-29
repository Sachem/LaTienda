<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogBasket extends Model
{
  public function items()
  {
    return $this->hasMany('App\CatalogBasketItem', 'basket_id');
  }
}
