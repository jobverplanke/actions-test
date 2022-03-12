<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Commands;

use Illuminate\Console\Command;
use Verplanke\Ikea\Contracts\ListsEndpoints;

final class ListEndpointsCommand extends Command
{
    /** @var string  */
    protected $signature = 'ikea:list';

    public function handle(ListsEndpoints $listsEndpoints): int
    {
        $process = $listsEndpoints->command()->execute();

        $process->getOutput();

        return self::SUCCESS;
    }
}
