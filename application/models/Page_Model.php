<?php
/**
 * Designed for management of page content allowing for error-less reading and
 * writing to the database.
 *
 * @author David Thor
 * @version 1.0
 */
class Page_Model extends CI_Model {
    /**
     * Initialize the model and load the database.
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('Page');
    }

    /**
     * Get the page object matching the input data.
     * @param mixed $data - Mixed input criteria used to match against the
     *                      database.
     * @return Page - Page object representing the database entry.
     */
    public function get($data) {
        if (is_int($data) || (is_numeric($data) && $data > 0)) {
            return $this->getFromId($data);
        } else if (is_array($data)) {
            return $this->getFromArray($data);
        } else {
            return new Page();
        }
    }

    /**
     * Create a Page object populated with data associated with the given
     * database ID.
     * @param int $id - Database reference ID
     * @return Page - Page object managing the database content.
     */
    private function getFromId($id) {
        $this->db->where('id', $id);
        $query = $this->db->get();
        return $query->row(0, 'Page');
    }

    /**
     * Create a Page object with a database entry matching the array contents.
     * @param array $data - Associative array of data to match against the 
     *                      database.
     * @return Page - Page object managing the database content.
     */
    private function getFromArray($data) {
        $this->db->where($data);
        $query = $this->db->get();
        return $query->row(0, 'Page');
    }
}
