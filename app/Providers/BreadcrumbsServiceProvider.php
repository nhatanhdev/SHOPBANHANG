<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Diglactic\Breadcrumbs\Breadcrumbs;

class BreadcrumbsServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // View::composer('*', function ($view) {
        //     // Get the current route name
        //     $route = \Route::current();
        //     if ($route) {
        //         $routeName = $route->getName();
        //         if($routeName){
        //             $parameters = array_values($route->parameters());
        //                 $breadcrumbs = Breadcrumbs::generate($routeName, ...$parameters);
        //                 if($breadcrumbs){

        //                 }
        //                 else {
        //                     $view->with('breadcrumbs', 0);

        //                 }

        //         }

        //     }
        // });
    }
}
