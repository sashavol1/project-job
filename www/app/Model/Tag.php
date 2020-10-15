<?php

namespace App\Model;

use Exception;
use App\Core;
use App\Utility;

/**
 * Tag Model:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class Tag extends Core\Model {

    /**
     * Create Tag: Inserts a new user into the database, returning the unique
     * user if successful, otherwise returns false.
     * @access public
     * @param array $fields
     * @return string|boolean
     * @since 1.0.3
     * @throws Exception
     */
    public function createTag(array $fields) {
        if (!$tagId = $this->create("tags", [$fields])) {
            throw new Exception('Ошибка в создании ТЭГА');
        }
        return $tagId;
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
    public function findTags(array $param = []) {
        return($this->findAll("tags", $param));
    }

    /**
     * Find Tag: Retrieves and stores a specified user record from the database
     * into a class property. Returns true if the record was found, or false if
     * not.
     * @access public
     * @param int $tag_id
     * @return boolean
     * @since 1.0.3
     */
    public function findOneTag($tag_id) {
        return($this->find("tags", [['id', "=", $tag_id]]));
    }  
    
    /**
     * Update Tag: Updates a specified tag record in the database.
     * @access public
     * @param array $fields
     * @param integer $tagId [optional]
     * @return void
     * @since 1.0.3
     * @throws Exception
     */
    public function updateTag(array $fields, $tagId = null) {
        if (!$this->update("tags", $fields, $tagId)) {
            throw new Exception('Ошибка при обновлении тега');
        }
    }

    /**
     * Select All Tag: Select a specified tag record in the database.
     * @access public
     * @param array $where
     * @return array
     * @since 1.0.3
     * @throws Exception
     */
    public function selectTag(array $where = []) {
        return($this->findAll("tags"));
    }

}
