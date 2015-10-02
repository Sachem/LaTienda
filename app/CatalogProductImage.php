<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogProductImage extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'catalog_product_images';
    
    /**
     * ProductImage is owned by a Product
     * 
     * @return type
     */
    public function product()
    {
      return $this->belongsTo('App\CatalogProduct', 'product_id');
    }
}
