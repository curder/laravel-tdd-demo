<?php

namespace Tests\Unit\Api;

use App\User;
use Tests\TestCase;
use App\Models\Post;
use Ramsey\Uuid\Uuid;
use Illuminate\Support\Str;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class PostsTest.
 */
class PostsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /**
     * @test
     */
    public function it_can_create_a_post(): void
    {
        $data = [
            'user_id' => factory(User::class)->create()->id,
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
    public function it_can_delete_a_post(): void
    {
        $post = factory(Post::class)->create();

        $this->delete(route('api.posts.destroy', $post))
            ->assertStatus(200)
            ->assertJson($post->toArray());
    }

    /**
     * @test
     */
    public function it_can_update_a_post(): void
    {
        $post = factory(Post::class)->create();

        $updated_data = collect(factory(Post::class)->raw())->except('uuid')->toArray();

        $this->patch(route('api.posts.update', $post), $updated_data)
            ->assertOK()
            ->assertJson($updated_data);
    }

    /**
     * @test
     */
    public function it_can_show_posts(): void
    {
        $count = 10;
        $posts = factory(Post::class, $count)->create();

        $this->get(route('api.posts.index'))
            ->assertJsonCount($count)
            ->assertOk()
            ->assertJson($posts->toArray());
    }

    /** @test */
    public function it_can_show_post(): void
    {
        $post = factory(Post::class)->create();

        $this->get(route('api.posts.show', $post))
            ->assertOk()
            ->assertJson($post->toArray())
        ;
    }

    /** @test */
    public function it_can_generate_routes_with_the_uuid_attribute(): void
    {
        $model = factory(Post::class)->create();

        $this->assertInstanceOf(Post::class, $model);

        $this->assertStringContainsString($model->uuid->toString(), route('api.posts.show', $model));
    }

    /** @test */
    public function it_can_generates_valid_uuid_attribute_when_model_is_created(): void
    {
        $model = factory(Post::class)->create();

        $this->assertTrue(Uuid::isValid($model->uuid));
    }

    /** @test */
    public function it_does_not_overwrite_uuid_if_it_is_already_set(): void
    {
        $uuid = Str::orderedUuid();
        $model = factory(Post::class)->create(compact('uuid'));

        $this->assertEquals($uuid->toString(), $model->uuid->toString());
    }

    /** @test */
    public function it_does_not_overwrite_uuid_when_updating_the_model(): void
    {
        $uuid = Str::orderedUuid();
        $model = factory(Post::class)->create();
        $model->uuid = $uuid;
        $model->save();

        $this->assertNotEquals($uuid->toString(), $model->uuid->toString());
    }
}
