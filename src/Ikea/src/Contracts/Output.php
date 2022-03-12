<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Contracts;

interface Output
{
    public function getId(): int;
    public function getName(): string;
}
