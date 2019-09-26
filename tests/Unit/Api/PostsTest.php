<?php

namespace Tests\Unit\Api;

use App\Models\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_create_a_post()
    {
        $data = [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph
        ];

        $this->post(route('api.posts.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }

    /**
     * @test
     */
    public function it_can_delete_a_post()
    {
        $post = factory(Post::class)->create();

        $this->delete(route('api.posts.destroy', $post))
            ->assertStatus(200)
            ->assertJson($post->toArray());
    }


    /**
     * @test
     */
    public function it_can_update_a_post()
    {
        $post = factory(Post::class)->create();

        $updated_data = factory(Post::class)->raw();

        $this->patch(route('api.posts.update', $post), $updated_data)
            // ->assertOK()
            ->assertJson($updated_data);
    }
}
