<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Endpoints\Devices;

use Verplanke\Ikea\Builder;
use Verplanke\Ikea\Contracts\Devices\TurnsOnDevice;
use Verplanke\Ikea\Enums\Coap;
use Verplanke\Ikea\Enums\Resource;

final class TurnOnDevice extends Builder implements TurnsOnDevice
{
    protected function type(): string
    {
        return Coap::PUT->value;
    }

    protected function resource(): string
    {
        return Resource::ROOT_DEVICES->value;
    }

    protected function payload(): array
    {
        return [
            Resource::ATTR_LIGHT_STATE->value => (int) Resource::ON->value,
            Resource::ATTR_LIGHT_DIMMER->value => 25,
            Resource::ATTR_TRANSITION_TIME->value => 10,
        ];
    }
}
