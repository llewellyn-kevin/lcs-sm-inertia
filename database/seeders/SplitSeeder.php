<?php

namespace Database\Seeders;

use App\Models\Split;
use Carbon\Carbon;
use Illuminate\Database\Seeder;

class SplitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Split::factory()->create([
            'name' => 'Past Split',
            'starts_at' => Carbon::now()->addMonths(-12),
            'ends_at' => Carbon::now()->addMonths(-6),
        ]);
        Split::factory()->create([
            'name' => 'Present Split',
            'starts_at' => Carbon::now()->addMonths(-2),
            'ends_at' => Carbon::now()->addMonths(2),
        ]);
        Split::factory()->create([
            'name' => 'Future Split',
            'starts_at' => Carbon::now()->addMonths(6),
            'ends_at' => Carbon::now()->addMonths(12),
        ]);
    }
}
