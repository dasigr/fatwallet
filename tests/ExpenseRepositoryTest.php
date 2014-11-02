<?php

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
        
        // Get expected result
        $expected = $this->createMySQLXMLDataSet(dirname(__FILE__).'/seeds/expense_expected.xml')->getTable("expense");
        
        // Assert that actual result is equal to expected result
        $this->assertTablesEqual($expected, $actual);
    }
}