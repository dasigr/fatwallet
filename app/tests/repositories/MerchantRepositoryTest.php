<?php

class MerchantRepositoryTest extends TestCase {

    protected $merchant;

    /**
     * Sets up the fixture.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->merchant = App::make('MerchantRepository');

        // Create test database schema and test data
        Artisan::call('migrate');
        $this->seed();
    }

    /**
     * Tears down the fixture.
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Test all method returns all categories.
     *
     * @return void
     */
    public function testAllMerchants()
    {
        $merchants = Merchant::all()->toArray();

        $result = $this->merchant->all();

        $this->assertFalse($result['error']);
        $this->assertEquals($merchants, $result['merchants']);
    }
}