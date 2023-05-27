<?php

namespace App\Providers;

use App\Services\FilterQueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;

class FilterServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(FilterQueryBuilder::class, function () {
            $request = app(Request::class);
            return new FilterQueryBuilder($request);
        });
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
    }
}
