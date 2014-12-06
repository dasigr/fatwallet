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
     * Test create method saves.
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

    /**
     * Test update method saves.
     *
     * @return void
     */
    public function testUpdateUser()
    {
        // Create a user
        $user = new User;
        $user->username = 'engineering_test_' . time() . '_' . rand(1000, 9999);
        $user->email = 'engineering_test_' . time() . '_' . rand(1000, 9999) . '@a5project.com';
        $user->password = '*test123';
        $user->save();

        $updated_user_fields = array(
            'username' => 'engineering_test_' . time() . rand(1000, 9999),
            'email' => 'engineering_test_' . time() . rand(1000, 9999) . '_updated@a5project.com'
        );

        $this->user->update($user->id, $updated_user_fields);
        $updated_user = User::find($user->id);

        $this->assertInstanceOf('User', $updated_user);
        $this->assertEquals($updated_user_fields['username'], $updated_user->username);
        $this->assertEquals($updated_user_fields['email'], $updated_user->email);
    }
}