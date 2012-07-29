<?php
require_once 'Library.php';

/**
 * Stores the contents and information relating to a page in the database.
 *
 * @author David Thor
 * @version 1.0
 */
class Page extends Library {
    private $id;
    private $title;
    private $description;
    private $keywords;
    private $content;
    private $date_created;
    private $creator;
    private $parent;
    private $order;

    /**
     * Initialize the page with the input data or defaults.
     * @param array $data - Data to populate the page with
     */
    public function __construct($data = array()) {
        $ci =& $this->loadDependencies();    

        // Set defaults for the page.
        $this->description      = '';
        $this->keywords         = '';
        $this->content          = '';
        $this->date_created     = time();
        $this->parent           = null;
        $this->order            = 0;

        // Populate the page with the input data.
        foreach ($data as $key => $value) {
            // Handle some of the unique data types.
            switch ($key) {
                case "parent":
                    if ($value instanceof Page) {
                        $this->parent = $value;
                    } else if ((is_int($value) || is_numeric($value)) && $value > 0) {
                        // TODO - Check if ID is valid.
                    }
                    
                    break;
                case "creator":
                    if ($value instanceof User) {
                        $this->creator = $value;
                    } else if ((is_int($value) || is_numeric($value)) && $value > 0) {
                        // TODO - Check if ID is valid.
                    }

                    break;
                default:
                    $this->$key = $value;
                    break;
            }
        }
    }

    /**
     * Load anything that this library may depend on for proper functionality,
     * and return the active CodeIgniter instance.
     * @return CI_Controller - Active CodeIgniter instance
     */
    protected function &loadDependencies() {
        $ci =& get_instance();
        $ci->load->model(array('User_Model', 'Page_Model'));
        return $ci;
    }

    /**
     * Convert the object to a save format for database storage. This includes
     * converting library objects to their appropriate reference IDs.
     */
    public function minimize() {
        $ci =& $this->loadDependencies();

        // Check to see if the creator is an instance of the User library.
        if ($this->creator instanceof User) {
            $this->creator = $this->creator->getId();
        }

        // Check to see if the parent is an instance of the Page library.
        if ($this->parent instanceof Page) {
            $this->parent = $this->parent->getId();
        }
    }

    /**
     * Get the database reference ID of the page.
     * @return int - Database reference ID.
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set the database reference ID for the page.
     * @param int $id - New ID of the page.
     */
    public function setId($id) {
        $this->id = $id;
    }

    /**
     * Get the title of the current page.
     * @return String - Title of the page
     */
    public function getTitle() {
        return $this->title;
    }

    /**
     * Set a new title for the current page.
     * @param String $title - New title for the page
     */
    public function setTitle($title) {
        $this->title = $title;
    }

    /**
     * Get the description of the page.
     * @return String - Description of the page
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set a new description for the page.
     * @param String $description - New description for the page
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Get the keywords of the page as a comma separated list.
     * @return String - Comma-separated list of keywords for the page.
     */
    public function getKeywords() {
        return $this->keywords;
    }

    /**
     * Overwrite the list of keywords for the page with a new, comma-separated
     * list provided.
     * @param String $keywords - New comma-separated list of keywords
     */
    public function setKeywords($keywords) {
        $this->keywords = $keywords;
    }

    /**
     * Get the HTML content of the page.
     * @return String - HTML content of the page
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set new HTML content for the page.
     * @param String $content - New HTML content for the page
     */
    public function setContent($content) {
        $this->content = $content;
    }

    /**
     * Get the date that the page was created. The output date string will
     * be formatted according to the input parameter. Valid parameters include
     * anything accepted by the PHP date() function.
     * @param String $format - Format string for the PHP date() function
     * @return String - Formatted date that the page was created.
     */
    public function getDateCreated($format = 'F j, Y') {
        return date($format, $this->date_created);
    }

    /**
     * Set a new creation date for the page. Valid inputs include anything
     * accepted by the PHP strtotime() function.
     * @param String $date - New creation date of the page
     */
    public function setDateCreated($date) {
        $this->date_created = strtotime($date);
    }

    /**
     * Get the user who created the page.
     * @return User - User who created the page.
     */
    public function getCreator() {
        $ci =& $this->loadDependencies();

        if ((is_int($this->creator) || is_numeric($this->creator)) && $this->creator > 0) {
            $this->creator = $ci->User_Model->get($this->creator);
        }

        if ($this->creator instanceof User) {
            return $this->creator;
        } else {
            throw new Exception("Failed to convert the creator to a User object.");
        }
    }

    /**
     * Set a new creator for the page.
     * @param User $creator - New creator of the page
     */
    public function setCreator($creator) {
        $ci =& $this->loadDependencies();

        if ($creator instanceof User || ((is_int($creator) || is_numeric($creator) && $creator > 0))) {
            $this->creator = $creator;
        }
    }

    /**
     * Get the parent of the current page.
     * @return Page - Parent page of the current one
     */
    public function getParent() {
        $ci =& $this->loadDependencies();

        if ((is_int($this->parent) || is_numeric($this->parent)) && $this->parent > 0) {
            $this->parent = $ci->Page_Model->get($this->parent);
        }

        return ($this->parent instanceof Page) ? $this->parent : NULL;
    }

    /**
     * Set a new parent for the current page.
     * @param Page $parent - New paraent page
     */
    public function setParent($parent) {
        $ci =& $this->loadDependencies();

        if (((is_int($parent) || is_numeric($parent)) && $parent > 0) ||
                ($parent instanceof Page)) {
            $this->parent = $parent;
        }
    }

    /**
     * Get the order to display the page in a navigation.
     * @return int - Order to display the page in a navigation
     */
    public function getOrder() {
        return intval($this->order);
    }

    /**
     * Set the order to display the page in a navigation.
     * @param int $order - New order for the page
     */
    public function setOrder($order) {
        $this->order = intval($order);
    }
}
