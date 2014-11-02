<?php

class ExpenseControllerTest extends PHPUnit_Framework_TestCase
{
    private $CI;
    
    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     *
     */
    protected function setUp()
    {
        parent::setUp();
    
        $this->CI = &get_instance();
    }
    
    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
    
    public function test_index_returns_response()
    {
        // Prepare expected result
        $expected = array(
            'total' => 5,
            'data' => array(
                array(
                    'id' => '5',
                    'title' => 'Test Expense 5',
                    'amount' => '1505',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'date_created' => '2014-10-31 11:55:07',
                    'date_updated' => NULL
                ),
                array(
                    'id' => '4',
                    'title' => 'Test Expense 4',
                    'amount' => '1404',
                    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.',
                    'date_created' => '2014-10-31 11:54:49',
                    'date_updated' => NULL
                )
            )
        );
        $expectedJson = json_encode($expected);
        
        // Set headers
        $headers = array(
            'Authorization: Token 46464464514646531'
        );
        
        // Set parameters
        $params = array(
            'offset' => 0,
            'limit' => 2
        );
    
        // Create Request data
        $data = array(
            'url' => 'http://api.fatwallet.local/index.php/expenses',
            'method' => 'GET',
            'headers' => $headers,
            'params' => $params
        );
        
        // Initialize cURL
        $ch = curl_init();
        
        // Set options
        $options = array();
        $options[CURLOPT_HTTPGET] = 1;
        $options[CURLOPT_HTTPHEADER] = $data['headers'];
        $options[CURLOPT_URL] = $data['url'];
        $options[CURLOPT_RETURNTRANSFER] = true;
        
        curl_setopt_array($ch, $options);
        
        // Execute cURL
        $actualJson = curl_exec($ch);
        
        // Close cURL
        curl_close($ch);
        
        $result = json_decode($actualJson);
        print_r($result);
    
        // Assert that we get the expected result
        $this->assertJsonStringEqualsJsonString($expectedJson, $actualJson);
    }
}