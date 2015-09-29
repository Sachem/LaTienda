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
      $items = [];
      
      if (Auth::check())
      {
        $items = CatalogBasket::with('items.product.images')->where('user_id', '=', Auth::user()->id)->first()->items;
      }
      
      //dd($items);
      
      return view('catalog.basket.index', compact('items'));
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
      
    }

    /**
     * [AJAX] Change quantity of a product in a basket
     */
    public function postChangeQuantity()
    {
      
    }
}
