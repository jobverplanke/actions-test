<?php

declare(strict_types=1);

use Illuminate\Routing\Router;
use Illuminate\Support\Facades\Route;
use Verplanke\Domotics\Application\Http\Api\GetVersionController;

Route::prefix('ikea')->name('ikea')->group(callback: function (Router $router) {
    $router->get(uri: '/version', action: GetVersionController::class);
});
