<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CatalogProductRequest;
use App\Http\Controllers\Controller;
use App\CatalogProduct;
use App\CatalogProductImage;
use Latienda\Repositories\CatalogCategoryRepository;


/*
 * This controller is for managing Products (Admin only)
 */

class CatalogProductController extends Controller
{
    
    /**
     * 
     * @return type
     */
    public function index()
    {
      $products = CatalogProduct::all();
     
      return view('admin.catalog_product.index', compact('products'));
    }
   
    
    /**
     * 
     * @param CatalogProduct $product // route model binding - check RouteServiceProvider@boot
     * @return type
     */
    public function edit(CatalogProduct $product)
    {  
      $category_tree = CatalogCategoryRepository::fullTree();
      
      return view('admin.catalog_product.edit', compact('product', 'category_tree'));
    }
    
    /**
     * 
     * @param CatalogProduct $product
     * @return type
     */
    public function update(CatalogProduct $product, CatalogProductRequest $request)
    {  
      $product->update($request->all());
      
      //$this->saveImageFile($request, $product);
      
      return redirect('admin/catalog/product/'.$product->id.'/edit')->with([
        'flash_message' => 'Product updated'
      ]);
    }
    
    /**
     * 
     * @return type
     */
    public function create()
    {
      $category_tree = CatalogCategoryRepository::fullTree();
      
      return view('admin.catalog_product.create', compact('category_tree'));
    }
    
    /**
     * 
     * @return type
     */
    public function store(CatalogProductRequest $request) 
    {
      $product = new CatalogProduct($request->all());
      
      $product->save();
      
      //$this->saveImageFile($request, $product);
     
      return redirect('admin/catalog/product');
    }
    
    protected function saveImageFile($request, $product)
    {
      $imageName = $product->id . '.' . $request->file('image')->getClientOriginalExtension();

      $request->file('image')->move(
          base_path() . '/public/images/catalog/', $imageName
      );
    }
    
    

  }
