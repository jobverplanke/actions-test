<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Commands\Groups;

use Illuminate\Console\Command;
use Verplanke\Ikea\Contracts\Groups\TurnsOffGroup;

final class TurnOffGroupCommand extends Command
{
    /** @var string  */
    protected $signature = 'ikea:group:off {groupId}';

    public function handle(TurnsOffGroup $turnsOffGroup): int
    {
        $turnsOffGroup->setResource(
            resource: $this->argument(key: 'groupId'),
        );

        $process = $turnsOffGroup->command()->execute();

        $process->getOutput();

        $this->info(string: 'Lights Off!');

        return self::SUCCESS;
    }
}
