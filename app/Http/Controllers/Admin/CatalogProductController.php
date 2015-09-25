<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests;
use App\Http\Requests\CatalogProductRequest;
use App\Http\Controllers\Controller;
use App\CatalogProduct;
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
     * @param CatalogProduct $product
     * @return type
     */
    /*public function show(CatalogProduct $product)
    {  
      return view('admin.catalog_product.show', compact('product'));
    }*/
    
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
      
      $this->saveImageFile($request, $product);
      
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
      
      $this->saveImageFile($request, $product);
     
      return redirect('admin/catalog/product');
    }
    
    protected function saveImageFile($request, $product)
    {
      $imageName = $product->id . '.' . $request->file('image')->getClientOriginalExtension();

      $request->file('image')->move(
          base_path() . '/public/images/catalog/', $imageName
      );
    }
    
    public function dropzoneFileUpload() 
    {
      if(\Request::ajax()) 
      { 
        $file = \Input::file('file');

        $destinationPath = public_path() . '/images/catalog/';
        $filename = $file->getClientOriginalName();
        $upload_success = \Input::file('file')->move($destinationPath, $filename);
        
        if ($upload_success) 
        {
            return \Response::json('success', 200);
        } 
        else 
        {
            return \Response::json('error', 400);

        }
      }
      
    }
    
    public function dropzoneGetFiles() 
    {
      $result  = array();
 
      $imageFolder = public_path() . '/images/catalog/';
      
      $files = scandir($imageFolder);                 //1
      if ( false!==$files ) {
          foreach ( $files as $file ) {
              if ( '.'!=$file && '..'!=$file) {                             //2
                  $obj['name'] = $file;
                  $obj['size'] = filesize($imageFolder.$file);
                  $result[] = $obj;
              }
          }
      }
/*
      header('Content-type: text/json');                                    //3
      header('Content-type: application/json');
      echo json_encode($result);
*/      
      return \Response::json($result, 200);

    }

  }
