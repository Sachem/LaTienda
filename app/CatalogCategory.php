<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CatalogCategory extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'catalog_categories';
  
    protected $fillable = [
        'parent_id',
        'name',
        'description',
        'url',
        'active'
    ];
    
    
    /**
     * Category has many Products
     * 
     * @return type
     */
    public function products()
    {
      return $this->hasMany('App\CatalogProduct', 'category_id');
    }
}
