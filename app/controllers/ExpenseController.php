<?php

use \ExpenseRepositoryInterface;
use Illuminate\Support\Facades\Input;

class ExpenseController extends \BaseController {

    protected $expense;

    public function __construct(ExpenseRepositoryInterface $expense)
    {
        $this->expense = $expense;
    }

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
        return Response::json($this->expense->all( Input::all() ), 200);
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		return Response::json($this->expense->create( Input::all() ), 200);
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Response::json($this->expense->find($id), 200);
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return Response::json($this->expense->update($id, Input::all()), 200);
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		return Response::json($this->expense->delete($id), 200);
	}


}
