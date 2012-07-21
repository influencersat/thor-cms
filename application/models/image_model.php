<?php
/**
 * Designed for management of images allowing for error-less reading and
 * writing to the database.
 *
 * @author David Thor
 * @version 1.0
 */
class Image_Model extends CI_Model {
    private $DB_TABLE = 'Images';

    /**
     * Initialize the model and load the database.
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('Image');
    }

    /**
     * Get the image object matching the input data.
     * @param mixed $data - Mixed input criteria used to match against the
     *                      database.
     * @return Page - Image object representing the database entry.
     */
    public function get($data) {
        if ((is_int($data) || is_numeric($data)) && $data > 0) {
            return $this->getWithId($data);
        } else if (is_array($data)) {
            return $this->getWithData($data);
        } else {
            return new Image();
        }
    }

    /**
     * Create an Image object populated with data associated with the given
     * database ID.
     * @param int $id - Database reference ID
     * @return Image - Image object managing the database content.
     */
    private function getWithId($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->DB_TABLE);
        $array = $query->row(0);
        return new Image($array);
    }

    /**
     * Create an Image object with a database entry matching the array contents.
     * @param array $data - Associative array of data to match against the 
     *                      database.
     * @return Image - Image object managing the database content.
     */
    private function getWithData($data) {
        $this->db->where($data);
        $query = $this->db->get($this->DB_TABLE);
        return $query->row(0, 'Image');
    }

    /**
     * Delete the Image object matching the input criteria.
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
     * Delete the Image object with the given ID.
     * @param int $id
     */
    private function deleteWithId($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->DB_TABLE);
    }

    /**
     * Delete the Image object from the database that matches the contents of
     * the provided array.
     * @param array $data - Associative array of data to match against the
     *                      database.
     */
    private function deleteWithData($data) {
        $this->db->where($data);
        $this->db->delete($this->DB_TABLE);
    }

    /**
     * Insert the given Image object into the database. If an entry with the 
     * Image's ID already exists, replace it with the new page.
     * @param Image $image - New image object to add to the database
     */
    public function insert($image) {
        if ($image instanceof Image) {
            $image->minimize();
            $this->db->insert($this->DB_TABLE, $image->getVars(), true);
        } else {
            throw new Exception("Failed Image insert: Provided data is not an " . 
                                "instance of a Image object.");
        }
    }
}
