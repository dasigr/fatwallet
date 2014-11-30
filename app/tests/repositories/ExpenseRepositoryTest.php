<?php

class ExpenseRepositoryTest extends TestCase
{
    /**
     * Migrate and seed the test database.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->repo = App::make('UserRepository');

        // Migrate and seed the test database.
        Artisan::call('migrate');
        $this->seed();
    }

    /**
     * Perform test clean-up.
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Test that all() method returns a User Collection.
     *
     * @return void
     */
    public function testAllReturnsCollection()
    {
        $users = $this->repo->all();

        $this->assertTrue($users instanceof Collection);
    }
}