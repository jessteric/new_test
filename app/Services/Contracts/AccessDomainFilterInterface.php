<?php

namespace App\Services\Contracts;

use App\Models\Domain;
use App\Request;

interface AccessDomainFilterInterface
{
    public function check(Request $request, Domain $domain): bool;
    public function setNext(AccessDomainFilterInterface $next): AccessDomainFilterInterface;
}