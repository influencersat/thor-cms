<?php
/**
 * Handles database reading and writing for seamless management of user groups.
 * 
 * @author dcthor
 * @version 1.0
 */
class User_Group_Model extends CI_Model {
	const DB_TABLE = 'User_Groups';
	
	/**
	 * Initialize the model and load the database.
	 */
	public function __construct() {
		parent::__construct();
		$this->load->database();
	}
	
	/**
	 * Get the group object matching the input data.
	 * @param mixed $data
	 * @return User_Group
	 */
	public function get($data) {
		if ((is_int($data) || is_numeric($data)) && $data > 0) {
			return $this->getWithId($data);
		} else if (is_array($data)) {
			return $this->getWithData($data);
		} else {
			return new User_Group();
		}
	}
	
	/**
	 * Create a User_Group object populated with data associated with the given
	 * database ID.
	 * @param int $id
	 * @return User_Group
	 */
	private function getWithId($id) {
		$this->db->where('id', $id);
		$query = $this->db->get(self::DB_TABLE);
		$array = $query->row(0);
		return new User_Group($array);
	}
	
	/**
	 * Create a User_Group object with a database entry matching the array contents.
	 * @param array $data
	 * @return User_Group
	 */
	private function getWithData($data) {
		$this->db->where($data);
		$query = $this->db->get(self::DB_TABLE);
		$array = $query->row(0);
		return new User_Group($array);
	}
	
	/**
	 * Delete the User_Group object matching the input criteria.
	 * @param mixed $data
	 */
	public function delete($data) {
		if ((is_int($data) || is_numeric($data)) && $data > 0) {
			$this->deleteWithId($data);
		} else if (is_array($data)) {
			$this->deleteWithData($data);
		}
	}
	
	/**
	 * Delete the User_Group object with the given ID.
	 * @param int $id
	 */
	private function deleteWithId($id) {
		$this->db->where('id', $id);
		$this->db->delete(self::DB_TABLE);
	}
	
	/**
	 * Delete the User_Group object from the database that matches the contents 
	 * of the provided array.
	 * @param array $data
	 */
	private function deleteWithData($data) {
		$this->db->where($data);
		$this->db->delete(self::DB_TABLE);
	}
	
	/**
	 * Insert the given User_Group object into the database. If an entry with 
	 * the User_Group's ID already exists, replace it with the new page.
	 * @param User_Group $group
	 */
	public function insert($group) {
		if ($group instanceof User_Group) {
			$group->minimize();
			$this->db->insert(self::DB_TABLE, $group->getVars(), true);
		} else {
			throw new Exception("Failed User_Group insert: Provided data is not " .
					"an instance of a User_Group object.");
		}
	}
}
