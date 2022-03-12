<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Output;

use Illuminate\Contracts\Support\Arrayable;
use JsonSerializable;

class Output implements Arrayable, JsonSerializable
{
    public function __construct(
        protected string $output
    ) {
    }

    public function toArray(): mixed
    {
        return json_decode(json: $this->output, associative: true);
    }

    public function jsonSerialize(): string
    {
        return $this->output;
    }

    public function groups(): GroupOutput
    {
        return new GroupOutput(output: $this->output);
    }

    public function devices(): DeviceOutput
    {
        return new DeviceOutput(output: $this->output);
    }
}
