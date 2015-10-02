<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CatalogBasket;
use App\CatalogBasketItem;

use Auth;
use Response;
use DB;
use Input;

class BasketController extends Controller
{
    /**
     * Display a basket
     *
     * @return Response
     */
    public function getIndex()
    {
      if (Auth::check())
      {
        $basket = CatalogBasket::with('items.product.images')->where('user_id', '=', Auth::user()->id)->first();
      }
      
      // if user's basket does not exist - create it
      if (! isset($basket))
      {  
        $basket = new CatalogBasket;
        $basket->user_id = Auth::user()->id;
        $basket->save();          
      }

      $items = $basket->items;
      
      
      
      return view('catalog.basket.basket', compact('items'));
    }

    /**
     * [AJAX] Add product to basket
     */
    public function postAddItem()
    {
      // product id (passed by AJAX)
      $product_id = Input::get('product_id');
           
      if (Auth::check())
      {
        $basket = CatalogBasket::where('user_id', '=', Auth::user()->id)->first();
        
        // if user's basket does not exist - create it
        if (! $basket)
        {  
          $basket = new CatalogBasket;
          $basket->user_id = Auth::user()->id;
          $basket->save();          
        }
        
        $basket_items = $basket->items;
      }
      
      DB::beginTransaction();
      
      // add to basket
      $product_was_already_in_basket = false;
      
      foreach ($basket_items as $basket_item)
      {
        //product already in basket, increment quantity
        if ($basket_item->product_id == $product_id)
        {
          $basket_item->quantity++;
          $basket_update_result = $basket_item->save();
          $product_was_already_in_basket = true;
          break;
        }
      }
      
      if (! $product_was_already_in_basket)
      {
        $new_basket_item = new CatalogBasketItem;
        $new_basket_item->basket_id = $basket->id;
        $new_basket_item->product_id = $product_id;
        $new_basket_item->quantity = 1;
        $basket_update_result = $new_basket_item->save();
      }
      
   
      if ($basket_update_result) 
      {
        DB::commit();

        return Response::json('success', 200);
      } 
      else 
      {
        DB::rollback();

        return Response::json('error', 400);
      }
    }

    /**
     * [AJAX] Remove product from basket
     */
    public function postRemoveItem()
    {
      // basket item id (passed by AJAX)
      $item_id = Input::get('item_id');
           
      if (Auth::check())
      {
        $basket_items = CatalogBasket::where('user_id', '=', Auth::user()->id)->first()->items;
      }
      
      DB::beginTransaction();
      
      $item_removed_from_basket = false;
      foreach ($basket_items as $basket_item)
      {
        //product found in basket, removing
        if ($basket_item->id == $item_id)
        {
          $item_removed_from_basket = $basket_item->delete();
          break;
        }
      }
      
      if ($item_removed_from_basket) 
      {
        DB::commit();

        return Response::json('success', 200);
      } 
      else 
      {
        DB::rollback();

        return Response::json('error', 400);
      }
    }

    /**
     * [AJAX] Change quantity of a product in a basket
     */
    public function postChangeQuantity()
    {
      // basket item id (passed by AJAX)
      $item_id = Input::get('item_id');
      $quantity = Input::get('quantity');
           
      if (! is_numeric($quantity) or $quantity < 0 or $quantity != (int)$quantity)
      {
        return Response::json('error', 400);
      }
      
      if (Auth::check())
      {
        $basket_items = CatalogBasket::where('user_id', '=', Auth::user()->id)->first()->items;
      }
      
      DB::beginTransaction();
      
      $item_quantity_changed = false;
      foreach ($basket_items as $basket_item)
      {
        //product already in basket, increment quantity
        if ($basket_item->id == $item_id)
        {
          $basket_item->quantity = $quantity;
          $item_quantity_changed = $basket_item->save();
          break;
        }
      }
      
      if ($item_quantity_changed) 
      {
        DB::commit();

        return Response::json('success', 200);
      } 
      else 
      {
        DB::rollback();

        return Response::json('error', 400);
      }
    }
}
