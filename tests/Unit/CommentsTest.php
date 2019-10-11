<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use App\Models\Post;
use App\Models\Video;
use App\Models\Comment;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class CommentsTest.
 */
class CommentsTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test  */
    public function comments_database_has_expected_columns(): void
    {
        $this->assertTrue(
            Schema::hasColumns('comments', [
                'id', 'user_id', 'post_id', 'body',
            ]));
    }

    /** @test */
    public function a_comment_belongs_to_a_post(): void
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(['user_id' => $user->id]);
        $comment = factory(Comment::class)->create(['post_id' => $post->id]);

        // Method 1: Test by count that a comment has a parent relationship with post
        $this->assertEquals(2, $comment->post->count());

        // Method 2:
        $this->assertInstanceOf(Post::class, $comment->post);
    }

    /** @test */
    public function a_comment_can_be_morphed_to_a_video_model(): void
    {
        $video = factory(Video::class)->create();

        $comment = factory(Comment::class)->create([
            'commentable_id' => $video->id,
            'commentable_type' => get_class($video),
        ]);
        $this->assertInstanceOf(Video::class, $comment->commentable);
    }

    /** @test */
    public function a_comment_can_be_morphed_to_a_post_model(): void
    {
        $post = factory(Post::class)->create();

        $comment = factory(Comment::class)->create([
            'commentable_id' => $post->id,
            'commentable_type' => get_class($post),
        ]);
        $this->assertInstanceOf(Post::class, $comment->commentable);
    }
}
