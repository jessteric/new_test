<?php

namespace App\Services;

use App\Models\Domain;
use App\Request;
use App\Services\Contracts\AccessDomainFilterInterface;

class DomainAccessManager
{
    private AccessDomainFilterInterface $filterChain;

    public function setFilterChain(AccessDomainFilterInterface $filterChain): void
    {
        $this->filterChain = $filterChain;
    }

    /**
     * @return AccessDomainFilterInterface
     */
    public function getFilterChain(): AccessDomainFilterInterface
    {
        return $this->filterChain;
    }

    /**
     * @param Request $request
     * @param Domain $domain
     * @return bool
     */
    public function checkAccess(Request $request, Domain $domain): bool
    {
        if (!isset($this->filterChain)) {
            throw new \RuntimeException('Filter chain is not configured');
        }

        return $this->filterChain->check($request, $domain);
    }
}