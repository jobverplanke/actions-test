<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Exceptions;

use RuntimeException;

final class JsonEncodingException extends RuntimeException
{
    public static function make(string $message = ''): JsonEncodingException
    {
        return new self(message: $message);
    }
}
