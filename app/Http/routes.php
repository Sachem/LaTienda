<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

  /*
   * Website basic routes
   */

    Route::get('/', 'WebsiteController@hello');
    Route::post('contact_request', 'WebsiteController@contactFormSend');

  
  /**
   * Various controller routes
   */
  
    Route::controllers([
        'auth' => 'Auth\AuthController',
        'password' => 'Auth\PasswordController',
        'basket' => 'BasketController',
        'checkout' => 'CheckoutController',
        'paypal' => 'PaypalPaymentController',
    ]);

  /**
   * Routes for shop window - display product details or product list (category)
   */

    Route::get('product/{product}/{product_name}', 'LatiendaController@showProduct');
    Route::get('category/{category}/{category_name}', 'LatiendaController@showCategory');

  /**
   * Create routes for pages added in CMS 
   */
  
    $pages = \App\Page::visible()->get();
    foreach ($pages as $page)
    {
      Route::get($page->path, 'WebsiteController@cmsPage');
    }

  /**
   * User Account Routes
   *  - App\Http\Controllers\Account
   *  - Protected by 'auth' middleware
   */

    Route::group([
        'namespace' => 'Account',
        'prefix' => 'account',
        'middleware'    => 'auth',    
    ], function(){

        Route::controllers([
            'details'  => 'CustomerDetailsController',
        ]);

        Route::resource('order', 'CustomerOrdersController');

    });


  /**
   * Admin Routes
   *  - App\Http\Controllers\Admin
   *  - Protected by 'admin' middleware
   */

    Route::group([
        'namespace'     => 'Admin',
        'prefix'        => 'admin',
        'middleware'    => 'admin',
    ], function(){

        Route::get('/', function(){

          return view('static_pages.hello_admin');

        });

        Route::controllers([
            'config'    => 'ConfigController',
        ]);

        Route::resource('page', 'PagesController');
        Route::resource('user', 'UsersController');
        Route::resource('order', 'OrdersController');

        Route::group([
            'prefix'    => 'catalog'
            ], function(){


            Route::resource('product', 'CatalogProductController');
            Route::resource('category', 'CatalogCategoryController');

            Route::get('category/{category}/delete', 'CatalogCategoryController@delete');       

            Route::controllers([
                'dropzone'  => 'DropzoneController',
            ]);

        });

    });
    
    
  /**
   *  Display all SQL executed in Eloquent (development only)
   */

    /*
    Event::listen('illuminate.query', function($query)
    {
      var_dump($query);
    }); 
    */
