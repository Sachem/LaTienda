<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\CatalogBasket;
use App\CatalogBasketItem;

use Auth;
use Request;
use DB;

class CheckoutController extends Controller
{
    /**
     * Display first page of checkout / delivery address form
     *
     * @return Response
     */
    public function getIndex()
    {
      if (Auth::check())
      {
        $basket = CatalogBasket::with('items.product.images')->where('user_id', '=', Auth::user()->id)->first();
        
        $user_addresses = \App\User::find(Auth::user()->id)->addresses;
        
        $delivery_address = $user_addresses->first();
      }     
      
      if (!isset($basket) || $basket->items->isEmpty())
      {
        return redirect('basket');
      }   
          
      return view('catalog.checkout.checkout_step_1', ['basket_total' => $basket->total_cost, 'items' => $basket->items, 'delivery_address' => $delivery_address]);
    }
    
    public function postConfirmation(Requests\CustomerAddressRequest $request) 
    {
      DB::beginTransaction();
      $transaction_fail = false;
      
      $basket = CatalogBasket::with('items.product.images')->where('user_id', '=', Auth::user()->id)->first();
      
      $request_array = $request->all();
      
      $new_payment = new \App\Payment;
      $new_payment->total = $basket->total_cost;
      if (! $new_payment->save()) $transaction_fail = true;
      
      $new_order_address = new \App\OrderAddress($request->all());
      if (! $new_order_address->save()) $transaction_fail = true;
      
      $new_order = new \App\CatalogOrder;
      $new_order->user_id = Auth::user()->id;
      $new_order->payment_id = $new_payment->id;
      $new_order->delivery_address_id = $new_order_address->id;
      if (! $new_order->save()) $transaction_fail = true;
      
      foreach($basket->items as $basket_item)
      {
        $new_order_item = new \App\CatalogOrderItem;
        $new_order_item->order_id = $new_order->id;
        $new_order_item->product_id = $basket_item->product_id;
        $new_order_item->product_name = $basket_item->product->name;
        $new_order_item->product_price = $basket_item->product->price;
        $new_order_item->quantity = $basket_item->quantity;
        if (! $new_order_item->save())
        {
          $transaction_fail = true;
          break;
        }
      }
      
      // set basket total to "0"
      $basket->total_cost = 0;
      if (! $basket->save()) $transaction_fail = true;
      
      // delete basket items
      $transaction_fail = ! DB::table('catalog_basket_items')->where('basket_id', $basket->id)->delete();
      
      
      if ($transaction_fail)
      {
        DB::rollback();
        
        return redirect('checkout')->with([
          'flash_message' => 'There was a problem saving your order to database.'
        ]);
      }
      else
      {
        DB::commit();
        
        return redirect('checkout/payment/'.$new_order->id)->with([
         'flash_message' => 'You order has been placed. Please now make a payment.'   
        ]);
      }
      
    }
    
    /**
     * 
     * @param INT $id - order id
     * 
     * @return view
     */
    public function getPayment($id) 
    {
      $order = \App\CatalogOrder::with('items.product.images', 'payment', 'delivery_address')->find($id);

      return view('catalog.checkout.checkout_step_2', [
          'order_id' => $order->id, 
          'order_total' => $order->payment->total, 
          'items' => $order->items, 
          'delivery_address' => $order->delivery_address
      ]);
    }
}
