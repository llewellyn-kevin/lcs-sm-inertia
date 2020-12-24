<?php

namespace Database\Factories;

use App\Models\Team;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TeamFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Team::class;

    /**
     * Converts a given string to a ticker symbol by taking
     * the first letter of each word and capitalizing the 
     * resulting string.
     * @param string $name
     * @return string
     */
    private function toSymbol(string $name): string
    {
        return strtoupper(
            implode('', 
                array_map(
                    fn($item) => $item[0], array_filter(
                        explode(' ', str_replace(
                            ['-', '_'], ' ', $name)
                        ), fn($item) => trim($item) !== ''
                    )
                )
            )
        );
    }

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Check if name has been set by user, otherwise use faker
        $team = new Team();
        $team = $this->states->last()->call($team);
        $name = isset($team['name']) ? $team['name'] : $this->faker->company;

        return [
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'symbol' => $this->toSymbol($name),
        ];
    }
}
