<?php

namespace Tests\Unit;

use App\Models\Role;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * Class RolesTest
 *
 * @package Tests\Unit
 */
class RolesTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /** @test */
    public function roles_database_has_expected_columns()
    {
        $this->assertTrue(Schema::hasColumns('roles', [
            'id', 'title', 'description'
        ]));
    }

    /** @test */
    public function a_role_belongs_to_many_users()
    {
        $user = factory(User::class)->create();
        $role = factory(Role::class)->create();
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $role->users);
    }
}
