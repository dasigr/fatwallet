<?php

class CategoryRespositoryTest extends TestCase {

    protected $category;

    /**
     * Sets up the fixture.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->category = App::make('CategoryRepository');

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
    public function testAll()
    {
        $categories = Category::all();

        $result = $this->category->all();

        $this->assertInternalType('array', $result['categories']);
    }
}