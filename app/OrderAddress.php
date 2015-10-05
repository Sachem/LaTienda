<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderAddress extends Model
{
  protected $table = 'order_addresses';
    
  protected $fillable = [
        'address_type',
        'address_line_1',
        'address_line_2',
        'city',
        'postcode',
        'phone_number',
        'delivery_instructions'
    ];
  
}
