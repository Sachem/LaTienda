<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CatalogProduct;
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
        $basket->user_id = Auth::user()->id; // HERE problema
        $basket->save();          
      }

      $items = $basket->items;
      $basket_total = $basket->total_cost;
      
      return view('catalog.basket.basket', compact('items','basket_total'));
    }

    /**
     * [AJAX] Add product to basket
     */
    public function postAddItem()
    {
      // product id (passed by AJAX)
      $product_id = Input::get('product_id');
      $product = CatalogProduct::find($product_id);
           
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
        $basket->total_cost += $product->price;
        $basket_update_result = $basket->save();
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
      
      // get basket item from database
      $basket_item = CatalogBasketItem::with('basket', 'product')->find($item_id);
      
      // check if basket item belongs to logged in user
      if ($basket_item->basket->user_id != Auth::user()->id)
      {
        return Response::json('error', 403);
      }
      
      // change basket total cost
      $quantity_difference =  -1 * $basket_item->quantity;
      $basket_total_difference = $quantity_difference * $basket_item->product->price;
      
      $basket_total_changed = CatalogBasket::find($basket_item->basket->id)->increment('total_cost', $basket_total_difference);
      
      // remove basket item from database
      $item_removed_from_basket = false;
      if ($basket_total_changed)
      {
        $item_removed_from_basket = $basket_item->delete();
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
      // basket item_id And quantity (passed by AJAX)
      $item_id = Input::get('item_id');
      $quantity = Input::get('quantity');
           
      if (Auth::check()
          and (! is_numeric($quantity) or $quantity < 0 or $quantity != (int)$quantity)
      )
      {
        return Response::json('error', 400);
      }
      
      
      DB::beginTransaction();
      
      // get basket item from database
      $basket_item = CatalogBasketItem::with('basket', 'product')->find($item_id);
      
      // check if basket item belongs to logged in user
      if ($basket_item->basket->user_id != Auth::user()->id)
      {
        return Response::json('error', 403);
      }
      
      // change basket total cost
      $quantity_difference = $quantity - $basket_item->quantity;
      $basket_total_difference = $quantity_difference * $basket_item->product->price;
      
      $basket_total_changed = CatalogBasket::find($basket_item->basket->id)->increment('total_cost', $basket_total_difference);
      
      
      // change basket item quantity
      $item_quantity_changed = false;
      if ($basket_total_changed)
      {
        $basket_item->quantity = $quantity;
        $item_quantity_changed = $basket_item->save();
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
