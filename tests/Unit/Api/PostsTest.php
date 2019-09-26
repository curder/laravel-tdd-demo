<?php

namespace Tests\Unit\Api;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PostsTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_create_a_post()
    {
        $data = [
            'title' => $this->faker->sentence,
            'body' => $this->faker->paragraph
        ];

        $this->post(route('api.posts.store'), $data)
            ->assertStatus(201)
            ->assertJson($data);
    }
}
