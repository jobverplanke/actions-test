<?php

declare(strict_types=1);

namespace Verplanke\Domotics\Domain\Exceptions;

use RuntimeException;

class JsonEncodingException extends RuntimeException
{
    public static function make(string $message = ''): JsonEncodingException
    {
        return new self(message: $message);
    }
}
