<?php

namespace Tests\Unit;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class FakerTest extends TestCase
{
    use WithFaker;

    /**
     * @test
     */
    public function faker_is_failing(): void
    {
        $count = 90;
        $data = [];

        for ($i = 0; $i < $count; $i++) {
            $data[$this->faker->unique()->word()] = User::factory()->make();
        }

        $this->assertCount($count, $data);
    }

    public function test_faker_is_working()
    {
        Hash::shouldReceive('make')->andReturn('fakehashedvalue');

        $faker = \Faker\Factory::create();
        $name = $faker->name;

        $this->assertNotNull($name);
    }
}
