<?php

namespace App\Providers;

use App\Models\Category;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        // The front-end master layout (and its "All Categories" accordion)
        // needs $categories on every page. Instead of fetching them in every
        // controller, a view composer injects them whenever layouts.home renders.
        View::composer('layouts.home', function ($view) {
            $categories = Category::where('parent_id', 0)
                ->where('status', 1)
                ->withCount('products')
                ->with(['children' => function ($query) {
                    $query->where('status', 1)->withCount('products');
                }])
                ->oldest()
                ->get();

            $view->with('categories', $categories);
        });
    }
}
