<?php

namespace App\Providers;

use App\Request;
use App\Services\DomainAccessManager;
use App\Services\UserAgentFilter;
use App\Services\IpAddressFilter;
use Illuminate\Http\Request as HttpRequest;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->alias('request', Request::class);
        $this->app->bind(HttpRequest::class, Request::class);

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