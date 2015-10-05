<?php

namespace App\Http\Controllers\Account;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use App\UserAddress;
use Request;
use Hash;



class CustomerDetailsController extends Controller{
  
  public function getIndex() 
  {
    $user_details = \App\User::find(Auth::user()->id);
    $user_address = $user_details->addresses->first();
    
    if (! $user_address)
    {
      $user_address = new UserAddress;
    }
    
    return view('account.customer_details', [
        'user_address' => $user_address,
        'user_details' => $user_details
    ]);
    
  }
  
  public function postUpdateDetails(Requests\CustomerDetailsRequest $request) 
  {
    $user = \App\User::find(Auth::user()->id);
    $user->update($request->all());

    return redirect('account/details')->with([
      'flash_message' => 'Your details have been updated'
    ]);
  }
  
  public function postChangePassword(Requests\CustomerPasswordRequest $request) 
  {
    $user = \App\User::find(Auth::user()->id);
    
    // Old password incorrect...
    if (! Hash::check($request['old_password'], $user->password)) 
    {
      return redirect('account/details')->with([
        'error_message' => 'Old password doesn\'t match the one stored in our database'
      ]);      
    }
    
    if ($request['password'] != $request['password_confirmation'])
    {
      return redirect('account/details')->with([
        'error_message' => 'Password confirmation doesn\'t match the password'
      ]);      
    }
     
    $user->update(['password' => bcrypt($request['password'])]);
    
    return redirect('account/details')->with([
      'flash_message' => 'Your password has been updated'
    ]);
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