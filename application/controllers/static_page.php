<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Static_Page extends CI_Controller {
    /**
     * Load the necessary libraries and models for the controller.
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('Page_Model');
        $this->load->model('User_Model');
    }

	public function index() {
        $page = $this->Page_Model->get(1);
		$this->load->view(DEFAULT_THEME . 'home', array('page' => $page));
        
        $user = new User();
        $user->setFirstName('David');
        $user->setLastName('Thor');
        $user->setEmail('thor.d@husky.neu.edu');
        $user->setPassword('041290');
        $user->setLastVisitDate('July 20, 2012');
        $user->setRegistrationDate('July 19, 2012');
        $user->setWebsite('http://www.davidthor.me');
        $user->setBio('I like to party');
        $this->User_Model->insert($user);
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

