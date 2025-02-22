<?php

namespace Rep98\Venezuela\Tests\Unit\Models;

use Rep98\Venezuela\Models\Municipality;
use Rep98\Venezuela\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class MunicipalityTest extends TestCase
{
    #[Test]
    public function it_can_create_a_state()
    {
        $state = Municipality::create([
            'name' => 'Cristóbal Rojas',
            'state_id' => 1,
        ]);

        $this->assertDatabaseHas('municipalities', [
            'name' => 'Cristóbal Rojas',
            'state_id' => 1,
        ]);
    }
}