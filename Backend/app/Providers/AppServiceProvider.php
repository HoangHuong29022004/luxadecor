<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Modules\Attributes\Repositories\AttributeRepository;
use Modules\Attributes\Repositories\AttributeRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->bindingsRepository();
    }

    public function bindingsRepository()
    {
        // Attribute
        $this->app->singleton(
            AttributeRepositoryInterface::class,
            AttributeRepository::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
