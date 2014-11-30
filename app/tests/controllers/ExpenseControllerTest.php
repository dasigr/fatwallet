<?php

class ExpenseControllerTest extends TestCase
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
     *
     * @return void
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    public function testProvidesErrorFeedback()
    {
        $response = $this->call('GET', 'vi/expenses');
        $data = json_decode($response->getContent());

        $this->assertEquals(false, $data->error);
    }

    /**
     * Test fetching all expenses.
     *
     * @return void
     */
    public function testFetchesAllExpenses()
    {
        $response = $this->call('GET', 'v1/expenses');
        $content = $response->getContent();
        $data = json_decode($content);

        // Did we receive valid JSON?
        $this->assertJson($content);

        // Decoded JSON should offer an expense array
        $this->assertInternalType('array', $data->expenses);
    }
}