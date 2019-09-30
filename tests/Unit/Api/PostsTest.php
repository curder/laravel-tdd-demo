<?php

namespace Tests\Unit\Api;

use Tests\TestCase;
use App\Models\Post;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class PostsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function posts_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('posts', [
                'id', 'title', 'description', 'body',
            ]));
    }

    /**
     * @test
     */
    public function it_can_create_a_post()
    {
        $data = [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph,
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
            ->assertOK()
            ->assertJson($updated_data);
    }

    /**
     * @test
     */
    public function it_can_show_posts()
    {
        $count = 10;
        $posts = factory(Post::class, $count)->create();

        $this->get(route('api.posts.index'))
            ->assertJsonCount($count)
            ->assertOk()
            ->assertJson($posts->toArray());
    }
}
