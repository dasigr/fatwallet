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

        // Migrate and seed the test database.
        Artisan::call('migrate');
        $this->seed();
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
     * Test fetching all expenses.
     *
     * @return void
     */
    public function testFetchesAllUsers()
    {
        $response = $this->call('GET', 'v1/users');
        $content = $response->getContent();
        $data = json_decode($content);
        print_r($data);

        // Did we receive valid JSON?
        $this->assertJson($content);

        // Decoded JSON should offer an expense array
        $this->assertInternalType('array', $data->expenses);
    }
}