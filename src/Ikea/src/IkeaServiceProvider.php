<?php

declare(strict_types=1);

namespace Verplanke\Ikea;

use Illuminate\Support\ServiceProvider;
use Verplanke\Ikea\Commands\Devices\GetDeviceInfoCommand;
use Verplanke\Ikea\Commands\Devices\ListDeviceCommand;
use Verplanke\Ikea\Commands\Groups\GetGroupInfoCommand;
use Verplanke\Ikea\Commands\Groups\ListGroupsCommand;
use Verplanke\Ikea\Commands\Groups\TurnOffGroupCommand;
use Verplanke\Ikea\Commands\Groups\TurnOnGroupCommand;
use Verplanke\Ikea\Commands\ListEndpointsCommand;
use Verplanke\Ikea\Contracts\Devices\GetsDeviceInfo;
use Verplanke\Ikea\Contracts\Devices\ListsDevices;
use Verplanke\Ikea\Contracts\Groups\GetsGroupInfo;
use Verplanke\Ikea\Contracts\Groups\ListsGroups;
use Verplanke\Ikea\Contracts\Groups\TurnsOffGroup;
use Verplanke\Ikea\Contracts\Groups\TurnsOnGroup;
use Verplanke\Ikea\Contracts\ListsEndpoints;
use Verplanke\Ikea\Endpoints\Devices\GetDeviceInfo;
use Verplanke\Ikea\Endpoints\Devices\ListDevices;
use Verplanke\Ikea\Endpoints\Groups\GetGroupInfo;
use Verplanke\Ikea\Endpoints\Groups\ListGroups;
use Verplanke\Ikea\Endpoints\Groups\TurnOffGroup;
use Verplanke\Ikea\Endpoints\Groups\TurnOnGroup;
use Verplanke\Ikea\Endpoints\ListEndpoints;

final class IkeaServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        if ($this->app->runningInConsole()) {
            $this->commands(
                commands: $this->registerCommands()
            );

            $this->publishes(paths: [
                __DIR__.'/../config/ikea.php' => config_path(path: 'ikea.php'),
            ], groups: 'ikea-config');
        }

        $this->loadMigrationsFrom(paths: __DIR__.'/../database/migrations');
    }

    public function register(): void
    {
        $this->mergeConfigFrom(path: __DIR__.'/../config/ikea.php', key: 'ikea-config');

        $this->bindCommands();
    }

    private function bindCommands(): void
    {
        // Available endpoints
        $this->app->bind(abstract: ListsEndpoints::class, concrete: ListEndpoints::class);

        // Groups
        $this->app->bind(abstract: GetsGroupInfo::class, concrete: GetGroupInfo::class);
        $this->app->bind(abstract: ListsGroups::class, concrete: ListGroups::class);
        $this->app->bind(abstract: TurnsOffGroup::class, concrete: TurnOffGroup::class);
        $this->app->bind(abstract: TurnsOnGroup::class, concrete: TurnOnGroup::class);

        // Devices
        $this->app->bind(abstract: ListsDevices::class, concrete: ListDevices::class);
        $this->app->bind(abstract: GetsDeviceInfo::class, concrete: GetDeviceInfo::class);
    }

    /**
     * @return array<class-string>
     */
    private function registerCommands(): array
    {
        return [
            ListEndpointsCommand::class,

            // Groups
            ListGroupsCommand::class,
            GetGroupInfoCommand::class,
            TurnOffGroupCommand::class,
            TurnOnGroupCommand::class,

            // Devices
            ListDeviceCommand::class,
            GetDeviceInfoCommand::class,
        ];
    }
}
