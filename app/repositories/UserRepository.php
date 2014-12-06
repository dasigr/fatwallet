<?php

use \ValidationException;

class UserRepository implements UserRepositoryInterface {

    /**
	 * Get all of the models from the database.
	 *
	 * @return array
	 */
    public function all()
    {
        $input = Input::all();

        $perPage = isset($input['perPage']) ? $input['perPage'] : 15;
        $orderBy = isset($input['orderBy']) ? strtolower($input['orderBy']) : 'created_at';
        $sort = isset($input['sort']) ? strtoupper($input['sort']) : 'DESC';

        if ( ! is_numeric($perPage)) {
            throw new InvalidArgumentException;
        }

        $valid_orderby = array('username', 'created_at');
        if ( ! in_array($orderBy, $valid_orderby)) {
            throw new InvalidArgumentException;
        }

        $valid_sort = array('ASC', 'DESC');
        if ( ! in_array($sort, $valid_sort)) {
            throw new InvalidArgumentException;
        }

        return array(
            'error' => false,
            'users' => User::orderBy($orderBy, $sort)->paginate($perPage)->toArray()
        );
    }

    /**
	 * Find a model by its primary key.
	 *
	 * @param  mixed  $id
	 * @param  array  $columns
	 * @return \Illuminate\Support\Collection|static
	 */
    public function find($id)
    {
        if ( ! is_numeric($id)) {
            throw new InvalidArgumentException;
        }

        $user = User::find($id);

        if ( ! ($user instanceof User)) {
            return array(
                'error' => true,
                'message' => 'User not found.'
            );
        }

        return array(
            'error' => false,
            'user' => $user->toArray()
        );
    }

    /**
	 * Save a new model and return the instance.
	 *
	 * @param  array  $attributes
	 * @return Model
	 */
    public function create($attributes)
    {
        // Validate input data
        $this->validate($attributes);

        // Save only lowercase usernames
        $attributes['username'] = strtolower($attributes['username']);

        // Encrypt password
        $attributes['password'] = Hash::make($attributes['password']);
        unset($attributes['password_confirmation']);

        // Create user
        $user = new User();
        $user_model = $user->create($attributes);

        if ( ! $user_model instanceof User) {
            return array(
                'error' => true,
                'message' => 'User was not created.'
            );
        }

        return array(
            'error' => false,
            'message' => 'User has been created.'
        );
    }

    /**
	 * Update the model in the database.
	 *
	 * @param  array  $attributes
	 * @return bool|int
	 */
    public function update($id, $data)
    {
        $this->validate($data, $id);

        if (isset($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        }

        $user = User::find($id);

        if ( ! $user->update($data)) {
            return array(
                'error' => true,
                'message' => 'User was not updated.'
            );
        }

        return array(
            'error' => false,
            'message' => 'User has been updated.'
        );
    }

    /**
	 * Delete the model from the database.
	 *
	 * @return bool|null
	 * @throws \Exception
	 */
    public function delete($id)
    {
        $user = $this->find($id);

        return $user->delete();
    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @throws ValidationException
	 * @return bool
	 */
    public function validate($data, $id = null)
    {
        // Custom validation messages
        $messages = array(
            'username.regex' => 'The :attribute field should start with a character. Space i not allowed. Punctuations are not allowed, except for hyphens, dots and underscrores.',
        );

        // Create user validation rules
        $rules = array(
            'username' => array(
                'required',
                'regex:/^[a-zA-Z][a-zA-Z_\.0-9]*/',
                'min:3',
                'max:32',
                'unique:users,username'
            ),
            'email' => array(
                'required',
                'email',
                'unique:users,email'
    	    ),
    	    'password' => array(
    	        'required',
    	        'min:8',
    	        'confirmed'
            )
    	);

        // Update user validation rules
        if ($id) {
            $rules = array(
                'username' => array(
                    'required',
                    'regex:/^[a-zA-Z][a-zA-Z_\.0-9]*/',
                    'min:3',
                    'max:32',
                    'unique:users,username,' . $id
                ),
                'email' => array(
                    'required',
                    'email',
                    'unique:users,email,' . $id
        	    ),
        	    'password' => array(
        	        'sometimes',
        	        'required',
        	        'min:8',
        	        'confirmed'
                )
        	);
        }

        // Do validation
        $validator = Validator::make($data, $rules, $messages);

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
        return new User($data);
    }

    /**
     * Throw an Exception error
     *
     * @throws Exception
     */
    public function error()
    {
        throw new Exception('Something went wrong!');
    }

}
