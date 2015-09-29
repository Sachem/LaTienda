<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CatalogProduct;
use App\CatalogCategory;

class LatiendaController extends Controller
{
      /**
     * 
     * @param CatalogProduct $product
     * @return type
     */
    public function showProduct(CatalogProduct $product)
    {  
      $images = $product->images;
      
      return view('catalog.show_product', compact('product', 'images'));
    }
    
    public function showCategory(CatalogCategory $category)
    {  
      $products = $category->products;
      
      return view('catalog.show_category', compact('category', 'products'));
    }
}
