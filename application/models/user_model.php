<?php
/**
 * Designed for management of user information allowing for error-less reading and
 * writing to the database.
 *
 * @author David Thor
 * @version 1.0
 */
class User_Model extends CI_Model {
    private $DB_TABLE = 'Users';

    /**
     * Initialize the model and load the database.
     */
    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->library('User');
    }

    /**
     * Get the user object matching the input data.
     * @param mixed $data - Mixed input criteria used to match against the
     *                      database.
     * @return User - User object representing the database entry.
     */
    public function get($data) {
        if ((is_int($data) || is_numeric($data)) && $data > 0) {
            return $this->getWithId($data);
        } else if (is_array($data)) {
            return $this->getWithData($data);
        } else {
            return new User();
        }
    }

    /**
     * Create a User object populated with data associated with the given
     * database ID.
     * @param int $id - Database reference ID
     * @return User - User object managing the database content.
     */
    private function getWithId($id) {
        $this->db->where('id', $id);
        $query = $this->db->get($this->DB_TABLE);
        $data = $query->row(0);
        return new User($data);
    }

    /**
     * Create a User object with a database entry matching the array contents.
     * @param array $data - Associative array of data to match against the 
     *                      database.
     * @return User - User object managing the database content.
     */
    private function getWithData($data) {
        $this->db->where($data);
        $query = $this->db->get($this->DB_TABLE);
        $array = $query->row(0);
        return new User($array);
    }

    /**
     * Delete the User object matching the input criteria.
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
     * Delete the User object with the given ID.
     * @param int $id
     */
    private function deleteWithId($id) {
        $this->db->where('id', $id);
        $this->db->delete($this->DB_TABLE);
    }

    /**
     * Delete the User object from the database that matches the contents of
     * the provided array.
     * @param array $data - Associative array of data to match against the
     *                      database.
     */
    private function deleteWithData($data) {
        $this->db->where($data);
        $this->db->delete($this->DB_TABLE);
    }

    /**
     * Insert the given User object into the database. If an entry with the 
     * User's ID already exists, replace it with the new page.
     * @param User $page - New User object to add to the database
     */
    public function insert($user) {
        if ($user instanceof User) {
            $user->minimize();
            $this->db->insert($this->DB_TABLE, $user->getVars(), true);
        } else {
            throw new Exception("Failed User insert: Provided data is not an " . 
                                "instance of a User object.");
        }
    }
}
