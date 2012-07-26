<?php
require_once "Library.php";

/**
 * Library managing the groups that user's are members of.
 *
 * @author David Thor
 * @version 1.0
 */
class User_Group extends Library {
    protected $id;
    protected $name;
    protected $description;
    protected $permissions;

    const MANAGE_PAGES = 1;
    const MANAGE_USERS = 2;

    /**
     * Populate the group with the provided data and load any
     * required dependencies.
     * @param array $data
     */
    public function __construct($data = array()) {
        $this->loadDependencies();

        foreach ($data as $key => $value) {
            $this->$key = $value;
        }
    }

    /**
     * Load any libraries that this class depends on to function
     * @return CI_Controller
     */
    public function &loadDependencies() {
        $ci =& get_instance();
        return $ci;
    }

    /**
     * Minimize the group variables to database friendly values.
     */
    public function minimize() {
        if (is_array($this->permissions)) {
            $this->permissions = json_encode($this->permissions);
        }
    }

    /**
     * Get the database reference ID of the group.
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Set a new reference ID for the group.
     * @param int $id
     */
    public function setId($id) {
        if ((is_numeric($id) || is_int($id)) && $id > 0) {
            $this->id = $id;
        }
    }

    /**
     * Get the name of the user group.
     * @return String
     */
    public function getName() {
        return $this->name;
    }

    /**
     * Set a new name for the user group.
     * @param String $name
     */
    public function setName($name) {
        $this->name = $name;
    }

    /**
     * Get the description of the group.
     * @return String
     */
    public function getDescription() {
        return $this->description;
    }

    /**
     * Set a new description for the group.
     * @param String $description
     */
    public function setDescription($description) {
        $this->description = $description;
    }

    /**
     * Get an associative array of data indicating the group
     * permissions scheme.
     * @return array
     */
    public function getPermissions() {
        if (!is_array($this->permissions)) {
            $this->permissions = json_decode($this->permissions);
        }

        return $this->permissions;
    }

    /**
     * Set new permissions for the group.
     * @param array $permissions
     */
    public function setPermissions($permissions) {
        if (is_array($permissions)) {
            $this->permissions = $permissions;
        }
    }

    /**
     * Add a level of permissions to the group.
     * @param int $permissionId
     */
    public function addPermission($permissionId) {
        if (!in_array($permissionId, $this->permissions)) {
            $this->permissions[] = $permissionId;
        }
    }

    /**
     * Remove a level of permissions from the group.
     * @param int $permissionId
     */
    public function removePermission($permissionId) {
        if (($key = array_search($permissionsId, $this->permissions)) !== false) {
            unset($this->permissions[$key]);
        }
    }
}
