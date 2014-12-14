<?php

class ValidationException extends \Exception
{
    /**
     * Constructor
     *
     * @param $validator Validator object
     */
    public function __construct($validator, $code = 500)
    {
        $this->messages = $validator->messages();
        parent::__construct($this->messages, $code);
    }
}
