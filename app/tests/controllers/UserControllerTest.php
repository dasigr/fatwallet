<?php

class UserControllerTest extends TestCase
{
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
     * Test that user is authenticated.
     *
     * @return void
     */
    public function testMustBeAuthenticated()
    {
        Auth::logout();

        $response = $this->call('GET', 'v1/users');

        $this->assertEquals('Invalid credentials.', $response->getContent());
    }

    /**
     * Test that an error feedback is returned.
     *
     * @return void
     */
    public function testProvidesErrorFeedback()
    {
        $response = $this->call('GET', 'v1/users');
        $data = json_decode($response->getContent());

        $this->assertEquals(false, $data->error);
    }

    /**
     * Test that we get a valid json response.
     *
     * @return void
     */
    public function testReturnsValidJson()
    {
        $response = $this->call('GET', 'v1/users');

        $this->assertJson($response->getContent());
    }

    /**
     * Test fetching all users.
     *
     * @return void
     */
    public function testFetchesUsers()
    {
        $response = $this->call('GET', 'v1/users');
        $data = json_decode($response->getContent());

        $this->assertInternalType('array', $data->users);
    }
}