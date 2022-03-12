<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Contracts;

interface Builder
{
    public function gatewayConfig(string $address = null, string $user = null, string $preSharedKey = null): void;
    public function command(): Command;
    public function getCommand(): string;
    public function setPayload(array $payload): void;
    public function setResource(string $resource): void;
}
