<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_Page extends CI_Controller {
    /**
     * Load the necessary libraries and models for the controller.
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Page_Model');
    }

	public function index() {
		$this->load->view('welcome_message');
	}
}

/* End of file welcome.php */
/* Location: ./application/controllers/welcome.php */
