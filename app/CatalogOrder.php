<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogOrder extends Model
{
  protected $table = 'catalog_orders';
  
  public function items()
  {
    return $this->hasMany('App\CatalogOrderItem', 'order_id');
  }

  public function user()
  {
    return $this->belongsTo('App\User', 'user_id');
  }

  public function payment()
  {
    return $this->hasOne('App\Payment', 'id');
  }
  
  public function delivery_address()
  {
    return $this->hasOne('App\OrderAddress', 'id');
  }
}
