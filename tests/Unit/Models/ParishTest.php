<?php

namespace Rep98\Venezuela\Tests\Unit\Models;

use Rep98\Venezuela\Models\Parish;
use Rep98\Venezuela\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class ParishTest extends TestCase
{
    #[Test]
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