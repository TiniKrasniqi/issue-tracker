<?php

namespace Database\Factories;

use App\Models\Comment;
use App\Models\Issue;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    protected $model = Comment::class;

    public function definition(): array
    {
        return [
            'issue_id'    => Issue::inRandomOrder()->value('id') ?? Issue::factory(),
            'author_name' => $this->faker->name(),
            'body'        => $this->faker->paragraph(),
        ];
    }
}
