<?php namespace Latienda\Repositories;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CatalogCategoryRepository
 *
 * @author Sachem
 */



use App\CatalogCategory;

class CatalogCategoryRepository {
  
  public static $categories;
  
  public static function fullTree()
  {
      self::$categories = CatalogCategory::all();

      return self::getChildren(0);
  }

  protected static function getChildren($parent_id) 
  {
      $result = [];

      foreach (self::$categories as $category)
      {
          if ($category->parent_id == $parent_id)
          {
              $result[] = self::values($category);
          }
      }

      return $result;
  }
   
  protected static function values(CatalogCategory $category)
  {
      return $result = [
          'id' => $category->id,
          'name' => $category->name,
          'parent_id' => $category->parent_id,
          'children' => self::getChildren($category->id)
      ];
  } 
}
