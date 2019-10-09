<?php

namespace Tests\Unit;

use App\Models\Carousel;
use App\Repositories\CarouselRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

/**
 * Class CarouselTest
 *
 * @package Tests\Unit
 */
class CarouselTest extends TestCase
{
    use RefreshDatabase, WithFaker;

   /** @test */
   public function it_can_create_a_carousel()
   {
       $data = [
           'title' => $this->faker->word,
           'link' => $this->faker->url,
           'src' => $this->faker->url,
       ];

       $carouselRepo = new CarouselRepository(new Carousel);
       $carousel = $carouselRepo->createCarousel($data);

       $this->assertInstanceOf(Carousel::class, $carousel);
       $this->assertEquals($data['title'], $carousel->title);
       $this->assertEquals($data['link'], $carousel->link);
       $this->assertEquals($data['src'], $carousel->src);
   }

   /** @test */
   public function it_can_show_the_carousel()
   {
       $carousel = factory(Carousel::class)->create();
       $carouselRepo = new CarouselRepository(new Carousel);
       $found = $carouselRepo->findCarousel($carousel->id);

       $this->assertInstanceOf(Carousel::class, $found);
       $this->assertEquals($found->title, $carousel->title);
       $this->assertEquals($found->link, $carousel->link);
       $this->assertEquals($found->src, $carousel->src);
   }


}
