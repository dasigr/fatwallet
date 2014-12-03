<?php

use \UserRepositoryInterface;

class UserController extends BaseController
{
    protected $user;

    public function __construct(UserRepositoryInterface $user)
    {
        $this->user = $user;
    }

    /**
     * Retrieve a list of users.
     *
     * @return Response
     */
    public function index()
    {
        return Response::json($this->user->all(), 200);
    }

	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		return Response::json($this->user->find($id), 200);
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		return Response::json($this->user->update($id, Input::all()), 200);
	}
}