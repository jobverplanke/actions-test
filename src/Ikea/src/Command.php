<?php

declare(strict_types=1);

namespace Verplanke\Ikea;

use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process as SymfonyProcess;
use Verplanke\Ikea\Contracts\Command as CommandContract;

final class Command implements CommandContract
{
    public function __construct(
        private string $command
    ) {
    }

    public function execute(): SymfonyProcess
    {
        $process = SymfonyProcess::fromShellCommandline(command: $this->command);
        $process->run();

        if (! $process->isSuccessful()) {
            throw new ProcessFailedException(process: $process);
        }

        return $process;
    }

    public function run(): SymfonyProcess
    {
        return $this->execute();
    }
}
