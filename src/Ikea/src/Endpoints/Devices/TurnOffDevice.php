<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Endpoints\Devices;

use Verplanke\Ikea\Builder;
use Verplanke\Ikea\Contracts\Devices\TurnsOffDevice;
use Verplanke\Ikea\Enums\Coap;
use Verplanke\Ikea\Enums\Resource;

final class TurnOffDevice extends Builder implements TurnsOffDevice
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
            Resource::ATTR_LIGHT_STATE->value => (int) Resource::OFF->value,
            Resource::ATTR_LIGHT_DIMMER->value => 0,
            Resource::ATTR_TRANSITION_TIME->value => 10,
        ];
    }
}
