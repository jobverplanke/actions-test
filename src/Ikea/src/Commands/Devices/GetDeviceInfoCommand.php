<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Commands\Devices;

use Illuminate\Console\Command;
use Verplanke\Ikea\Concerns\InteractsWithOutput;
use Verplanke\Ikea\Contracts\Devices\GetsDeviceInfo;
use Verplanke\Ikea\Contracts\Devices\ListsDevices;

final class GetDeviceInfoCommand extends Command
{
    use InteractsWithOutput;

    /** @var string  */
    protected $signature = 'ikea:device {deviceId?}';

    public function handle(GetsDeviceInfo $getsDeviceInfo, ListsDevices $listsDevices): int
    {
        if (empty($this->argument(key: 'deviceId'))) {
            $this->listDevices(listsDevices: $listsDevices);

            return self::SUCCESS;
        }

        $this->getDeviceInfo(getsDeviceInfo: $getsDeviceInfo);

        return self::SUCCESS;
    }

    private function listDevices(ListsDevices $listsDevices): void
    {
        $output = $this->getDeviceOutput(builder: $listsDevices);

        $this->deviceTable(output: $output);
    }

    private function getDeviceInfo(GetsDeviceInfo $getsDeviceInfo): void
    {
        $getsDeviceInfo->setResource(
            resource: $this->argument(key: 'deviceId')
        );

        $output = $this->getDeviceOutput(builder: $getsDeviceInfo);

        $headers = ['ID', 'Name', 'State'];
        $rows = [
            $output->getId(),
            $output->getName(),
            $output->getState()
        ];

        $this->table(headers: $headers, rows: [$rows]);
    }
}
