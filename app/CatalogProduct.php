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
    protected $table = 'catalog_products';
  
    protected $fillable = [
        'category_id',
        'name',
        'description',
        'price',
        'discounted_price',
        'sku',
        'active'
    ];
    
    
    public function scopeActive($query)
    {
      $query->where('active', '=', 1);
    }
    
    /**
     * Product has many ProductImages
     * 
     * @return type
     */
    public function images()
    {
      return $this->hasMany('App\CatalogProductImage', 'product_id');
    }
    
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
