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
use Illuminate\Cookie\CookieJar;
use Cookie;

class BasketController extends Controller
{
  /**
   * 
   * Creates a basket and stores it in the db.
   * If authenticated saves a basket with user_id, 
   * otherwise uses session_token, which is a Cookie 'LatiendaBasketId'
   * 
   * @param CookieJar $cookie_jar
   * @return CatalogBasket
   */
  protected function createBasket(CookieJar $cookie_jar = null)
  {
    $basket = new CatalogBasket;
        
    if (Auth::check())
    {
      $basket->user_id = Auth::user()->id;
    }
    else
    {
      $random_string = str_random(40);
      $basket->session_token = $random_string;   
      $cookie_jar->queue(Cookie::forever('LatiendaBasketId', $random_string));
    }

    $basket->save(); 

    return $basket;
  }
  
  /**
   * 
   * Reads basket and it's items from the db.
   * 
   * If user authenticated check's for items in 'unlogged' basket, and moves the items to user's basket.
   * 
   * @param CookieJar $cookie_jar
   * @return type
   */
  protected function retrieveBasket(CookieJar $cookie_jar = null)
  {
    // if authorized user, find basket in DB by user_id
    if (Auth::check())
    {
      $basket = CatalogBasket::with('items.product.images')->where('user_id', Auth::user()->id)->first();
      
      $unlogged_basket = CatalogBasket::with('items')->where('session_token', Cookie::get('LatiendaBasketId'))->first();
    }
    elseif(Cookie::get('LatiendaBasketId')) // find by cookie
    {
      $basket = CatalogBasket::with('items.product.images')->where('session_token', Cookie::get('LatiendaBasketId'))->first();
    }

    // if user's basket does not exist - create it
    if (! isset($basket))
    {
      $basket = $this->createBasket($cookie_jar);
    }
    
    // if user is logged and there exists "unlogged" basket, move items from this "unlogged" basket to user's basket
    if (isset($unlogged_basket) && ! $unlogged_basket->items->isEmpty())
    {
      $this->connectBaskets($basket->id, $unlogged_basket->id);
      
      $basket = CatalogBasket::with('items.product.images')->where('user_id', Auth::user()->id)->first();
    }
    
    
    return $basket;
  }
  
  /**
   * 
   * Moves items from 'unlogged' basket to user's basket.
   * 
   * @param type $basket_id
   * @param type $unlogged_basket_id
   */
  protected function connectBaskets($basket_id, $unlogged_basket_id)
  {
    // update catalog_basket_items set basket_id = $basket_id where basket_id = $unlogged_basket_id
    
    CatalogBasketItem::where('basket_id', $unlogged_basket_id)->update([
       'basket_id' => $basket_id
    ]);
  }
  
  
    /**
     * Display a basket
     *
     * @return Response
     */
    public function getIndex(CookieJar $cookie_jar)
    {
      $basket = $this->retrieveBasket($cookie_jar);

      $items = $basket->items;
      $basket_total = $basket->total_cost;
           
      return view('catalog.basket.basket', compact('items','basket_total'));     
    }

    /**
     * [AJAX] Add product to basket
     * 
     * @param CookieJar $cookie_jar
     * @return JSON Response
     */
    public function postAddItem(CookieJar $cookie_jar)
    {
      // product id (passed by AJAX)
      $product_id = Input::get('product_id');
      $product = CatalogProduct::find($product_id);
           
      
      $basket = $this->retrieveBasket($cookie_jar);
      $basket_items = $basket->items;
      
      
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
     * 
     * [AJAX] Remove product from basket
     * 
     * @return JSON Response
     */
    public function postRemoveItem()
    {
      // basket item id (passed by AJAX)
      $item_id = Input::get('item_id');
           
      
      $basket = $this->retrieveBasket(null);

      
      DB::beginTransaction();
      
      // get basket item from database
      $basket_item = CatalogBasketItem::with('basket', 'product')->find($item_id);
      
      // check if basket item belongs to logged in user
      if ($basket_item->basket->id != $basket->id)
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

        return Response::json(['result' => 'success', 'basket_total' => ($basket->total_cost + $basket_total_difference)], 200);
      } 
      else 
      {
        DB::rollback();

        return Response::json('error', 400);
      }
    }

    /**
     * 
     * [AJAX] Change quantity of a product in a basket
     * 
     * @return JSON Response
     */
    public function postChangeQuantity()
    {
      // basket item_id And quantity (passed by AJAX)
      $item_id = Input::get('item_id');
      $quantity = Input::get('quantity');
           
      if (! is_numeric($quantity) or $quantity < 0 or $quantity != (int)$quantity)
      {
        return Response::json('error', 400);
      }
      
      $basket = $this->retrieveBasket(null);
      
      DB::beginTransaction();
      
      // get basket item from database
      $basket_item = CatalogBasketItem::with('basket', 'product')->find($item_id);
      
      // check if basket item belongs to logged in user
      if ($basket_item->basket->id != $basket->id)
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

        return Response::json(['result' => 'success', 'basket_total' => ($basket->total_cost + $basket_total_difference)], 200);
      } 
      else 
      {
        DB::rollback();

        return Response::json(['result' => 'error'], 400);
      }
    }
}
