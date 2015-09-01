<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogProduct extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'catalog_product';
  
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'discounted_price',
        'sku'
    ];
    
    
    /**
     * Product is owned by a Category
     * 
     * @return type
     */
    public function category()
    {
      return $this->belongsTo('App\CatalogCategory');
    }
}
