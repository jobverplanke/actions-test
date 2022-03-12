<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Commands\Groups;

use Illuminate\Console\Command;
use Verplanke\Ikea\Contracts\Builder;
use Verplanke\Ikea\Contracts\Groups\ListsGroups;
use Verplanke\Ikea\Contracts\Output;
use Verplanke\Ikea\Output\GroupOutput;

final class ListGroupsCommand extends Command
{
    /** @var string  */
    protected $signature = 'ikea:groups';

    public function handle(ListsGroups $listsGroups): int
    {
        $output = $this->getGroupOutput(builder: $listsGroups);

        $rows = collect(value: $output->toArray())
            ->map(callback: fn ($item, $key) => [$item])
            ->toArray();

        $headers = ['GroupIds'];

        $this->table(headers: $headers, rows: $rows);

        return self::SUCCESS;
    }

    private function getGroupOutput(Builder $builder): Output
    {
        $process = $builder->command()->execute();

        return new GroupOutput(output: $process->getOutput());
    }
}
