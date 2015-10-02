<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogOrderItem extends Model
{
  protected $table = 'catalog_order_items';
  
  public function order()
  {
    return $this->belongsTo('App\CatalogOrder', 'order_id');
  }
  
  public function product()
  {
    return $this->belongsTo('App\CatalogProduct', 'product_id');
  }
}
