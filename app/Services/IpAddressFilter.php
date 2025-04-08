<?php

namespace App\Services;

use App\Models\Domain;
use App\Request;

class IpAddressFilter extends AbstractAccessDomainFilter
{
    protected function passes(Request $request, Domain $domain): bool
    {
        $ip = $request->ip();

        return true;
    }
}