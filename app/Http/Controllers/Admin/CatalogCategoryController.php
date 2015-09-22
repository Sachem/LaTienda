<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CatalogCategoryRequest;
use App\Http\Controllers\Controller;
use App\CatalogCategory;


/*
 * This controller is for managing Categories (Admin only)
 */

class CatalogCategoryController extends Controller
{
    protected $categories;
    protected $category_tree = [];
    
    /**
     * 
     * @return type
     */
    public function index()
    {
        
      $category_tree = $this->category_tree = $this->buildFullTree();
      $categories = $this->categories;
      //dd($this->category_tree, $this->categories);
      
      return view('admin.catalog_category.index', compact('categories', 'category_tree'));
    }
    
    protected function buildFullTree()
    {
        $this->categories = CatalogCategory::all();
           
        return $this->getChildren(0);
    }
    
    protected function values(CatalogCategory $category)
    {
        return $result = [
            'id' => $category->id,
            'name' => $category->name,
            'parent_id' => $category->parent_id,
            'children' => $this->getChildren($category->id)
        ];
    }
    
    protected function getChildren($parent_id) 
    {
        $result = [];
        
        foreach ($this->categories as $category)
        {
            if ($category->parent_id == $parent_id)
            {
                $result[] = $this->values($category);
            }
        }
        
        return $result;
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
      return view('admin.catalog_category.create');
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
