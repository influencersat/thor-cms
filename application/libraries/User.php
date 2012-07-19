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
        $ci->load->model('Image_Model');
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

    /**
     * Get the users first name.
     * @return String - The first name of the user
     */
    public function getFirstName() {
        return $this->first_name;
    }

    /**
     * Set a new first name for the user.
     * @param String $name - New name for the user
     */
    public function setFirstName($name) {
        $this->first_name = $name;
    }

    /**
     * Get the users last name.
     * @return String - The last name of the user
     */
    public function getLastName() {
        return $this->last_name;
    }

    /**
     * Set a new last name for the user.
     * @param String $name - New name for the user
     */
    public function setLastName($name) {
        $this->last_name = $name;
    }

    /**
     * Get the email address of the user.
     * @return String - The email address of the user
     */
    public function getEmail() {
        return $this->email;
    }

    /**
     * Set a new email address for the user.
     * @param String $email - New email address for the user
     */
    public function setEmail($email) {
        $this->email = $email;
    }

    /**
     * Set a new password for the user.
     * @param String $password - New password for the user
     */
    public function setPassword($password) {
        $this->password = md5($password);
    }

    /**
     * Get the date the user visited the site last. The format of the
     * output string is defined by the input parameter. Formatting 
     * syntax is in line with that supplied by the php date() function.
     * @param String $format - Formatting for the output string
     * @return String - Formatted date that the user last visited
     */
    public function getLastVisitDate($format = 'F j, Y') {
        return date($format, $this->last_visit);
    }

    /**
     * Set the users last visit date to the new one provided. Input
     * dates will be converted to timestamps with the php strtotime
     * function.
     * @param String $date - New date to set.
     */
    public function setLastVisitDate($date) {
        $this->date = strtotime($date);
    }

    /**
     * Get the date the user registered on the site. The format of the
     * output string is defined by the input parameter. Formatting 
     * syntax is in line with that supplied by the php date() function.
     * @param String $format - Formatting for the output string
     * @return String - Formatted date that the user registered
     */
    public function getRegistrationDate($format = 'F j, Y') {
        return date($format, $this->registration_date);
    }
                                                     
    /**
     * Set the users registration date to the new one provided. Input
     * dates will be converted to timestamps with the php strtotime
     * function.
     * @param String $date - New date to set.
     */
    public function setRegistrationDate($date) {
        $this->date = strtotime($date);
    }

    /**
     * Get the users bio.
     * @return String - The bio of the user
     */
    public function getBio() {
        return $this->bio;
    }

    /**
     * Set a new bio for the user.
     * @param String - New bio to set for the user
     */
    public function setBio($bio) {
        $this->bio = $bio;
    }

    /**
     * Get the profile picture of the user.
     * @return Image - Profile picture of the user
     */
    public function getProfilePicture() {
        if ((is_int($this->picture) || is_numeric($this->picture) && $this->picture > 0) {
            $ci =& get_instance();
            $ci->load->model('Image_Model');
            $this->picture = $ci->Image_Model->get($this->picture);
        }

        if ($this->picture instanceof Image) {
            return $this->picture;
        } else {
            throw new Exception("Failed to get profile picture: Could not " . 
                                "convert the picture to an Image object.");
        }
    }

    /**
     * Set a new profile picture for the user.
     * @param Image $picture - New Image for the users profile picture
     */
    public function setProfilePicture($picture) {
        if ($picture instanceof Image) {
            $this->picture = $picture;
        } else if ((is_int($picture) || is_numeric($picture)) && $this->picture > 0) {
            $ci =& get_instance();
        }
    }
}
