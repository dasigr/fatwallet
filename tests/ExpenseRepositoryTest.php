<?php

class ExpenseRepositoryTest extends AbstractDatabaseTestCase
{
    /**
     * CodeIgniter instance
     * 
     * @var object 
     */
    private $CI;
    
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
        
        $this->CI = &get_instance();
        $this->CI->load->database('testing');
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
     * testGetAllExpenses()
     * 
     * @return void
     */
    public function testGetAllExpenses()
    {
        // Prepare expected result
        $expected = $this->createMySQLXMLDataSet(dirname(__FILE__).'/seeds/expense_expected.xml')->getTable("expense");
        
        // Set parameters
        $params = array(
            'offset' => 0,
            'limit' => 2,
            'orderBy' => 'date_created',
            'sort' => 'DESC'
        );
        
        // Load Expense Model
        $this->CI->load->model('expense');
        
        // Get all expenses
        $actual = $this->CI->expense->getAll($params);
        
        // Assert
        $this->assertEquals(2, count($actual));
        
        // Assert that actual result is equal to expected result
        // $this->assertTablesEqual($expected, $actual);
    }
}