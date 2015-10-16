<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Page extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'pages';
  
    protected $fillable = [
        'title',
        'content',
        'meta_description',
        'contact_form',
        'visible'
    ];
    
    public function scopeVisible($query)
    {
      $query->where('visible', '=', 1);
    }
    
    /**
     * Article is owned by a User
     * 
     * @return type
     */
    public function user()
    {
      return $this->belongsTo('App\User');
    }
}
