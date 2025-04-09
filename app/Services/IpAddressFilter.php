<?php

namespace App\Services;

use App\Models\Domain;
use App\Request;

class IpAddressFilter extends AbstractAccessDomainFilter
{
    // specified blocked IP's
    private array $blockedIps = ['192.168.1.1', '10.0.0.1'];

    /**
     * @param Request $request
     * @param Domain $domain
     * @return bool
     */
    protected function passes(Request $request, Domain $domain): bool
    {
        $ip = $request->ip();

        $blockedIps = config('domain_filters.domains.' . $domain->name . '.blocked_ips', []);

        return !in_array($ip, $blockedIps);
    }
}