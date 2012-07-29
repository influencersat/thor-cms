<?php
require_once 'Library.php';

/**
 * Library representing an image stored in the database.
 *
 * @author David Thor
 * @version 1.0
 */
class Image extends Library {
    private $id;
    private $name;
    private $description;
    private $date_created;
    private $owner;
    private $original_file;
    private $thumbnail_file;

    /**
     * Initialize the Image object with the data from the input array.
     * @param array $data - Array of data for the object
     */
    public function __construct($data = array()) {
        $ci =& $this->loadDependencies();

        // Set the default values
        $this->description      = '';
        $this->date             = time();
        $this->owner            = NULL;

        // Load the input data
        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Load any models and libraries that this library may depend on. Then,
     * return the CodeIgniter instance.
     * @return CI_Controller - Active CodeIgniter instance
     */
    protected function &loadDependencies() {
        $ci =& get_instance();
        $ci->load->model('User_Model');
        return $ci;
    }

    /**
     * Convert variables corresponding to library objects to their appropriate
     * database reference IDs.
     */
    public function minimize() {
        $ci =& $this->loadDependencies();

        if ($this->owner instanceof User) {
            $this->owner = $this->owner->getId();
        }
    }

    /**
     * Get the reference ID of the Image.
     * @return int - Database reference ID
     */
    public function getId() {
        return intval($this->id);
    }

    /**
     * Set a new reference ID for the Image.
     * @param int - New reference ID for the image
     */
    public function setId($id) {
        $this->id = intval($id);
    }

    /**
     * Get the name of the image.
     * @return String - Name of the image
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set a new name for the image.
     * @param String $name - New name for the image
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Get the description of the Image.
     * @return String - Description of the image
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set a new description for the image.
     * @param String $description - New description for the image
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Get the date of the image formatted based on the input parameter. Valid
     * inputs include anything accepted by the PHP date() function.
     * @param String $format - Format to return the date in
     * @return String - Properly formatted date the Image was created
     */
    public function getDateCreated($format = 'F j, Y') {
        return date($format, $this->date_created);
    }

    /**
     * Set a new creation date for the image.
     * @param String $date - Date acceptable by PHP strtotime() function
     */
    public function setDateCreated($date) {
        $this->date_created = strtotime($date);
    }

    /**
     * Get the User who owns the image.
     * @return User - Owner of the image
     */
    public function getOwner() {
        $ci =& $this->loadDependencies();

        if ((is_int($this->owner) || is_numeric($this->owner)) && $this->owner > 0) {
            $this->owner = $ci->User_Model->get($this->owner);
        }

        if ($this->owner instanceof User) {
            return $this->owner;
        } else {
            throw new Exception("Failed to convert the the owner to a User object.");
        }
    }

    /**
     * Set a new owner for the image.
     * @param User $user - New owner for the file
     */
    public function setOwner($user) {
        if (((is_int($user) || is_numeric($user)) && $user > 0) ||
                ($user instanceof User)) {
            $this->owner = $user;
        }
    }

    /**
     * Get the URL of the original file.
     * @return String - URL of the original image
     */
    public function getOriginalFileLocation() {
        return $this->original_file;
    }

    /**
     * Set the location of the originally uploaded file.
     * @param String $url - URL of the uploaded image
     */
    public function setOriginalFileLocation($url) {
        $this->original_file = $url;
    }

    /**
     * Get the URL of the generated thumbnail file.
     * @return String - URL of the thumbnail image
     */
    public function getThumbnailFileLocation() {
        return $this->thumbnail_file;
    }

    /**
     * Set the location of the generated thumbnail file.
     * @param String $url - URL of the thumbnail image
     */
    public function setThumbnailFileLocation($url) {
        $this->thumbnail_file = $url;
    }
}
