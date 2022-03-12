<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Commands\Devices;

use Illuminate\Console\Command;
use Verplanke\Ikea\Concerns\InteractsWithOutput;
use Verplanke\Ikea\Contracts\Devices\ListsDevices;

final class ListDeviceCommand extends Command
{
    use InteractsWithOutput;

    /** @var string  */
    protected $signature = 'ikea:devices';

    public function handle(ListsDevices $listsDevices): int
    {
        $output = $this->getDeviceOutput(builder: $listsDevices);

        $this->deviceTable(output: $output);

        return self::SUCCESS;
    }
}
