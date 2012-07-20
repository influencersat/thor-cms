<?php
/**
 * Abstract class for all libraries.
 *
 * @author David Thor
 * @version 1.0
 */
class Library {
    /**
     * Get all the library's variables as an array.
     * @return array - Variables of the library
     */
    public function getVars() {
        return get_object_vars($this);
    }
}