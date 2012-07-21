<?php
/**
 * Designed for management of page content allowing for error-less reading and
 * writing to the database.
 *
 * @author David Thor
 * @version 1.0
 */
class Page_Model extends CI_Model {
    private $DB_TABLE = 'Pages';

    /**
     * Initialize the model and load the database.
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library(array('Page', 'User'));
    }

    /**
     * Get the page object matching the input data.
     * @param mixed $data - Mixed input criteria used to match against the
     *                      database.
     * @return Page - Page object representing the database entry.
     */
    public function get($data) {
        if ((is_int($data) || is_numeric($data)) && $data > 0) {
            return $this->getWithId($data);
        } else if (is_array($data)) {
            return $this->getWithData($data);
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
    private function getWithId($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->DB_TABLE);
        $data = $query->row(0);
        return new Page($data);
    }

    /**
     * Create a Page object with a database entry matching the array contents.
     * @param array $data - Associative array of data to match against the 
     *                      database.
     * @return Page - Page object managing the database content.
     */
    private function getWithData($data) {
        $this->db->where($data);
        $query = $this->db->get($this->DB_TABLE);
        $array = $query->row(0);
        return new Page($array);
    }

    /**
     * Delete the page object matching the input criteria.
     * @param mixed $data - Mixed input criteria used to match against the
     *                      database.
     */
    public function delete($data) {
        if ((is_int($data) || is_numeric($data)) && $data > 0) {
            $this->deleteWithId($data);
        } else if (is_array($data)) {
            $this->deleteWithData($data);
        }
    }

    /**
     * Delete the page object with the given ID.
     * @param int $id
     */
    private function deleteWithId($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->DB_TABLE);
    }

    /**
     * Delete the page object from the database that matches the contents of
     * the provided array.
     * @param array $data - Associative array of data to match against the
     *                      database.
     */
    private function deleteWithData($data) {
        $this->db->where($data);
        $this->db->delete($this->DB_TABLE);
    }

    /**
     * Insert the given page object into the database. If an entry with the 
     * Page's ID already exists, replace it with the new page.
     * @param Page $page - New page object to add to the database
     */
    public function insert($page) {
        if ($page instanceof Page) {
            $page->minimize();
            $this->db->insert($this->DB_TABLE, $page->getVars(), true);
        } else {
            throw new Exception("Failed Page insert: Provided data is not an " . 
                                "instance of a Page object.");
        }
    }
}
