<?php

namespace Database\Seeders;

use App\Models\Post;
use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Post::factory(5)->create()
        ->each(function($post) {
            $post->tags()->saveMany(
                Tag::factory()
                ->count(1)
                ->create()
            );
        });
    }
}
