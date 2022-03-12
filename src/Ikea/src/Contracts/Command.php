<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Contracts;

use Symfony\Component\Process\Process;

interface Command
{
    public function execute(): Process;
    public function run(): Process;
}
