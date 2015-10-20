<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\PageRequest;
use App\Http\Requests\ContactFormRequest;
use App\Http\Controllers\Controller;
use App\Page;
use Illuminate\Support\Facades\Input as Input;
use Illuminate\Support\Facades\Validator as Validator;
use Request;
use Illuminate\Support\Facades\Mail;


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
    public function cmsPage(Request $request)
    {       
      $page = Page::where('path', $request::path())->first();
 
      
      return view('cms_pages.cms_page')->with([
          'title' => $page->title,
          'content' => $page->content,
          'contact_form' => $page->contact_form
      ]);
    }
    
    public function contactFormSend(ContactFormRequest $request)         
    { 
      $data = $request->all();
      Mail::send('emails.feedback', ['data' => $data], function($message) use ($data)
      {
        $message->from($data['email'] , 'Secret Luxury'); //uncomment if using first name and email fields 
        $message->to('karol.padiasek@gmail.com', 'John')->subject('Secret Luxury - contact form message'); // ->cc('feedback@gmail.com')
      });

      return redirect('contact')->with([   
        'flash_message' => 'Your message has been sent. Thank You!'
      ]);
    }
}
