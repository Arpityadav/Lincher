<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadPostsTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_authenticated_user_can_view_all_post_in_recent_post_page()
    {
        $user = factory('App\User')->create();

        $post = factory('App\Post')->create();

        $this->be($user);

        $this->get('?viewBy=latest')
            ->assertSee($post->body);
    }
}
