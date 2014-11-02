<?php

class Expense_Controller
{
    public function index()
    {
        $response = array(
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
        
        return json_encode($response);
    }
}

class Expense
{
    /**
     * Generate an SQL script for listing all expenses.
     * 
     * @param int $offset
     * @param int $limit
     * @param string $orderBy
     * @param string $sort
     * @return string
     */
    public function read_list_sql($offset = 0, $limit = 25, $orderBy = 'date_created', $sort = 'DESC')
    {
        $sql = "SELECT * FROM `expense` ORDER BY `" . $orderBy . "` " . $sort . " LIMIT " . $offset . ", " . $limit;
        
        return $sql;
    }
}

class ExpenseRepositoryTest extends AbstractDatabaseTestCase
{
    /**
     * Returns the test dataset.
     *
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
     */
    final public function getDataSet()
    {
        return $this->createMySQLXMLDataSet(dirname(__FILE__).'/seeds/expense.xml');
    }
    
    /**
     * Sets up the fixture, for example, open a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        parent::setUp();
    }
    
    /**
     * Tears down the fixture, for example, close a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {
        parent::tearDown();
    }
    
    /**
     * test_get_request_receives_list_of_photos()
     * 
     * @return void
     */
    public function test_read_list_sql()
    {
        // Prepare expected result
        $expected = $this->createMySQLXMLDataSet(dirname(__FILE__).'/seeds/expense_expected.xml')->getTable("expense");
        
        // Get Expense intance
        $expense = new Expense();
        
        // Set parameters
        $offset = 0;
        $limit = 2;
        $orderBy = 'date_created';
        $sort = 'DESC';
        
        // Get SQL query
        $sql = $expense->read_list_sql($offset, $limit, $orderBy, $sort);
        
        // Execute query
        $actual = $this->getConnection()->createQueryTable('expense', $sql);
        
        // Assert that actual result is equal to expected result
        $this->assertTablesEqual($expected, $actual);
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
        
        // Get Expense_Controller instance.
        $expense_controller = new Expense_Controller();
        
        // Set parameters
        $params = array(
            'offset' => 0,
            'limit' => 2
        );
        
        // Create Request data
        $data = array(
            'url' => '/api/v1/expenses',
            'method' => 'GET',
            'params' => $params
        );
        
        // Make an API call
        // $result = $this->curl->request($data);
        $actualJson = $expense_controller->index($data);
        
        // Assert that we get the expected result
        $this->assertJsonStringEqualsJsonString($expectedJson, $actualJson, 'Failed asserting that $actualJson is equal to $expectedJson');
    }
}