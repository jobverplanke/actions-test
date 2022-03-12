<?php

declare(strict_types=1);

namespace Verplanke\Ikea;

final class GatewayConfig
{
    public function __construct(
        public readonly string $address,
        public readonly string $user,
        public readonly string $preSharedKey,
    ) {

    }

    public static function initialize(string $address, string $user, string $preSharedKey): GatewayConfig
    {
        return new GatewayConfig(address: $address, user: $user, preSharedKey: $preSharedKey);
    }
}
