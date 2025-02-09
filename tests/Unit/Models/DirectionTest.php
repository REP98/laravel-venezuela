<?php

namespace Rep98\Venezuela\Tests\Unit\Models;

use PHPUnit\Framework\Attributes\Test;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Rep98\Venezuela\Models\Community;
use Rep98\Venezuela\Tests\TestCase;
use Rep98\Venezuela\Models\Direction;
use Rep98\Venezuela\Models\State;

class DirectionTest extends TestCase
{
    use RefreshDatabase;

    #[Test]
    public function it_can_register_a_new_direction()
    {
        $state = State::create(['name' => 'Bolivariano De Miranda', 'iso' => 'VE-M']);
        $data = Direction::register($state, 'Independencia', 'Cartanal', 'Rio uno');
  
        $this->assertInstanceOf(Community::class, $data);
        $this->assertEquals('Rio uno', $data->name);
        $this->assertEquals('Cartanal', $data->parish->name);
        $this->assertEquals('Independencia', $data->parish->municipality->name);
        $this->assertEquals('Bolivariano De Miranda', $data->parish->municipality->state->name);
    }

    #[Test]
    public function it_can_list_directions()
    {
        State::create(['name' => 'Bolivariano De Miranda', 'iso' => 'VE-M']);
        Direction::register('Bolivariano De Miranda', 'Independencia', 'Cartanal', 'Rio uno');
        Direction::register('Bolivariano De Miranda', 'Libertador', 'Charallave', 'Rio dos');

        $results = Direction::list(['state' => 'Bolivariano De Miranda']);
        
        $this->assertCount(2, $results);
    }

    #[Test]
    public function it_can_search_directions()
    {
        State::firstOrCreate(['name' => 'Bolivariano De Miranda', 'iso' => 'VE-M']);
        Direction::register('Bolivariano De Miranda', 'Independencia', 'Cartanal', 'Rio uno');
        Direction::register('Bolivariano De Miranda', 'Libertador', 'Charallave', 'Rio dos');

        $results = Direction::search('Rio');
        
        $this->assertCount(2, $results);
    }
}
