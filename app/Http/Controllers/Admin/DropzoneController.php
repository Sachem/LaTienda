<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of dropzoneController
 *
 * @author Sachem
 */

namespace App\Http\Controllers\Admin;

use App\CatalogProductImage;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Request;
use Response;
use DB;
use Input;

class DropzoneController  extends Controller
{
      
    public function getList() 
    {
      $result = [];
 
      $imageFolder = public_path() . '/images/catalog/';
      
      // get all images for the product from database
      $product_images = CatalogProductImage::where('product_id', '=', Input::get('product_id'))->get();
      
      foreach($product_images as $product_image)
      {
        $obj['name'] = $product_image->id . '.' . $product_image->extension;
        $obj['size'] = filesize($imageFolder.$obj['name']);
        $result[] = $obj;
      }
     
      return Response::json($result, 200);
    }
    
    public function postUpload() 
    {
      if(!Request::ajax()) 
      { 
        return Response::json($result, 400);
      }
      
      // image folder
      $destinationPath = public_path() . '/images/catalog/';

      DB::beginTransaction();

      // get uploaded image
      $file = Input::file('file');

      // create new image in database
      $product_image = new CatalogProductImage();  
      $product_image->product_id = Input::get('product_id');
      $product_image->extension = $file->getClientOriginalExtension();
      $product_image->title = $file->getClientOriginalName();
      $database_row_created = $product_image->save();

      // move file to image folder
      $upload_success = Input::file('file')->move($destinationPath, $product_image->id.'.'.$file->getClientOriginalExtension());

      if ($database_row_created && $upload_success) 
      {
        DB::commit();

        return Response::json('success', 200);
      } 
      else 
      {
        DB::rollback();

        return Response::json($result, 400);
      }
    }
    
    public function postRemove()
    {
      // image folder
      $imageFolder = public_path() . '/images/catalog/';
      
      // image filename to be deleted (passed by AJAX)
      $product_image_name = Input::get('product_image_name');
      
      // get ID of the product image in database
      $product_image_name_exploded = explode('.', $product_image_name);
           
      DB::beginTransaction();
      
      // delete a row from database
      $destroyed = CatalogProductImage::destroy($product_image_name_exploded[0]);
        
      // if deleted remove a file
      if ($destroyed)
      {
        $unlinked = unlink($imageFolder.$product_image_name);
      }
        
      if ($unlinked) 
      {
        DB::commit();

        return Response::json('success', 200);
      } 
      else 
      {
        DB::rollback();

        return Response::json($result, 400);
      }
    }
}
