<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Replace by spatie/laravel-activitylog
 *
 * @property int $id
 * @property int $scheduler_id The id of the schedule command
 * @property string $status The status of the scheduled command after running (success or failed)
 * @property \Illuminate\Support\Carbon|null $last_run_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 */
class SchedulerLog extends Model
{
    use HasFactory;
}
