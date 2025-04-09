<?php

use App\Models\Domain;
use App\Request;
use App\Services\DomainAccessManager;
use App\Services\IpAddressFilter;
use Tests\TestCase;

class DomainAccessManagerTest extends TestCase
{

    /**
     * @test
     */
    public function test_it_denies_access_if_ip_is_blocked()
    {
        $domain = Domain::factory()->create([
            'name' => 'example1.com',
        ]);

        config(['domain_filters.domains.example.com.blocked_ips' => ['192.168.1.1']]);

        $request = Request::create('/', 'GET', [], [], [], ['REMOTE_ADDR' => '192.168.1.1']);

        $manager = app(DomainAccessManager::class);
        $blockedIpFilter = new IpAddressFilter();
        $manager->setFilterChain($blockedIpFilter);

        $this->assertFalse($manager->checkAccess($request, $domain));
    }

    public function test_it_allows_access_if_ip_is_not_blocked()
    {
        $domainName = 'example' . uniqid() . '.com';

        $domain = Domain::factory()->create([
            'name' => $domainName,
        ]);

        config(['domain_filters.domains.' . $domainName . '.blocked_ips' => ['192.168.1.1']]);

        $request = Request::create('/', 'GET', [], [], [], ['REMOTE_ADDR' => '192.168.2.1']);

        $manager = app(DomainAccessManager::class);
        $blockedIpFilter = new IpAddressFilter();
        $manager->setFilterChain($blockedIpFilter);

        $this->assertTrue($manager->checkAccess($request, $domain));
    }
}