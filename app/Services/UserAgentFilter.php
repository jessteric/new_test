<?php

namespace App\Services;

use App\Models\Domain;
use App\Request;

class UserAgentFilter extends AbstractAccessDomainFilter
{
    protected function passes(Request $request, Domain $domain): bool
    {
        $userAgent = $request->header('User-Agent');

        $blockedUserAgents = config('domain_filters.domains.' . $domain->name . '.user_agents', []);

        return !in_array($userAgent, $blockedUserAgents);
    }
}