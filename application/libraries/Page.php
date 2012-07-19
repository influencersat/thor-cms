<?php
/**
 * Stores the contents and information relating to a page in the database.
 *
 * @author David Thor
 * @version 1.0
 */
class Page {
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
    private function &loadDependencies() {
        $ci =& get_instance();
        $ci->load->library('User');
        $ci->load->model(array('User_Model', 'Page_Model'));
        return $ci;
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
}
