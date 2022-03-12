<?php

declare(strict_types=1);

namespace Verplanke\Ikea\Concerns;

use Illuminate\Console\Scheduling\Event;
use Illuminate\Console\Scheduling\Schedule as IlluminateSchedule;
use Illuminate\Support\Collection;
use Illuminate\Support\Stringable;
use Verplanke\Ikea\Commands\Groups\TurnOffGroupCommand;
use Verplanke\Ikea\Enums\SchedulerStatus;
use Verplanke\Ikea\Models\Scheduler as SchedulerModel;

/**
 * @mixin \App\Console\Kernel
 */
trait RegistersIkeaSchedules
{
    protected function registerIkeaSchedules(IlluminateSchedule $schedule)
    {
        $this->scheduler()
            ->each(callback: function (SchedulerModel $model) use ($schedule) {
                $this->registerSchedule(model: $model, schedule: $schedule);
            });

//        Scheduler::query()
//            ->get()
//            ->each(callback: function (Scheduler $item) use ($schedule) {
//                $this->runScheduler(scheduler: $item, schedule: $schedule);
//            });
    }

    protected function registerSchedule(SchedulerModel $model, IlluminateSchedule $schedule)
    {
        $timezone = $model->options->get(key: 'timezone');
        $parameters = $model->options->get(key: 'commandParameters');
        $addresses = $model->options->get(key: 'emailOnFailureAddresses'); // has to be an array
        $frequency = $model->options->get(key: 'frequency');

        $event = $schedule
            ->command(command: $model->command, parameters: $parameters)
            ->name(description: $model->name)
            ->timezone(timezone: $timezone)
            ->emailOutputOnFailure(addresses: $addresses)
            ->onSuccess(callback: function (Stringable $output) {
                // Send event for websockets (for app) with output?
            })
            ->onFailure(callback: function (Stringable $output) {
                // Send event for websockets (for app) with output?
            });

        $this->determineFrequency(frequency: $frequency, event: $event);
    }

    private function determineFrequency(array $frequency, Event $event): Event
    {
        $interval = (string) $frequency['interval'];

        if (! array_key_exists(key: 'value', array: $frequency)) {
            return $event->$interval();
        }

        $value = $frequency['value'];

        return $event->$interval($value);
    }

    /**
     * Scheduler Mock
     */
    protected function scheduler(): Collection
    {
        $scheduler = new SchedulerModel();
        $scheduler->user_id = 1;
        $scheduler->name = 'Scheduled Job Output for: ' . class_basename(class: TurnOffGroupCommand::class);
        $scheduler->command = TurnOffGroupCommand::class;
        $scheduler->status = SchedulerStatus::ENABLED->value;

        $scheduler->options = collect(value: [
            'timezone' => 'Europe/Amsterdam',
            'commandParameters' => [
                '131078',
            ],
            'emailOnFailureAddresses' => [
                'job@app.com',
                'job.verplanke@gmail.com'
            ],
            'frequency' => [
                'interval' => 'dailyAt',
                'value' => '23:30'
            ]
        ]);

        return collect(value: [$scheduler]);
    }
}
