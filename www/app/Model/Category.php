<?php

namespace App\Model;

use Exception;
use App\Core;
use App\Utility;

/**
 * Cat Model:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class Cat extends Core\Model {

    /**
     * Create Cat: Inserts a new user into the database, returning the unique
     * user if successful, otherwise returns false.
     * @access public
     * @param array $fields
     * @return string|boolean
     * @since 1.0.3
     * @throws Exception
     */
    public function createCat(array $fields) {
        if (!$catId = $this->create("categories", $fields)) {
            throw new Exception('Ошибка в создании категории');
        }
        return $catId;
    }

    /**
     * Find Cat
     * @access public
     * @param array $param
     * @return boolean
     * @since 1.0.3
     */
    public function findCat(array $param = []) {
        return($this->findAll("categories", $param));
    }

    /**
     * Find User: Retrieves and stores a specified user record from the database
     * into a class property. Returns true if the record was found, or false if
     * not.
     * @access public
     * @param string $user
     * @return boolean
     * @since 1.0.3
     */
    public function findOneCat($cat_id) {
        return($this->find("categories", [['id', "=", $cat_id]]));
    }  
    
    /**
     * Update Cat: Updates a specified tag record in the database.
     * @access public
     * @param array $fields
     * @param integer $tagId [optional]
     * @return void
     * @since 1.0.3
     * @throws Exception
     */
    public function updateCat(array $fields, $tagId = null) {
        if (!$this->update("categories", $fields, $tagId)) {
            throw new Exception('Ошибка при обновлении категории');
        }
    }
    
    /**
     * Select All Cat: Select a specified tag record in the database.
     * @access public
     * @param array $where
     * @return array
     * @since 1.0.3
     * @throws Exception
     */
    public function selectCat(array $where = []) {
        return($this->findAll("categories"));
    }

}
