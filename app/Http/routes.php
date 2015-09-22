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

Route::get('/', 'WebsiteController@hello');
Route::get('about', 'WebsiteController@about');
Route::get('contact', 'WebsiteController@contact');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

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
    
    /*
    Route::group(['namespace' => 'Account'], function(){

        Route::controllers([
            'customer'  => 'CustomerController',
            'admin'     => 'AdminController',
        ]);

    });
*/
    Route::group([
        'prefix'    => 'catalog'
        ], function(){

      
        Route::resource('product', 'CatalogProductController');
        
        Route::resource('category', 'CatalogCategoryController');
      
        /*
        Route::controllers([
            'product'   => 'CatalogProductController',
            //'category'  => 'CategoryController',
        ]);
         */

    });
       
});