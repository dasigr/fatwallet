<?php

class ExpensController extends BaseController
{
    /**
     * Retrieve a list of expenses.
     *
     * @return Response
     */
    public function index()
    {
        $data = array(
            'error' => false,
            'expenses' => Expenses::all()->toArray()
        );

        return Response::json($data, 200);
    }
}