<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProjectFactory extends Factory
{
    protected $model = Project::class;

    public function definition(): array
    {
        $start = $this->faker->dateTimeBetween('-1 month', '+1 week');

        return [
            'owner_id'    => User::inRandomOrder()->value('id'),
            'name'        => $this->faker->unique()->sentence(3),
            'description' => $this->faker->optional()->paragraph(),
            'start_date'  => $start,
            'deadline'    => $this->faker->optional()->dateTimeBetween($start, '+2 months'),
        ];
    }
}
