<?php

use \ValidationException;

class MerchantRepository implements MerchantRepositoryInterface {

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function all()
    {
        $input = Input::all();

        $orderBy = isset($input['orderBy']) ? strtolower($input['orderBy']) : 'created_at';
        $sort = isset($input['sort']) ? strtoupper($input['sort']) : 'DESC';

        $merchants = Merchant::all()->toArray();

        return array(
            'error' => false,
            'merchants' => $merchants
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

    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function create($data)
    {

    }

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update($id, $data)
    {

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
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function validate($data, $id = null)
    {

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