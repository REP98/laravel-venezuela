<?php

namespace Rep98\Venezuela\Tests\Unit\Models;

use Rep98\Venezuela\Models\State;
use Rep98\Venezuela\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class StateTest extends TestCase
{
    #[Test]
    public function it_can_create_a_state()
    {
        $state = State::create([
            'name' => 'Amazonas',
            'iso' => 'VE-X',
        ]);

        $this->assertDatabaseHas('states', [
            'name' => 'Amazonas',
            'iso' => 'VE-X',
        ]);
    }
}