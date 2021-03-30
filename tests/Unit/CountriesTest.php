<?php

namespace Tests\Unit;

use App\Models\Country;
use App\Models\Post;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * Class CountriesTest.
 */
class CountriesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test  */
    public function countries_database_has_expected_columns(): void
    {
        $this->assertTrue(
            Schema::hasColumns('countries', [
                'id', 'title', 'population',
            ])
        );
    }

    /** @test */
    public function a_country_has_many_posts_through_user(): void
    {
        $country = factory(Country::class)->create();
        $user = factory(User::class)->create(['country_id' => $country->id]);
        $post = factory(Post::class)->create(['user_id' => $user->id]);

        // Method 1:
        $this->assertTrue($country->posts->contains($post));

        // Method 2:
        $this->assertEquals(1, $country->posts->count());
        // Method 3:
        $this->assertInstanceOf(Collection::class, $country->posts);
    }
}
