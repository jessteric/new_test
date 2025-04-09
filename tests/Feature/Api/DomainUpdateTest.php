<?php

namespace Tests\Feature\Api;

use App\Models\Domain;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DomainUpdateTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function test_it_updates_domain_name()
    {
        $user = User::factory()->create();
        $domain = Domain::create([
            'name' => 'old-domain.com',
        ]);

        $response = $this->actingAs($user)->putJson("/api/domains/{$domain->id}", [
            'name' => 'new-domain-name.com',
        ]);

        $response->assertStatus(200);

        $domain->refresh();
        $this->assertEquals('new-domain-name.com', $domain->name);
    }
}
