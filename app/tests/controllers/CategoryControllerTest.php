<?php

class CategoryControllerTest extends TestCase {

    /**
     * Migrate and seed the test database.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        Route::enableFilters();

        Artisan::call('migrate');
        $this->seed();

        // Login as admin
        Auth::loginUsingId(1);
    }

    /**
     * Perform test clean-up.
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Test fetching all categories
     *
     * @return void
     */
    public function testFetchesAllCategories()
    {
        $response = $this->call('GET', 'v1/categories');
        $data = json_decode($response->getContent());

        $this->assertFalse($data->error);
        $this->assertInternalType('array', $data->categories);
    }

    /**
     * Test API call for fetching a category.
     *
     * @return void
     */
    public function testFetchCategory()
    {
        $response = $this->call('GET', 'v1/categories');
        $data = json_decode($response->getContent());

        $this->assertArrayHasKey('error', $data);
        $this->assertArrayHasKey('category', $data);

        $category = $data['category'];
        $this->assertArrayHasKey('id', $category);
        $this->assertArrayHasKey('name', $category);
        $this->assertArrayHasKey('parent', $category);
        $this->assertArrayHasKey('created_at', $category);
        $this->assertArrayHasKey('updated_at', $category);
        $this->assertArrayHasKey('deleted_at', $category);

        $this->assertFalse($data->error);
    }
}