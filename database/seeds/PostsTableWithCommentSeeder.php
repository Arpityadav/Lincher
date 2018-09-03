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
        $posts = factory('App\Post', 10)->create();

        $posts->each(function ($post) {
            factory('App\Comment', 10)->create(['post_id' => $post->id]);
        });
    }
}
