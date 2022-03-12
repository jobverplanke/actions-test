<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Endpoints\Groups;

use Verplanke\Ikea\Builder;
use Verplanke\Ikea\Contracts\Groups\GetsGroupInfo;
use Verplanke\Ikea\Enums\Coap;
use Verplanke\Ikea\Enums\Resource;

final class GetGroupInfo extends Builder implements GetsGroupInfo
{
    protected function type(): string
    {
        return Coap::GET->value;
    }

    protected function resource(): string
    {
        return Resource::ROOT_GROUPS->value;
    }

    protected function payload(): array
    {
        return [];
    }
}
