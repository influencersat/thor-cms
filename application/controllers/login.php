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
        
    }
    
    /**
     * Perform the index action for the controller.
     */
    public function index() {
    	
    }
    
    /**
     * 
     */
    public function logout() {
    	self::$user = null;
    }
    
}
