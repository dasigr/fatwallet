<?php

use \ValidationException;
use \Illuminate\Database\Eloquent\ModelNotFoundException;
use Symfony\Component\Translation\Exception\NotFoundResourceException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class ExpenseRepository implements ExpenseRepositoryInterface {

    /**
	 * Retrive a list of expenses.
	 *
	 * @param  array  $param
	 * @return array
	 */
    public function all($param = array())
    {
        $perPage = isset($param['perPage']) ? $param['perPage'] : 15;
        $orderBy = isset($param['orderBy']) ? strtolower($param['orderBy']) : 'created_at';
        $sort = isset($param['sort']) ? strtoupper($param['sort']) : 'DESC';

        if ( ! is_numeric($perPage)) {
            throw new InvalidArgumentException;
        }

        if ( ! in_array($orderBy, Expense::$sortable)) {
            throw new InvalidArgumentException;
        }

        $valid_sort = array('ASC', 'DESC');
        if ( ! in_array($sort, $valid_sort)) {
            throw new InvalidArgumentException;
        }

        $expenses = Expense::orderBy($orderBy, $sort)->paginate($perPage)->toArray();

        return array(
            'error' => false,
            'expenses' => $expenses
        );
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function find($id)
    {
        if ( ! is_numeric($id)) {
            throw new InvalidArgumentException;
        }

        $expense = Expense::with('category', 'merchant')->where('id', '=', $id)->first();

        if ( ! ($expense instanceof Expense)) {
            return array(
                'error' => false,
                'message' => 'Expense does not exist.'
            );
        }

        return array(
            'error' => false,
            'expense' => $expense->toArray()
        );
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  array $attributes
	 * @return Response
	 */
    public function create($attributes)
    {
        $expense = Expense::create($attributes);

        if ( ! ($expense instanceof Expense)) {
            return array(
                'error' => false,
                'message' => 'Failed creating an expense.'
            );
        }

        return array(
            'error' => false,
            'message' => 'Expense has been created.'
        );
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int   $id
	 * @param  array $attributes
	 * @return Response
	 */
    public function update($id, $attributes)
    {
        $this->validate($attributes);

        try
        {
            $expense = Expense::find($id);
            foreach ($attributes as $key => $value) {
                $expense[$key] = $value;
            }
            $expense->save();

            return array(
                'error' => false,
                'message' => 'Expense has been updated.'
            );
        }
        catch (Exception $e)
        {
            return array(
                'error' => true,
                'message' => $e->getMessage()
            );
        }
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function delete($id)
    {

    }

    /**
	 * Validate input data.
	 *
	 * @param  int  $id
	 * @throws ValidationException
	 * @return bool
	 */
    public function validate($data)
    {
        // Create Expense validation rules
        $rules = array(
            'amount' => 'required|integer|min:0|max:9999999999999999',
            'merchant_id' => 'required|integer',
            'category_id' => 'required|integer',
            'notes' => 'size:254',
            'attachement_id' => 'integer',
            'created_at' => 'required'
    	);

        // Do validation
        $validator = Validator::make($data, $rules);

        if ($validator->fails()) {
            throw new ValidationException($validator, 401);
        }

        return true;
    }

    /**
	 * Create an instance.
	 *
	 * @param array $data
	 * @return Model
	 */
    public function instance($data = array())
    {

    }

    /**
     * Return an error message.
     *
     * @return string
     */
    public function error()
    {

    }

}