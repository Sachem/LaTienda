<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use Auth;


class CustomerOrdersController extends Controller{
  
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $orders = \App\CatalogOrder::where('user_id', Auth::user()->id)->with('payment','user')->paginate(3);
        
        return view('account.orders.index', compact('orders'));
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
      $order = \App\CatalogOrder::with('items.product.images', 'payment', 'delivery_address', 'user')->find($id);

      if ($order->user_id != Auth::user()->id)
      {
        return response()->view('errors.403');
      }
      
      return view('account.orders.show', [
          'order' => $order, 
      ]);
    }    
}