<?php

namespace Tests\Unit;

use App\Models\Video;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * Class VideosTest.
 */
class VideosTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test  */
    public function videos_database_has_expected_columns(): void
    {
        $this->assertTrue(
            Schema::hasColumns('videos', [
                'id', 'user_id', 'title', 'url', 'description', 'size', 'length',
            ])
        );
    }

    /** @test  */
    public function a_video_morphs_many_comments(): void
    {
        $video = factory(Video::class)->create();

        $this->assertInstanceOf(Collection::class, $video->comments);
    }
}
