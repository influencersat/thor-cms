<?php
/**
 * Parent controller for all pages. Stores various functions for global use.
 *
 * @author David Thor
 * @version 1.0
 */
class Controller extends CI_Controller {
    private static $user;

    /**
     * Create the controller instance.
     */
    public function __construct() {
        parent::__construct();
        $this->load->model('User_Model');

        // Check if the user is logged in
        if ($userdata = $this->session->userdata('user')) {
            self::$user = new User($this->session->userdata('user'));
        } else {
            self::$user = null;
        }
    }

    /**
     * Check if there is a user logged in.
     * @return boolean
     */
    public static function userIsLoggedIn() {
        return (self::$user instanceof User);
    }
}
