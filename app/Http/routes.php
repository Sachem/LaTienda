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
  Route::get('/', function () {
 
    return view('welcome');
}); 
*/

// Display all SQL executed in Eloquent
Event::listen('illuminate.query', function($query)
{
   // var_dump($query);
});

Route::get('/', 'WebsiteController@hello');
Route::get('about', 'WebsiteController@about');
Route::get('contact', 'WebsiteController@contact');

Route::get('admin', 'WebsiteController@helloAdmin');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
    'basket' => 'BasketController',
    'checkout' => 'CheckoutController',
]);



Route::get('product/{product}/{product_name}', 'LatiendaController@showProduct');
Route::get('category/{category}/{category_name}', 'LatiendaController@showCategory');
 

/**
 * User Account Routes
 */

Route::group([
    'namespace' => 'Account',
    'prefix' => 'account',
    'middleware'    => 'auth',    
], function(){

    Route::controllers([
        'details'  => 'CustomerDetailsController',
        'orders'   => 'CustomerOrdersController',
    
    ]);

});


/**
 * Admin Routes
 *  - App\Http\Controllers\Admin
 *  - Protected by 'admin' middleware
 */

Route::group([
    'namespace'     => 'Admin',
    'prefix'        => 'admin',
    'middleware'    => 'auth',
], function(){

    Route::controllers([
        'config'    => 'ConfigController',
    ]);

    Route::resource('page', 'PagesController');
    
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