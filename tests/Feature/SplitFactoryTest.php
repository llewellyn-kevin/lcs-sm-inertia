<?php

namespace Tests\Feature;

use App\Models\Split;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class SplitFactoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_team_model()
    {
        $split = Split::factory()->make(['name' => 'hello  world']);
        $this->assertInstanceOf(Split::class, $split);
        Split::factory()->count(5)->create();
        $this->assertDatabaseCount('splits', 5);
    }

    /** dataProvider */
    public function symbolProvider()
    {
        return [
            ['one', 'one'],
            ['two words', 'two-words'],
            ['', '', ''],
            ['Capital Letters', 'capital-letters'],
            ['includes number 9', 'includes-number-9'],
            ['big   space', 'big-space'],
        ];
    }

    /** 
     * @test 
     * @dataProvider symbolProvider
     */
    public function it_generates_slug_based_on_name($input, $slug)
    {
        $split = Split::factory()->make(['name' => $input]);
        $this->assertEquals($split->slug, $slug);
    }
}
