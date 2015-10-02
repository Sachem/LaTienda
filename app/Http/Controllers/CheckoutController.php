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
          
      return view('catalog.checkout.checkout_step1', ['basket_total' => $basket->total_cost, 'items' => $basket->items, 'delivery_address' => $delivery_address]);
    }
    
    public function postConfirmation(Requests\CustomerAddressRequest $request) 
    {
      DB::beginTransaction();
      $transaction_fail = false;
      
      $basket = CatalogBasket::with('items.product.images')->where('user_id', '=', Auth::user()->id)->first();
      
      $request_array = $request->all();
      
      $new_payment = new \App\Payment;
      $new_payment->price = $basket->total_cost;
      if (! $new_payment->save()) $transaction_fail = true;
      
      $new_order = new \App\CatalogOrder;
      $new_order->user_id = Auth::user()->id;
      $new_order->payment_id = $new_payment->id;
      $new_order->delivery_address_line_1 = $request_array['address_line_1'];
      $new_order->delivery_address_line_2 = $request_array['address_line_2'];
      $new_order->delivery_city = $request_array['city'];
      $new_order->delivery_postcode = $request_array['postcode'];
      $new_order->delivery_phone_number = $request_array['phone_number'];
      $new_order->delivery_instructions = $request_array['delivery_instructions'];
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
        
        return redirect('checkout/payment');
      }
      
    }
    
    public function getPayment() 
    {
      //$items = \App\CatalogOrderItem::with('product.images')->where('order_id', '=', $id)->get();
      //$order = \App\
      
      //return view('catalog.checkout.checkout_step2', ['basket_total' => $basket->total_cost, 'items' => $items, 'delivery_address' => $delivery_address]);
    }
}
