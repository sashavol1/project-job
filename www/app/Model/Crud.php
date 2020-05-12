<?php

namespace App\Model;

use Exception;
use App\Core;
use App\Utility;

/**
 * CRUD Model:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class CRUD extends Core\Model {

    /**
     * Create
     * @access public
     * @param string $table
     * @param array $fields
     * @return string|boolean
     * @since 1.0.3
     * @throws Exception
     */
    public function create(string $table = null, array $fields) {
        if (!$id = $this->create($table, [$fields])) {
            throw new Exception('Ошибка в создании');
        }
        return $id;
    }

    /**
     * Find
     * @access public
     * @param string $table
     * @param array $rules
     * @return boolean
     * @since 1.0.3
     */
    public function find(string $table = null, array $rules = []) {
        return($this->findAll($table, $rules));
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
