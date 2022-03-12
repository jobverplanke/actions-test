<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Models;

use Illuminate\Database\Eloquent\Casts\AsCollection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Verplanke\Ikea\Enums\SchedulerStatus;


/**
 * @property int $id
 * @property int $user_id Schedule set by user
 * @property string $command The command to run
 * @property string|null $name The name/description for console and mail output
 * @property SchedulerStatus $status Enabled or disabled scheduled command
 * @property \Illuminate\Support\Collection $options JSON field with options on success or failure, send mail, notification etc.
 * @property \Illuminate\Support\Carbon|null $last_run_at
 * @property \Illuminate\Support\Carbon $created_at
 * @property \Illuminate\Support\Carbon $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static \Illuminate\Database\Query\Builder|Scheduler onlyTrashed()
 * @method static \Illuminate\Database\Query\Builder|Scheduler withTrashed()
 * @method static \Illuminate\Database\Query\Builder|Scheduler withoutTrashed()
 */
class Scheduler extends Model
{
    use SoftDeletes;
    use HasFactory;

    /**
     * @param string $table
     */
    public function setTable($table): void
    {
        $this->table = config(key: 'ikea.scheduler.table_name');
    }

    /**
     * @var array<string, class-string|string>
     */
    protected $casts = [
        'status' => SchedulerStatus::class,
        'options' => AsCollection::class,
        'last_run_at' => 'datetime'
    ];
}
