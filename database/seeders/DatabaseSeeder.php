<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\Issue;
use App\Models\Tag;
use App\Models\Comment;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run()
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
        ]);

        // Core demo data
        $tags = Tag::factory()->count(8)->create();

        Project::factory()
            ->count(5)
            ->create()
            ->each(function (Project $project) use ($tags) {
                $issues = Issue::factory()->count(8)->create([
                    'project_id' => $project->id,
                ]);

                // attach random tags and comments
                $issues->each(function (Issue $issue) use ($tags) {
                    $issue->tags()->sync($tags->random(rand(1,3))->pluck('id')->all());
                    Comment::factory()->count(rand(0,3))->create([
                        'issue_id' => $issue->id,
                    ]);
                });
            });

        $users = User::pluck('id'); 

        Issue::inRandomOrder()->take(10)->each(function (Issue $issue) use ($users) {
            if ($users->isEmpty()) {
                return; 
            }

            $max = min(3, $users->count());
            $take = rand(1, $max); // between 1 and available users
            $ids = $users->shuffle()->take($take)->all();

            $issue->users()->sync($ids);
        });
    }
    
}
