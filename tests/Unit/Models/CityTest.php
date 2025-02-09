<?php

namespace Rep98\Venezuela\Tests\Unit\Models;

use Rep98\Venezuela\Models\City;
use Rep98\Venezuela\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;
class CityTest extends TestCase
{
    #[Test]
    public function it_can_create_a_state()
    {
        $state = City::create([
            'name' => 'Los Teques',
            'state_id' => 1,
        ]);

        $this->assertDatabaseHas('cities', [
            'name' => 'Los Teques',
            'state_id' => 1,
        ]);
    }
}
