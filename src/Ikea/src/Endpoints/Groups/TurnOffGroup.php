<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Endpoints\Groups;

use Verplanke\Ikea\Builder;
use Verplanke\Ikea\Contracts\Groups\TurnsOffGroup;
use Verplanke\Ikea\Enums\Coap;
use Verplanke\Ikea\Enums\Resource;

final class TurnOffGroup extends Builder implements TurnsOffGroup
{
    protected function type(): string
    {
        return Coap::PUT->value;
    }

    protected function resource(): string
    {
        return Resource::ROOT_GROUPS->value;
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
