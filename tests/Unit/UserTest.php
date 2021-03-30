<?php

namespace Tests\Unit;

use App\Models\Image;
use App\Models\Phone;
use App\Models\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * Class UserTest.
 */
class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function users_database_has_expected_columns(): void
    {
        $this->assertTrue(
            Schema::hasColumns('users', [
                'id', 'name', 'email', 'email_verified_at', 'password',
            ])
        );
    }

    /** @test */
    public function a_user_has_a_phone(): void
    {
        $user = factory(User::class)->create();
        $phone = factory(Phone::class)->create(['user_id' => $user->id]);
        // Method 1:
        $this->assertInstanceOf(Phone::class, $user->phone);

        // Method 2:
        $this->assertEquals(1, $user->phone->count());
    }

    /** @test  */
    public function a_user_belongs_to_many_roles(): void
    {
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->roles);
    }

    /** @test */
    public function a_user_morphs_one_image(): void
    {
        $user = factory(User::class)->create();
        factory(Image::class)->create([
            'imageable_id' => $user->id,
            'imageable_type' => get_class($user),
        ]);
        $this->assertInstanceOf(Image::class, $user->image);
    }
}
