<?php

namespace Tests\Unit;

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
}
