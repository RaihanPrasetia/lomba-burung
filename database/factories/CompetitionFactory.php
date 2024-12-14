<?php

namespace Database\Factories;

use App\Models\Competition;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CompetitionFactory extends Factory
{
    protected $model = Competition::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->company,
            'pdf_link' => $this->faker->url,
            'status' => $this->faker->randomElement(['Selesai', 'Berlangsung', 'Akan Datang']),
            'date' => $this->faker->date(),
        ];
    }
}
