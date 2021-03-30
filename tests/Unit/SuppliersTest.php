<?php

namespace Tests\Unit;

use App\Models\History;
use App\Models\Supplier;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Schema;
use Tests\TestCase;

/**
 * Class SuppliersTest.
 */
class SuppliersTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    /** @test  */
    public function suppliers_database_has_expected_columns(): void
    {
        $this->assertTrue(
            Schema::hasColumns('suppliers', [
                'id', 'name', 'services',
            ])
        );
    }

    /** @test */
    public function a_supplier_has_an_history_through_user(): void
    {
        $supplier = factory(Supplier::class)->create();
        $user = factory(User::class)->create(['supplier_id' => $supplier->id]);
        $history = factory(History::class)->create(['user_id' => $user->id]);

        // Method 1:
        $this->assertInstanceOf(History::class, $supplier->userHistory);

        // Method 2:
        $this->assertEquals(1, $supplier->userHistory->count());
    }
}
