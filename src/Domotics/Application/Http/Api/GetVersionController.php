<?php

declare(strict_types=1);

namespace Verplanke\Domotics\Application\Http\Api;

use Illuminate\Foundation\Application;

class GetVersionController
{
    public function __invoke(): string
    {
        return Application::VERSION;
    }
}
