<?php

class ExpenseRepositoryTest extends TestCase {

    protected $expense;

    /**
     * Migrate and seed the test database.
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();

        $this->expense = App::make('ExpenseRepository');

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
     * Test perPage parameter for retrieving a list of expenses.
     *
     * @expectedException InvalidArgumentException
     * @return void
     */
    public function testAllExpensesPerPageParameter()
    {
        $param = array(
            'perPage' => 'foo'
        );

        $this->expense->all($param);
    }

    /**
     * Test orderBy parameter for retrieving a list of expenses.
     *
     * @expectedException InvalidArgumentException
     * @return void
     */
    public function testAllExpensesOrderByParameter()
    {
        $param = array(
            'orderBy' => 'foo'
        );

        $this->expense->all($param);
    }

    /**
     * Test sort parameter for retrieving a list of expenses.
     *
     * @expectedException InvalidArgumentException
     * @return void
     */
    public function testAllExpensesSortParameter()
    {
        $param = array(
            'sort' => 'foo'
        );

        $this->expense->all($param);
    }

    /**
     * Test that all() method returns all expenses.
     *
     * @return void
     */
    public function testAllExpensesList()
    {
        $expenses = Expense::orderBy('created_at', 'desc')->get()->toArray();

        $result = $this->expense->all();

        $this->assertEquals($expenses, $result['expenses']['data']);
    }

    /**
     * Assert order of array by key.
     *
     * @param array $data
     * @param string $field
     * @param string $sort
     * @return void
     */
    protected function assertAscendingOrder($param)
    {
        $result = $this->expense->all($param);

        $sorted_data = $data = $result['expenses']['data'];
        $field = $param['orderBy'];

        usort($sorted_data, function($a, $b) use($field)
        {
            if ($a[$field] == $b[$field]) {
                return 0;
            }

            return ($a[$field] < $b[$field]) ? -1 : 1;
        });

        $this->assertEquals($data, $sorted_data);
    }

    /**
     * Assert order of array by key.
     *
     * @param array $data
     * @param string $field
     * @param string $sort
     * @return void
     */
    protected function assertDescendingOrder($param)
    {
        $result = $this->expense->all($param);

        $sorted_data = $data = $result['expenses']['data'];
        $field = $param['orderBy'];

        usort($sorted_data, function($a, $b) use($field)
        {
            if ($a[$field] == $b[$field]) {
                return 0;
            }

            return ($a[$field] > $b[$field]) ? -1 : 1;
        });

        $this->assertEquals($data, $sorted_data);
    }

    /**
     * Test retrieving a list of expenses ordered ascending by amount.
     *
     * @return void
     */
    public function testAllExpensesOrderedAscendingByAmount()
    {
        $param = array(
            'perPage' => 3,
            'orderBy' => 'amount',
            'sort' => 'asc'
        );

        $this->assertAscendingOrder($param);
    }

    /**
     * Test retrieving a list of expenses ordered descending by amount.
     *
     * @return void
     */
    public function testAllExpensesOrderedDescendingByAmount()
    {
        $param = array(
            'perPage' => 3,
            'orderBy' => 'amount',
            'sort' => 'desc'
        );

        $this->assertDescendingOrder($param);
    }

    /**
     * Test retrieving a list of expenses ordered ascending by created_at.
     *
     * @return void
     */
    public function testAllExpensesOrderedAscendingByCreatedAt()
    {
        $param = array(
            'perPage' => 3,
            'orderBy' => 'created_at',
            'sort' => 'asc'
        );

        $this->assertAscendingOrder($param);
    }

    /**
     * Test retrieving a list of expenses ordered descending by created_at.
     *
     * @return void
     */
    public function testAllExpensesOrderedDescendingByCreatedAt()
    {
        $param = array(
            'perPage' => 3,
            'orderBy' => 'created_at',
            'sort' => 'desc'
        );

        $this->assertDescendingOrder($param);
    }

    /**
     * Test retrieving an expense with invalid id parameter.
     *
     * @expectedException InvalidArgumentException
     * @return void
     */
    public function testFindExpenseWithInvalidId()
    {
        $this->expense->find('foo');
    }

    /**
     * Test retrieving a non-existing expense.
     *
     * @return void
     */
    public function testFindNonExistingExpense()
    {
        $result = $this->expense->find(999999999);

        $this->assertEquals('Expense does not exist.', $result['message']);
    }

    /**
     * Test retriving an expense.
     *
     * @return void
     */
    public function testFindExpense()
    {
        $expense = Expense::with('category', 'merchant')->where('id', '=', 2)->first()->toArray();

        $result = $this->expense->find(2);

        $this->assertEquals($expense, $result['expense']);
    }

    /**
     * Test creating an expense.
     *
     * @return void
     */
    public function testCreateExpense()
    {
        $attributes = array(
            'amount' => 424988,
            'merchant_id' => 1,
            'category_id' => 1,
            'notes' => 'Lorem ipsum set amet.',
            'attachment_id' => 1,
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->expense->create($attributes);

        $expense = Expense::where('amount', '=', $attributes['amount'])
                            ->where('created_at', '=', $attributes['created_at'])
                            ->first()->toArray();
        unset($expense['id']);
        unset($expense['updated_at']);

        $this->assertEquals($attributes, $expense);
    }

    /**
     * Test updating an expense with empty fields.
     *
     * @expectedException ValidationException
     * @return void
     */
    public function testUpdateExpenseWithEmptyFields()
    {
        $attributes = array(
            'amount' => '',
            'merchant_id' => '',
            'category_id' => '',
            'notes' => '',
            'attachment_id' => '',
            'created_at' => ''
        );

        $this->expense->update(1, $attributes);
    }

    /**
     * Test updating an expense.
     *
     * @return void
     */
    public function testUpdateExpense()
    {
        $attributes = array(
            'amount' => '23434',
            'merchant_id' => 1,
            'category_id' => 1,
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->expense->update(1, $attributes);

        $expense = Expense::find(1);
        $this->assertEquals($attributes['amount'], $expense->amount);
    }

    /**
     * Test deleting an expense.
     *
     * @return void
     */
    public function testDeleteExpense()
    {
        $this->expense->delete(1);

        $expense = Expense::find(1);
        $this->assertTrue($expense === null);
    }
}