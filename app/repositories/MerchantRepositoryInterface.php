<?php

interface MerchantRepositoryInterface {

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function all();

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function find($id);

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function create($data);

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function update($id, $data);

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function delete($id);

    /**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
    public function validate($data, $id = null);

    /**
	 * Create an instance.
	 *
	 * @param array $data
	 * @return Model
	 */
    public function instance($data = array());

    /**
     * Return an error message.
     *
     * @return string
     */
    public function error();

}