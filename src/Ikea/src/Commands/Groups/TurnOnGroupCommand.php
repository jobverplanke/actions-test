<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Commands\Groups;

use Illuminate\Console\Command;
use Verplanke\Ikea\Contracts\Groups\TurnsOnGroup;

final class TurnOnGroupCommand extends Command
{
    /** @var string  */
    protected $signature = 'ikea:group:on {groupId}';

    public function handle(TurnsOnGroup $turnsOnGroup): int
    {
        $turnsOnGroup->setResource(
            resource: $this->argument(key: 'groupId'),
        );

        $process = $turnsOnGroup->command()->execute();

        $process->getOutput();

        $this->info(string: 'Lights On!');

        return self::SUCCESS;
    }
}
