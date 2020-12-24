<?php

namespace Database\Factories;

use App\Models\Split;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SplitFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Split::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // Check if name has been set by user, otherwise use faker
        $split = new Split();
        $split = $this->states->last()->call($split);
        $name = isset($split['name']) ? $split['name'] : $this->faker->company;

        return [
            'name' => $name,
            'slug' => Str::slug($name, '-'),
            'starts_at' => Carbon::now()->addMonths(-1),
            'ends_at' => Carbon::now()->addMonths(1),
        ];
    }
}
