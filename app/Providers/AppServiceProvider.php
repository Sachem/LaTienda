<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\CatalogCategory;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      view()->composer('partials.client-nav-bar', function($view)
      {
        $view->with('categories', CatalogCategory::where('parent_id', '!=', 0)->get());
        
      });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
