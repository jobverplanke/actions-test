<?php

declare(strict_types=1);

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Verplanke\Ikea\Concerns\RegistersIkeaSchedules;

class Kernel extends ConsoleKernel
{
    use RegistersIkeaSchedules;

    /** @var array<class-string>  */
    protected $commands = [
    ];

    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $this->registerIkeaSchedules(schedule: $schedule);
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        require base_path(path: 'routes/console.php');
    }
}
