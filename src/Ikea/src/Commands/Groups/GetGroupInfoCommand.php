<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Commands\Groups;

use Illuminate\Console\Command;
use Verplanke\Ikea\Concerns\InteractsWithOutput;
use Verplanke\Ikea\Contracts\Groups\GetsGroupInfo;
use Verplanke\Ikea\Contracts\Groups\ListsGroups;

final class GetGroupInfoCommand extends Command
{
    use InteractsWithOutput;

    /** @var string  */
    protected $signature = 'ikea:group {groupId?}';

    public function handle(GetsGroupInfo $getsGroupInfo, ListsGroups $listsGroups): int
    {
        if (empty($this->argument(key: 'groupId'))) {
            $this->ListGroups(listsGroups: $listsGroups);

            return self::SUCCESS;
        }

        $this->getGroupInfo(getsGroupInfo: $getsGroupInfo);

        return self::SUCCESS;
    }

    private function ListGroups(ListsGroups $listsGroups): void
    {
        $output = $this->getGroupOutput(builder: $listsGroups);

        $this->groupTable(output: $output);
    }

    private function getGroupInfo(GetsGroupInfo $getsGroupInfo): void
    {
        $getsGroupInfo->setResource(
            resource: $this->argument(key: 'groupId')
        );

        $output = $this->getGroupOutput(builder: $getsGroupInfo);

        $headers = ['ID', 'Name', 'Devices', 'State'];
        $rows = [
            $output->getId(),
            $output->getName(),
//            count(value: $output->getDevices()),
            $output->getState()
        ];

        $this->table(headers: $headers, rows: [$rows]);
    }
}
