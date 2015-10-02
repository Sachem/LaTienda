<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
  protected $table = 'user_addresses';
    
  protected $fillable = [
        'address_line_1',
        'address_line_2',
        'city',
        'postcode',
        'phone_number',
        'delivery_instructions'
    ];
  
  public function user()
  {
    return $this->belongsTo('App\User');
  }
}
