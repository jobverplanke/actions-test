<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Output;

use Illuminate\Contracts\Support\Arrayable;
use Verplanke\Ikea\Contracts\Output as OutputContract;
use Verplanke\Ikea\Enums\Resource;

class DeviceOutput implements Arrayable, OutputContract
{
    public function __construct(
        private string $output
    ) {

    }

    public static function make(string $output): OutputContract
    {
        return new static(output: $output);
    }

    public function toArray(): mixed
    {
        return json_decode(json: $this->output, associative: true);
    }

    public function getName(): string
    {
        return $this->toArray()[Resource::ATTR_NAME->value];
    }

    public function getId(): int
    {
        return $this->toArray()[Resource::ATTR_ID->value];
    }

    public function getState(): string
    {
        return $this->readableState(
            value: $this->toArray()['3311'][0][Resource::ATTR_LIGHT_STATE->value]
        );
    }

    protected function readableState(int $value): string
    {
        return match ($value) {
            0 => 'Off',
            1 => 'On',
        };
    }
}
