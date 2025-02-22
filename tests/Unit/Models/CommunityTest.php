<?php

namespace Rep98\Venezuela\Tests\Unit\Models;

use Rep98\Venezuela\Models\Community;
use Rep98\Venezuela\Tests\TestCase;
use PHPUnit\Framework\Attributes\Test;

class CommunityTest extends TestCase
{
    #[Test]
    public function it_can_create_a_state()
    {
        $state = Community::create([
            'name' => 'Vista Fresca',
            'parish_id' => 1,
        ]);

        $this->assertDatabaseHas('communities', [
            'name' => 'Vista Fresca',
            'parish_id' => 1,
        ]);
    }
}