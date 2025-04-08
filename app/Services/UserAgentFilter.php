<?php

namespace App\Services;

use App\Models\Domain;
use App\Request;

class UserAgentFilter extends AbstractAccessDomainFilter
{
    protected function passes(Request $request, Domain $domain): bool
    {
        $userAgent = $request->header('User-Agent');

        return true;
    }
}