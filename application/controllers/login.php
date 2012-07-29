<?php
/**
 * Login controller handling the login page and all the data the user inputs.
 *
 * @author David Thor
 * @version 1.0
 */
class Login extends T_Controller {
	
	/**
	 * Constructor for the controller.
	 */
    public function __construct() {
        parent::__construct();
        $this->load->model('Page_Model');
    }
    
    /**
     * Perform the index action for the controller.
     */
    public function index() {
    	$page = $this->Page_Model->get(1);
    	$this->load->view('default_theme/header', array('page' => $page));
    	$this->load->view('default_theme/login', array('page' => $page));
    	$this->load->view('default_theme/footer', array('page' => $page));
    }
    
    /**
     * 
     */
    public function logout() {
    	self::$user = null;
    }
    
}
