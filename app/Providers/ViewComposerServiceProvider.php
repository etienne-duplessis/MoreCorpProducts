<?php

namespace App\Providers;

use App\Product;
use App\Http\Composers\NavigationComposer;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->composeNavigation();
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    private function composeNavigation()
    {
        view()->composer('products.admin.show', NavigationComposer::class);
        view()->composer('products.admin.index', NavigationComposer::class);
    }
}
