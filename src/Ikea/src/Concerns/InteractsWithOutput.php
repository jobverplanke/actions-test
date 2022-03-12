<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Concerns;

use Verplanke\Ikea\Contracts\Builder;
use Verplanke\Ikea\Contracts\Output;
use Verplanke\Ikea\Output\DeviceOutput;
use Verplanke\Ikea\Output\GroupOutput;

trait InteractsWithOutput
{
    protected function getDeviceOutput(Builder $builder): Output
    {
        $process = $builder->command()->execute();

        return DeviceOutput::make(output: $process->getOutput());
    }

    protected function getGroupOutput(Builder $builder): Output
    {
        $process = $builder->command()->execute();

        return GroupOutput::make(output: $process->getOutput());
    }

    protected function deviceTable(Output $output): void
    {
        $rows = collect(value: $output->toArray())
            ->map(callback: fn ($item, $key) => [$item])
            ->toArray();

        $headers = ['DeviceIds'];

        $this->table(headers: $headers, rows: $rows);
    }

    protected function groupTable(Output $output): void
    {
        $rows = collect(value: $output->toArray())
            ->map(callback: fn ($item, $key) => [$item])
            ->toArray();

        $headers = ['GroupIds'];

        $this->table(headers: $headers, rows: $rows);
    }
}
