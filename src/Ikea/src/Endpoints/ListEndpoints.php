<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Endpoints;

use Verplanke\Ikea\Builder;
use Verplanke\Ikea\Contracts\ListsEndpoints;
use Verplanke\Ikea\Enums\Coap;
use Verplanke\Ikea\Enums\Resource;

final class ListEndpoints extends Builder implements ListsEndpoints
{
    protected function type(): string
    {
        return Coap::GET->value;
    }

    protected function resource(): string
    {
        return Resource::ROOT_ENDPOINTS->value;
    }

    protected function payload(): array
    {
        return [];
    }
}
