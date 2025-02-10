<?php


namespace App\Providers;

use App\Repositories\Contracts\ImagesRepositoryContract;
use App\Repositories\Contracts\ProductsRepositoryContract;
use App\Repositories\ImagesRepository;
use App\Repositories\ProductRepository;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public $bindings = [
        ProductsRepositoryContract::class => ProductRepository::class,
        ImagesRepositoryContract::class => ImagesRepository::class,
    ];

    /**
     * Register any application services.
     */
}
