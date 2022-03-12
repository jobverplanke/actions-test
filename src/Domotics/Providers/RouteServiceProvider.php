<?php

declare(strict_types=1);

namespace Verplanke\Domotics\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Routing\Middleware\ThrottleRequests;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(routesCallback: function () {
            Route::prefix('api/domotics')
                ->middleware([ThrottleRequests::class . ':domotics'])
                ->group(callback: __DIR__.'/../Routes/api.php');
        });
    }

    protected function configureRateLimiting()
    {
        RateLimiter::for(
            'domotics',
            fn (Request $request) => Limit::perMinute(maxAttempts: 60)->by(key: $request->user()?->id ?: $request->ip())
        );
    }
}
