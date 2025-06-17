<?php

namespace App\Providers;

use Illuminate\Pagination\Paginator;
use Illuminate\Database\Eloquent\Model;
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
        //Jika ada yang menggunakan lazy loading akan error
        Model::preventLazyLoading();

        //Paginate View Penuh/Lengkap
        Paginator::defaultView('vendor.pagination.paginate');

        //Paginate View Simple
        Paginator::defaultSimpleView('vendor.pagination.simple-paginate');

    }
}
