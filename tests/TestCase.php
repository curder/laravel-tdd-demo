<?php

namespace Tests;

use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations, DatabaseTransactions;

    /**
     * @var Faker
     */
    protected $faker;

    /**
     * Set up the test
     */
    protected function setUp(): void
    {
        parent::setUp();
        $this->faker = Faker::create();
    }

    /**
     * Reset the migrations
     */
    protected function tearDown(): void
    {
        $this->artisan('migrate:reset');
        parent::tearDown();
    }
}
