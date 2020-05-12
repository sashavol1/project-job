<?php

namespace App\Model;

use Exception;
use App\Core;
use App\Utility;

/**
 * CRUD Model:
 *
 * @author Aleksandr
 * @since 1.1.0
 */
class CRUD extends Core\Model {

    /**
     * Create
     * @access public
     * @param string $table
     * @param array $fields
     * @return string|boolean
     * @since 1.1.0
     * @throws Exception
     */
    public function _create(string $table = null, array $fields) {
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
     * @since 1.1.0
     */
    public function _find(string $table = null, array $rules = []) {
        return($this->findAll($table, $rules));
    }

    /**
     * Find One Row
     * @access public
     * @param string $table
     * @param int $id
     * @return boolean
     * @since 1.1.0
     */
    public function _findById(string $table = null, $id) {
        return($this->find($table, [['id', "=", $id]])->data());
    }  
    
    /**
     * Update.
     * @access public
     * @param string $table
     * @param array $fields
     * @param integer $tagId [optional]
     * @return void
     * @since 1.1.0
     * @throws Exception
     */
    public function _update(string $table = null, array $fields, $id = null) {
        if (!$this->update($table, $fields, $id)) {
            throw new Exception('Ошибка при обновлении');
        }
    }
    
    /**
     * Delete.
     * @access public
     * @param string $table
     * @param int $id
     * @return array
     * @since 1.1.0
     * @throws Exception
     */
    public function _delete(string $table = null, int $id = null) {
        return( $this->delete($table, ['id', "=", $id]) );
    }

}
