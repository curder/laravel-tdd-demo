<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use App\Models\Role;
use App\Models\Phone;
use Illuminate\Support\Facades\Schema;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class UserTest.
 */
class UserTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function users_database_has_expected_columns()
    {
        $this->assertTrue(
            Schema::hasColumns('users', [
                'id', 'name', 'email', 'email_verified_at', 'password',
            ]));
    }

    /** @test */
    public function a_user_has_a_phone()
    {
        $user = factory(User::class)->create();
        $phone = factory(Phone::class)->create(['user_id' => $user->id]);
        // Method 1:
        $this->assertInstanceOf(Phone::class, $user->phone);

        // Method 2:
        $this->assertEquals(1, $user->phone->count());
    }

    /** @test  */
    public function a_user_belongs_to_many_roles()
    {
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $user->roles);
    }
}
