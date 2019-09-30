<?php

namespace Tests\Unit;

use App\Models\Phone;
use App\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class PhonesTest.
 */
class PhonesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function phones_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('phones', [
            'user_id',
        ]));
    }

    /** @test */
    public function a_phone_belongs_to_a_user()
    {
        $user = factory(User::class)->create();
        $phone = factory(Phone::class)->create(['user_id' => $user->id]);
        $this->assertInstanceOf(User::class, $phone->user);
    }
}
