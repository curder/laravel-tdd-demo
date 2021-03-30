<?php

namespace Tests\Unit;

use App\Models\Role;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

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
