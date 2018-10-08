<?php

use Illuminate\Database\Seeder;

class PostsTableWithCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = factory('App\User', 10)->create();

        $users->each(function ($user) {
            factory('App\Post', 10)->create(['user_id' => $user->id]);
        });
    }
}
