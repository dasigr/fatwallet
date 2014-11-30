<?php

use Illuminate\Auth\UserTrait;
use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableTrait;
use Illuminate\Auth\Reminders\RemindableInterface;

class User extends Eloquent implements UserInterface, RemindableInterface {

	use UserTrait, RemindableTrait;

	/**
	 * The database table used by the model.
	 *
	 * @var string
	 */
	protected $table = 'users';

	/**
	 * The attributes excluded from the model's JSON form.
	 *
	 * @var array
	 */
	protected $hidden = array('password', 'remember_token');

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = array('username', 'email', 'password');

	/**
	 * Field validation rules.
	 *
	 * @var array
	*/
	static $rules = array(
	    'username' => 'required|alpha_dash|unique:users,username',
	    'username_first_char' => 'alpha',
	    'email' => 'required|email|unique:users,email',
	    'password' => 'required'
	);

}
