<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Expenses extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        
        // Load required models
        $this->load->model('expense');
    }
    
    /**
     * index()
     * 
     * @return mixed Response
     */
	public function index()
	{
	    // Get input parameters
	    $input = $this->input->get();
	    
	    // Get list of expenses
	    $result = $this->expense->getAll();
	    
	    // Construct Response
	    $response = json_encode($result);
	    
		exit($response);
	}
}

/* End of file expenses.php */
/* Location: ./application/controllers/api/expenses.php */