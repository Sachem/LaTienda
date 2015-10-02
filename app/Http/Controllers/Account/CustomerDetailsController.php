<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\UserAddress;



class CustomerDetailsController extends Controller{
  
  public function getIndex() 
  {
    
    $user_address = \App\User::find(Auth::user()->id)->addresses->first();
    
    if (! $user_address)
    {
      $user_address = new UserAddress;
    }
    
    return view('account.customer_details', ['user_address' => $user_address]);
    
  }
  
  public function postUpdateDetails() 
  {
    
  }
  
  public function postUpdateAddress(Requests\CustomerAddressRequest $request) 
  {
    $user_address = \App\User::find(Auth::user()->id)->addresses->first();
    
    if (! $user_address)
    {
      $user_address = new UserAddress($request->all());
      $user_address->user_id = Auth::user()->id;
      $user_address->save();
    }
    else 
    {
      $user_address->update($request->all());
    }
            
    return redirect('account/details')->with([
      'flash_message' => 'Your address has been updated'
    ]);
  }

}