<?php

class UserController extends BaseController
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
            'expenses' => User::all()->toArray()
        );

        return Response::json($data, 200);
    }
}