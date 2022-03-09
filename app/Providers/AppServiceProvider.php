<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Verplanke\Ikea\IkeaServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->register(provider: IkeaServiceProvider::class);
    }

    public function boot(): void
    {
        //
    }
}
