<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {
    /**
     * Load the necessary libraries and models for the controller.
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('User_Model');
    }

	public function index() {
        $this->load->view('default_theme/main'); 
	}
}

