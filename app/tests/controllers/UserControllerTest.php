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

        $this->assertInstanceOf('stdClass', $data->users);
    }

    /**
     * Test fetching all users defaults to 15 users per page.
     *
     * @return void
     */
    public function testFetchesUsersDefaultsToFifteenUsersPerPage()
    {
        $response = $this->call('GET', 'v1/users');
        $data = json_decode($response->getContent());

        $this->assertEquals(15, $data->users->per_page);
    }

    /**
     * Test fetching all users returns expected number of users.
     *
     * @return void
     */
    public function testFetchesUsersPerPage()
    {
        $params = '?perPage=3';

        $response = $this->call('GET', 'v1/users' . $params);
        $data = json_decode($response->getContent());

        $this->assertEquals(3, count($data->users->data));
    }

    /**
     * Test fetching all users defaults to sorted descending by date created.
     *
     * @return void
     */
    public function testFetchesUsersDefaultsToSortedDescendingByDateCreated()
    {
        $response = $this->call('GET', 'v1/users');
        $data = json_decode($response->getContent());
        $actual_users = $users = $data->users->data;

        usort($users, function($a, $b)
        {
            if ($a->created_at == $b->created_at) {
                return 0;
            }

            return ($a->created_at > $b->created_at) ? -1 : 1;
        });

        $this->assertEquals($users, $actual_users);
    }

    /**
     * Test fetching all users with invalid perPage parameter.
     *
     * @expectedException InvalidArgumentException
     * @return void
     */
    public function testFetchesUsersWithInvalidPerPageArgument()
    {
        $params = '?perPage=bar';

        $response = $this->call('GET', 'v1/users' . $params);
    }

    /**
     * Test fetching all users with invalid orderBy parameter.
     *
     * @expectedException InvalidArgumentException
     * @return void
     */
    public function testFetchesUsersWithInvalidOrderByArgument()
    {
        $params = '?orderBy=bar';

        $response = $this->call('GET', 'v1/users' . $params);
    }

    /**
     * Test fetching all users with invalid sort parameter.
     *
     * @expectedException InvalidArgumentException
     * @return void
     */
    public function testFetchesUsersWithInvalidSortArgument()
    {
        $params = '?sort=bar';

        $response = $this->call('GET', 'v1/users' . $params);
    }

    /**
     * Test fetching all users sorted ascending by date created.
     *
     * @return void
     */
    public function testFetchesUsersSortedAscendingByDateCreated()
    {
        $params = '?orderBy=created_at&sort=asc';

        $response = $this->call('GET', 'v1/users' . $params);
        $data = json_decode($response->getContent());
        $actual_users = $users = $data->users->data;

        usort($users, function($a, $b)
        {
            if ($a->created_at == $b->created_at) {
                return 0;
            }

            return ($a->created_at < $b->created_at) ? -1 : 1;
        });

        $this->assertEquals($users, $actual_users);
    }

    /**
     * Test fetching all users sorted descending by date created.
     *
     * @return void
     */
    public function testFetchesUsersSortedDescendingByDateCreated()
    {
        $params = '?orderBy=created_at&sort=desc';

        $response = $this->call('GET', 'v1/users' . $params);
        $data = json_decode($response->getContent());
        $actual_users = $users = $data->users->data;

        usort($users, function($a, $b)
        {
            if ($a->created_at == $b->created_at) {
                return 0;
            }

            return ($a->created_at > $b->created_at) ? -1 : 1;
        });

        $this->assertEquals($users, $actual_users);
    }

    /**
     * Test fetching all users sorted ascending by username.
     *
     * @return void
     */
    public function testFetchesUsersSortedAscendingByName()
    {
        $params = '?orderBy=username&sort=asc';

        $response = $this->call('GET', 'v1/users' . $params);
        $data = json_decode($response->getContent());
        $actual_users = $users = $data->users->data;

        usort($users, function($a, $b)
        {
            if ($a->username == $b->username) {
                return 0;
            }

            return ($a->username < $b->username) ? -1 : 1;
        });

        $this->assertEquals($users, $actual_users);
    }

    /**
     * Test fetching all users sorted descending by username.
     *
     * @return void
     */
    public function testFetchesUsersSortedDescendingByName()
    {
        $params = '?orderBy=username&sort=desc';

        $response = $this->call('GET', 'v1/users' . $params);
        $data = json_decode($response->getContent());
        $actual_users = $users = $data->users->data;

        usort($users, function($a, $b)
        {
            if ($a->username == $b->username) {
                return 0;
            }

            return ($a->username > $b->username) ? -1 : 1;
        });

        $this->assertEquals($users, $actual_users);
    }

    /**
     * @expectedException InvalidArgumentException
     */
    public function testFetchesUserWithInvalidUserId()
    {
        $response = $this->call('GET', 'v1/users/foo');
        $data = json_decode($response->getContent());
    }

    public function testFetchesNonExistingUser()
    {
        $response = $this->call('GET', 'v1/users/999999');
        $data = json_decode($response->getContent());

        $this->assertTrue($data->error);
        $this->assertEquals('User not found.', $data->message);
    }

    public function testFetchesUser()
    {
        $response = $this->call('GET', 'v1/users/2');
        $data = json_decode($response->getContent());

        $this->assertInstanceOf('stdClass', $data->user);
        $this->assertEquals('engineering_test1', $data->user->username);
        $this->assertEquals('engineering_test1@a5project.com', $data->user->email);
    }

    /**
     * Test creating a user with empty fields.
     *
     * @expectedException ValidationException
     */
    public function testCreatesUserWithEmptyFields()
    {
        $userFields = array(
            'username' => '',
            'email' => '',
            'password' => '',
            'password_confirmation' => ''
        );

        $response = $this->call('POST', 'v1/users', $userFields);
    }

    /**
     * Test that creating a user with existing username is not allowed.
     *
     * @expectedException ValidationException
     * @return void
     */
    public function testCreatesUserWithDuplicateUsername()
    {
        $userFields = array(
            'username' => 'engineering_test1',
            'email' => 'engineering_test10@a5project.com',
            'password' => '*a5pro123',
            'password_confirmation' => '*a5pro123'
        );

        $response = $this->call('POST', 'v1/users', $userFields);
    }

    /**
     * Test creating a user with invalid username.
     *
     * @expectedException ValidationException
     * @return void
     */
    public function testCreatesUserWithInvalidUsername()
    {
        $userFields = array(
            'username' => '1engineering_test',
            'email' => 'engineering_test10@a5project.com',
            'password' => '*a5pro123',
            'password_confirmation' => '*a5pro123'
        );

        $response = $this->call('POST', 'v1/users', $userFields);
    }

    /**
     * Test that creating a user with existing email is not allowed.
     *
     * @expectedException ValidationException
     * @return void
     */
    public function testCreatesUserWithDuplicateEmail()
    {
        $userFields = array(
            'username' => 'engineering_test10',
            'email' => 'engineering_test1@a5project.com',
            'password' => '*a5pro123',
            'password_confirmation' => '*a5pro123'
        );

        $response = $this->call('POST', 'v1/users', $userFields);
    }

    /**
     * Test creating a user with empty password_confirmation field.
     *
     * @expectedException ValidationException
     * @return void
     */
    public function testCreatesUserWithEmptyConfirmPasswordField()
    {
        $userFields = array(
            'username' => 'engineering_test10',
            'email' => 'engineering_test10@a5project.com',
            'password' => '*a5pro123',
            'password_confirmation' => ''
        );

        $response = $this->call('POST', 'v1/users', $userFields);
    }

    /**
     * Test creating a user with valid fields.
     *
     * @return void
     */
    public function testCreatesUser()
    {
        $userFields = array(
            'username' => 'engineering.Test_10',
            'email' => 'engineering_test10@a5project.com',
            'password' => '*a5pro123',
            'password_confirmation' => '*a5pro123'
        );

        $response = $this->call('POST', 'v1/users', $userFields);
        $data = json_decode($response->getContent());

        $this->assertFalse($data->error);
        $this->assertEquals('User has been created.', $data->message);
    }

    /**
     * Test updating existing User
     *
     * @return void
     */
    public function testUpdatesExistingUser()
    {
        $user = new User;
        $user->username = 'test_user';
        $user->email = 'test_user@a5project.com';
        $user->password = 'abcde';
        $user->save();

        $updatedUserFields = array(
            'username' => 'test_user',
            'email' => 'updated_email@a5project.com'
        );

        $response = $this->call('PATCH', 'v1/users/11', $updatedUserFields);
        $data = json_decode($response->getContent());

        $this->assertEquals('User has been updated.', $data->message);
        $this->assertEquals('updated_email@a5project.com', User::find(11)->email);
    }
}