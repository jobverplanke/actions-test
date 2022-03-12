<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Endpoints\Devices;

use Verplanke\Ikea\Builder;
use Verplanke\Ikea\Contracts\Devices\GetsDeviceInfo;
use Verplanke\Ikea\Enums\Coap;
use Verplanke\Ikea\Enums\Resource;

final class GetDeviceInfo extends Builder implements GetsDeviceInfo
{
    protected function type(): string
    {
        return Coap::GET->value;
    }

    protected function resource(): string
    {
        return Resource::ROOT_DEVICES->value;
    }

    protected function payload(): array
    {
        return [];
    }
}
