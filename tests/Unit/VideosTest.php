<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Video;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class VideosTest.
 */
class VideosTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test  */
    public function videos_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('videos', [
                'id', 'user_id', 'title', 'url', 'description', 'size', 'length',
            ]));
    }

    /** @test  */
    public function a_video_morphs_many_comments()
    {
        $video = factory(Video::class)->create();

        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $video->comments);
    }
}
