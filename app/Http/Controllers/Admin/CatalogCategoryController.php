<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CatalogCategoryRequest;
use App\Http\Controllers\Controller;
use App\CatalogCategory;
use Latienda\Repositories\CatalogCategoryRepository;

/*
 * This controller is for managing Categories (Admin only)
 */

class CatalogCategoryController extends Controller
{
   
    /**
     * 
     * @return type
     */
    public function index()
    {
           
      $category_tree = CatalogCategoryRepository::fullTree();

      return view('admin.catalog_category.index', compact('category_tree'));
    }
    

    public function delete(CatalogCategory $category)
    {  
      return view('admin.catalog_category.delete', compact('category'));
    }
    
    public function destroy(CatalogCategory $category) 
    {
      $category->delete();
      
      return redirect('admin/catalog/category')->with([
        'flash_message' => 'Category deleted'
      ]);
    }

    /**
     * 
     * @param CatalogProduct $product
     * @return type
     */
    public function edit(CatalogCategory $category)
    {  

      $category_tree = $this->buildFullTree();
        
      return view('admin.catalog_category.edit', compact('category','category_tree'));
    }
    
    /**
     * 
     * @param CatalogCategory $category
     * @return type
     */
    public function update(CatalogCategory $category, CatalogCategoryRequest $request)
    {  
      $category->update($request->all());
      
      return redirect('admin/catalog/category/'.$category->id.'/edit')->with([
        'flash_message' => 'Category updated'
      ]);
    }
    
    /**
     * 
     * @return type
     */
    public function create()
    {
      $category_tree = $this->buildFullTree();
      
      return view('admin.catalog_category.create', compact('category_tree'));
    }
    
    /**
     * 
     * @return type
     */
    public function store(CatalogCategoryRequest $request) 
    {
      $category = new CatalogCategory($request->all());
      
      $category->save();
      
      return redirect('admin/catalog/category');
    }
    

}
