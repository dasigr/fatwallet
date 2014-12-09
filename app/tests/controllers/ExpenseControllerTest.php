<?php

class ExpenseControllerTest extends TestCase {

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

    public function testProvidesErrorFeedback()
    {
        $response = $this->call('GET', 'v1/expenses');
        $data = json_decode($response->getContent());

        $this->assertEquals(false, $data->error);
    }

    /**
     * Test fetching all expenses.
     *
     * @return void
     */
    public function testFetchesAllExpensesList()
    {
        $response = $this->call('GET', 'v1/expenses');
        $content = $response->getContent();
        $data = json_decode($content);

        // Did we receive valid JSON?
        $this->assertJson($content);

        // Decoded JSON should offer an expense array
        $this->assertInternalType('array', $data->expenses->data);
    }

    /**
     * Test retrieving first page of expense list.
     *
     * @return void
     */
    public function testFetchesAllExpensesFirstPage()
    {
        $expenses = Expense::orderBy('created_at', 'desc')->skip(0)->take(3)->get()->toArray();

        $expected_expenses = array();
        foreach ($expenses as $expense) {
            $expected_expenses[] = (object) $expense;
        }

        $response = $this->call('GET', 'v1/expenses?page=1&perPage=3');
        $content = $response->getContent();
        $data = json_decode($content);

        $this->assertEquals($expected_expenses, $data->expenses->data);
    }

    /**
     * Test retrieving second page of expense list.
     *
     * @return void
     */
    public function testFetchesAllExpensesSecondPage()
    {
        $expenses = Expense::orderBy('created_at', 'desc')->skip(3)->take(3)->get()->toArray();

        $expected_expenses = array();
        foreach ($expenses as $expense) {
            $expected_expenses[] = (object) $expense;
        }

        $response = $this->call('GET', 'v1/expenses?page=2&perPage=3');
        $content = $response->getContent();
        $data = json_decode($content);

        $this->assertEquals($expected_expenses, $data->expenses->data);
    }

    /**
     * Test retrieving last page of expense list.
     *
     * @return void
     */
    public function testFetchesAllExpensesLastPage()
    {
        $count = Expense::count();
        $remainder = $count % 3;
        $start = $count - $remainder;
        $last = floor($count / 3);
        if ($remainder > 0 ) {
            $last++;
        }

        $expenses = Expense::orderBy('created_at', 'desc')->skip($start)->take(3)->get()->toArray();

        $expected_expenses = array();
        foreach ($expenses as $expense) {
            $expected_expenses[] = (object) $expense;
        }

        $response = $this->call('GET', 'v1/expenses?perPage=3&page=' . $last);
        $content = $response->getContent();
        $data = json_decode($content);

        $this->assertEquals($expected_expenses, $data->expenses->data);
    }

    /**
     * Test API call for retrieving an expense.
     *
     * @return void
     */
    public function testShowExpense()
    {
        $expense = Expense::with('category', 'merchant')->where('id', '=', 2)->first()->toArray();
        $expected = json_encode(array(
            'error' => false,
            'expense' => $expense
        ));

        $response = $this->call('GET', 'v1/expenses/2');

        $this->assertEquals($expected, $response->getContent());
    }
}