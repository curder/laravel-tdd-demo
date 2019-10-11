<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use App\Models\Role;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

/**
 * Class RolesTest.
 */
class RolesTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test */
    public function roles_database_has_expected_columns(): void
    {
        $this->assertTrue(Schema::hasColumns('roles', [
            'id', 'title', 'description',
        ]));
    }

    /** @test */
    public function a_role_belongs_to_many_users(): void
    {
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();
        $this->assertInstanceOf(Collection::class, $role->users);
    }
}
