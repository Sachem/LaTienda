<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\CatalogCategory;
use App\Page;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
      view()->composer('partials.client_nav_bar', function($view)
      {
        $view->with('categories', CatalogCategory::where('parent_id', '!=', 0)->get());
        $view->with('pages', Page::visible()->get(['title','path']));
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
