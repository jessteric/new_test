<?php

namespace App\Providers;

use App\Services\DomainAccessManager;
use App\Services\UserAgentFilter;
use App\Services\IpAddressFilter;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->singleton(DomainAccessManager::class, function () {
            $manager = new DomainAccessManager();

            $userAgentFilter = new UserAgentFilter();
            $ipFilter = new IpAddressFilter();
            $userAgentFilter->setNext($ipFilter);

            $manager->setFilterChain($userAgentFilter);
            return $manager;
        });
    }

    public function boot(): void
    {
        //
    }
}