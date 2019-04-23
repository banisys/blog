<?php

namespace App\Providers;

use App\Models\Categories\Category;

use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    public function boot()
    {
        Schema::defaultStringLength(191);

        view()->composer('layouts.sidebar', function ($view) {
            $categories = Category::all();
            $categories = $categories->chunk(round($categories->count() / 2));

            $view->with(compact('categories'));
        });
    }
}
