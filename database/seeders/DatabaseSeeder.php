<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        $user = User::factory()->hasFeedbacks(1)->create([
             'name' => 'ahmad',
             'email' => 'ahmad@ikonic.com',
         ]);
         Comment::factory()->for($user)->create([
             'content' =>  "Hello,  <a href='' class='text-indigo-600'>@$user->name</a>"
         ]);
        $user2 = User::factory()->hasFeedbacks(1)->create([
             'name' => 'ali',
             'email' => 'ali@ikonic.com',
         ]);
         Comment::factory()->for($user)->create([
             'content' =>  "Hello,  <a href='' class='text-indigo-600'>@$user2->name</a>"
         ]);
    }
}
