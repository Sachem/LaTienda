<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CatalogProduct;
use App\CatalogCategory;

use App\Http\Requests\SearchShopRequest;

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
      $products = CatalogProduct::where('category_id', '=', $category->id)->active()->paginate(3);
      
      return view('catalog.show_category', compact('category', 'products'));
    }
    
    public function showSearchBox() 
    {
      return view('catalog.search_box');
    }
    
    public function searchResult(SearchShopRequest $request) 
    {
      $keyword = $request->keyword;
      $products = CatalogProduct::where('name', 'like', $keyword. '%')->active()->paginate(1);
      
      
      return view('catalog.search_result', compact('products', 'keyword'));
    }
    
}
