<?php

namespace App\Services;

use App\Models\Domain;
use App\Request;
use App\Services\Contracts\AccessDomainFilterInterface;

abstract class AbstractAccessDomainFilter implements AccessDomainFilterInterface
{
    private ?AccessDomainFilterInterface $next = null;

    /**
     * @param AccessDomainFilterInterface $next
     * @return AccessDomainFilterInterface
     */
    public function setNext(AccessDomainFilterInterface $next): AccessDomainFilterInterface
    {
        $this->next = $next;
        return $next;
    }

    /**
     * @param Request $request
     * @param Domain $domain
     * @return bool
     */
    public function check(Request $request, Domain $domain): bool
    {
        if (!$this->passes($request, $domain)) {
            return false;
        }

        if ($this->next !== null) {
            return $this->next->check($request, $domain);
        }

        return true;
    }

    /**
     * @param Request $request
     * @param Domain $domain
     * @return bool
     */
    abstract protected function passes(Request $request, Domain $domain): bool;
}