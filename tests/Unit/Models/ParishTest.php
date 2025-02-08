<?php

namespace Rep98\Venezuela\Tests\Unit\Models;

use Rep98\Venezuela\Models\Parish;
use Rep98\Venezuela\Tests\TestCase;

class ParishTest extends TestCase
{
    /** @test */ 
    public function it_can_create_a_state()
    {
        $state = Parish::create([
            'name' => 'Charallave',
            'municipality_id' => 1,
        ]);

        $this->assertDatabaseHas('parishes', [
            'name' => 'Charallave',
            'municipality_id' => 1,
        ]);
    }
}