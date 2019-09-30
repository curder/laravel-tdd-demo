<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use App\Models\Post;
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
    public function comments_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('comments', [
                'id', 'user_id', 'post_id', 'body',
            ]));
    }

    /** @test */
    public function a_comment_belongs_to_a_post()
    {
        $user = factory(User::class)->create();
        $post = factory(Post::class)->create(['user_id' => $user->id]);
        $comment = factory(Comment::class)->create(['post_id' => $post->id]);

        // Method 1: Test by count that a comment has a parent relationship with post
        $this->assertEquals(2, $comment->post->count());

        // Method 2:
        $this->assertInstanceOf(Post::class, $comment->post);
    }
}
