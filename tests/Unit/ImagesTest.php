<?php

namespace Tests\Unit;

use App\Models\Image;
use App\Models\Post;
use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class ImagesTest.
 */
class ImagesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function images_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('images', [
            'id', 'url', 'imageable_id', 'imageable_type',
        ]));
    }

    /** @test */
    public function an_image_can_be_uploaded_by_a_user() // morphedTo a USER
    {
        $user = factory(User::class)->create();

        $image = factory(Image::class)->create([
            'imageable_id'   => $user->id,
            'imageable_type' => get_class($user),
        ]);

        $this->assertInstanceOf(User::class, $image->imageable);
    }

    /** @test */
    public function an_image_can_be_uploaded_for_a_post()
    {
        $post = factory(Post::class)->create();

        $image = factory(Image::class)->create([
            "imageable_id" => $post->id,
            "imageable_type" => get_class($post),
        ]);
        $this->assertInstanceOf(Post::class, $image->imageable);
    }
}
