<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PageRequest;
use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Support\Facades\Input as Input;


/* 
 * This controller is for displaying pages on the website
 */

class WebsiteController extends Controller
{
    
    /**
     * 
     * @return type
     */
    public function hello()
    {
      return view('static_pages.hello');
    }
    
    /**
     * 
     * @return type
     */
    public function about()
    {
      return view('static_pages.about')->with([
          'my_var' => 'dupa',
          'my_var2' => 'pipa',
      ]);
    }
    
    /**
     * 
     * @return type
     */
    public function contact()
    {
      return view('static_pages.contact')->with('title', 'Contact Page');
    }
    

}
