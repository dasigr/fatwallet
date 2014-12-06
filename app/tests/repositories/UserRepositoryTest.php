<?php

class UserRepositoryTest extends TestCase {

    protected $user;

    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    public function setUp()
    {
        parent::setUp();

        $this->user = App::make('UserRepository');

        // Create test database schema and test data
        Artisan::call('migrate');
        $this->seed();
    }

    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     */
    public function tearDown()
    {
        parent::tearDown();
    }

    /**
     * Test create methods saves.
     *
     * @return void
     */
    public function testCreateUser()
    {
        $test_user = array(
            'username' => 'engineering_test_' . time(),
            'email' => 'engineering_test_' . time() . '@a5project.com',
            'password' => '*test123',
            'password_confirmation' => '*test123'
        );

        $this->user->create($test_user);
        $user = User::where('username', '=', $test_user['username'])->first();

        $this->assertInstanceOf('User', $user);
        $this->assertEquals($test_user['username'], $user->username);
        $this->assertEquals($test_user['email'], $user->email);
    }
}