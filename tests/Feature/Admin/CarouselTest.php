<?php

namespace Tests\Feature\Admin;

use App\User;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class CarouselTest.
 */
class CarouselTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function it_can_show_the_create_carousel_page()
    {
        $employee = factory(User::class)->create();

        $this->actingAs($employee, 'admin')
            ->get(route('admin.carousel.create'))
            ->assertStatus(200)
            ->assertSee('Title')
            ->assertSee('Link')
            ->assertSee('Image');
    }

    /** @test */
    public function it_can_create_the_carousel()
    {
        $file = UploadedFile::fake()->create('image.jpg');
        $data = [
            'title' => $this->faker->word,
            'link' => $this->faker->url,
            'image' => $file,
        ];

        $employee = factory(User::class)->create();

        $this
            ->actingAs($employee, 'admin')
            ->post(route('admin.carousel.store'), $data)
            ->assertStatus(302)
            ->assertRedirect(route('admin.carousel.index'))
            ->assertSessionHas('message', 'Create carousel successful!');
    }
}
