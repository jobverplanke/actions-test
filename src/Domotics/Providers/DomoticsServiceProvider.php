<?php

declare(strict_types=1);

namespace Verplanke\Domotics\Providers;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Support\ServiceProvider;
use Verplanke\Ikea\Commands\Groups\GetGroupInfoCommand;
use Verplanke\Ikea\Commands\Groups\TurnOffGroupCommand;
use Verplanke\Ikea\Contracts\Groups\GetsGroupInfo;
use Verplanke\Ikea\Contracts\Groups\ListsGroups;
use Verplanke\Ikea\Contracts\Groups\TurnsOffGroup;
use Verplanke\Ikea\Endpoints\Groups\GetGroupInfo;
use Verplanke\Ikea\Endpoints\Groups\ListGroups;
use Verplanke\Ikea\Endpoints\Groups\TurnOffGroup;

class DomoticsServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands(
                commands: $this->registerCommands()
            );
        }

        $this->bootScheduledCommands();
    }

    public function register(): void
    {
        $this->app->register(provider: RouteServiceProvider::class);

        $this->bindCommands();
    }

    /**
     * @return array<class-string>
     */
    private function registerCommands(): array
    {
        return [
            GetGroupInfoCommand::class
        ];
    }

    private function bindCommands(): void
    {
        $this->bindGroupCommands();
    }

    private function bindGroupCommands(): void
    {
        $this->app->bind(abstract: GetsGroupInfo::class, concrete: GetGroupInfo::class);
        $this->app->bind(abstract: TurnsOffGroup::class, concrete: TurnOffGroup::class);
        $this->app->bind(abstract: ListsGroups::class, concrete: ListGroups::class);
    }

    private function bootScheduledCommands(): void
    {
        $this->callAfterResolving(name: Schedule::class, callback: function (Schedule $schedule) {
            $schedule
                ->command(command: TurnOffGroupCommand::class, parameters: [
                    '131083'
                ])
                ->timezone(timezone: 'Europe/Amsterdam')
                ->dailyAt(time: '23:57');
        });
    }
}
