<?php

namespace Tests\Unit;

use App\Models\Comment;
use App\Models\Image;
use App\Models\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

class PostsTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function posts_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('posts', [
                'id', 'user_id', 'title', 'description', 'body',
            ]));
    }

    /** @test */
    public function a_post_has_many_comments()
    {
        $user    = factory(User::class)->create();
        $post    = factory(Post::class)->create(['user_id' => $user->id]);
        $comment = factory(Comment::class)->create(['post_id' => $post->id]);

        // Method 1: A comment exists in a post's comment collections.
        $this->assertTrue($post->comments->contains($comment));

        // Method 2: Count that a post comments collection exists.
        $this->assertEquals(1, $post->comments->count());
        // Method 3: Comments are related to posts and is a collection instance.
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $post->comments);
    }

    /** @test */
    public function a_post_morphs_one_image()
    {
        $post = factory(Post::class)->create();
        factory(Image::class)->create([
            'imageable_id'   => $post->id,
            'imageable_type' => get_class($post),
        ]);

        $this->assertInstanceOf(Image::class, $post->image);
    }
}
