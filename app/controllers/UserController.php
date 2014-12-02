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
}