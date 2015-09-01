<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\ProductRequest;
use App\Http\Controllers\Controller;
use App\CatalogProduct;


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
     * @param CatalogProduct $product
     * @return type
     */
    public function show(CatalogProduct $product)
    {  
      return view('admin.catalog_product.show', compact('product'));
    }
    
    /**
     * 
     * @param CatalogProduct $product
     * @return type
     */
    public function edit(CatalogProduct $product)
    {  
      return view('admin.catalog_product.edit', compact('product'));
    }
    
    /**
     * 
     * @param CatalogProduct $product
     * @return type
     */
    public function update(CatalogProduct $product, CatalogProductRequest $request)
    {  
      $product->update($request->all());
      
      return redirect('admin/catalog_product/'.$product->id.'/edit')->with([
        'flash_message' => 'Product updated'
      ]);
    }
    
    /**
     * 
     * @return type
     */
    public function create()
    {
      return view('admin.catalog_product.create');
    }
    
    /**
     * 
     * @return type
     */
    public function store(CatalogProductRequest $request) 
    {
      $product = new CatalogProduct($request->all());
      
      $product->save();
      
      return redirect('admin/catalog_product');
    }
    

}
