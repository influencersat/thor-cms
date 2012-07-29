<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Controller managing a call to any static page.
 *
 * @author David Thor
 * @version 1.0
 */
class Static_Page extends T_Controller {

    /**
     * Initialize the controller and load any dependencies.
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Page_Model');
    }

	/**
     * Perform the index action of the page.
     */
    public function index() {
        $page = $this->Page_Model->get(1);
        $this->load->view('default_theme/main', array('page' => $page));
	}

    /**
     * Load the page associated with the input permalink.
     * @param String $permalink - Permalink to match a page with.
     */
    public function view($permalink = '') {
        if (empty($permalink)) {
            show_404();
        } else {
            print_r(array($permalink));
            $page = $this->Page_Model->get($permalink);
            
            $this->load->view('default_theme/header', array('page' => $page));
            $this->load->view('default_theme/main', array('page' => $page));
            $this->load->view('default_theme/footer', array('page' => $page));
        }
    }
    
    /**
     * 
     */
    public function getHeader() {
  		$page = $this->Page_Model->get(1);
  		$this->load->view('default_theme/header', array('page' => $page));
    }
}

