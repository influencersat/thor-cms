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
        $this->loadDependencies();    

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
                    }
                    
                    break;
                case "creator":
                    if ($value instanceof User) {
                        $this->creator = $value;
                    }

                    break;
                default:
                    $this->$key = $value;
                    break;
            }
        }
    }

    /**
     * Load the dependencies required by this library.
     */
    private function loadDependencies() {
        $ci =& get_instance();
        $ci->load->library('User');
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
}
