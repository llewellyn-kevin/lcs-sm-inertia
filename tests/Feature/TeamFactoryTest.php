<?php

namespace Tests\Feature;

use App\Models\Team;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TeamFactoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_team_model()
    {
        $team = Team::factory()->make(['name' => 'hello  world']);
        $this->assertInstanceOf(Team::class, $team);
        Team::factory()->count(5)->create();
        $this->assertDatabaseCount('teams', 5);
    }

    /** dataProvider */
    public function symbolProvider()
    {
        return [
            ['one', 'one', 'O'],
            ['two words', 'two-words', 'TW'],
            ['', '', ''],
            ['Capital Letters', 'capital-letters', 'CL'],
            ['includes number 9', 'includes-number-9', 'IN9'],
            ['big   space', 'big-space', 'BS'],
        ];
    }

    /** 
     * @test 
     * @dataProvider symbolProvider
     */
    public function it_generates_slug_and_symbol_based_on_name($input, $slug, $symbol)
    {
        $team = Team::factory()->make(['name' => $input]);
        $this->assertEquals($team->slug, $slug);
        $this->assertEquals($team->symbol, $symbol);
    }

    /** @test */
    public function it_can_override_default_slug_and_symbol()
    {
        $team = Team::factory()->make([
            'name' => 'team name',
            'slug' => 'team-name-slug',
            'symbol' => 'TNS',
        ]);
        $this->assertEquals($team->slug, 'team-name-slug');
        $this->assertEquals($team->symbol, 'TNS');
    }
}
