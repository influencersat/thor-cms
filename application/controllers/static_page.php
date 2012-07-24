<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_Page extends CI_Controller {
    /**
     * Load the necessary libraries and models for the controller.
     */
    public function __construct() {
        parent::__construct();
    }

	public function index() {

	}

    /**
     * Load the page associated with the input permalink.
     * @param String $permalink - Permalink to match a page with.
     */
    public function view($permalink = '') {
        if (empty($permalink)) {
            // TODO - Get the administrative preference for the homepage.
        } else {
            $title = strtolower(str_replace("-", " ", $permalink));
            $page = $this->Page_Model->get(array('lower(title)' => $title));
        }
    }
}

