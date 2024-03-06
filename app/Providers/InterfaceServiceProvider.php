<?php

namespace App\Providers;

use App\Interfaces\ICompanyService;
use App\Interfaces\IModuleService;
use App\Interfaces\IRoleService;
use App\Interfaces\ITicketService;
use App\Interfaces\IUserService;
use App\Services\CompanyService;
use App\Services\ModuleService;
use App\Services\RoleService;
use App\Services\TicketService;
use App\Services\UserService;
use Illuminate\Support\ServiceProvider;

class InterfaceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(
            IUserService::class,
            UserService::class
        );

        $this->app->bind(
            ICompanyService::class,
            CompanyService::class
        );

        $this->app->bind(
            IModuleService::class,
            ModuleService::class
        );

        $this->app->bind(
            IRoleService::class,
            RoleService::class
        );
        $this->app->bind(
            ITicketService::class,
            TicketService::class
        );


    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
