<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class DisplayHook {
    public function captureOutput() {
        $this->CI =& get_instance();
        $output = $this->CI->output->get_output();
        if (ENVIRONMENT != 'testing') {
            echo $output;
        }
    }
}