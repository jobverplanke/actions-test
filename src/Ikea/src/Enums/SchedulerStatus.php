<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Enums;

enum SchedulerStatus: string
{
    case ENABLED = 'enabled';
    case DISABLED = 'disabled';

    /**
     * Only for logging purposes.
     */
    case SUCCESS = 'success';
    case FAILED = 'failed';
}
