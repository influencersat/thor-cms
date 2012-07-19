<?php
/**
 * Library representing a User object.
 *
 * @author David Thor
 * @version 1.0
 */
class User {
    private $id;
    private $first_name;
    private $last_name;
    private $email;
    private $password;
    private $last_visit;
    private $registration_date;
    private $groups;
    private $bio;
    private $picture;
    private $social;
    private $website;

    /**
     * Initialize the User object with the input data and load the database.
     * @param array $data - Associative array of data to populate the User
     *                      object with.
     */
    public function __construct($data = array()) {
        $this->loadDependencies();

        // Set the default values of the object.
        $this->last_visit           = time();
        $this->registration_date    = time();
        $this->bio                  = '';
        $this->picture              = NULL;
        $this->social               = array();
        $this->website              = '';
        
        // Populate the object with the contents of the input array.
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Load any libraries that this class may depend on for proper functionality.
     */
    private function loadDependencies() {
        $ci =& get_instance();
    }

    /**
     * Get the database reference ID of the User.
     * @return int - Database reference ID.
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set a new reference ID for the User object.
     * @param int $id - New database reference ID
     */
    public function setId($id) {
        if ((is_int($id) || is_numeric($id)) && $id > 0) {
            $this->id = $id;
        }
    }
}
