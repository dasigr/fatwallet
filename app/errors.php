<?php

class ValidationException extends \Exception {

    /**
     * @param Validator $validator failed validator object
     */
    public function __construct($validator, $code = 500) {
        $this->messages = $validator->messages();
        parent::__construct($this->messages, $code);
    }
}
