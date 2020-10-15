<?php

namespace App\Model;

use Exception;
use App\Core;
use App\Utility;

/**
 * Job Model:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class Job extends Core\Model {

    /**
     * Create Job: Inserts a new user into the database, returning the unique
     * user if successful, otherwise returns false.
     * @access public
     * @param array $fields
     * @return string|boolean
     * @since 1.0.3
     * @throws Exception
     */
    public function createJob(array $fields) {
        if (!$jobID = $this->create("jobs", [$fields])) {
            throw new Exception(Utility\Text::get("NEW_JOB_EXCEPTION"));
        }
        return $jobID;
    }

    /**
     * Get Instance: Returns an instance of the User model if the specified job
     * exists in the database. 
     * @access public
     * @param string $job
     * @return User|null
     * @since 1.0.2
     */
    public static function getInstance($job) {
        $Job = new Job();
        if ($Job->findJobs($job)->exists()) {
            return $Job;
        }
        return null;
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
    public function findJobs(array $param = []) {
        return($this->findAll("jobs", $param));
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
    public function findOneJob($job_id, $client_id) {
        return($this->find("jobs", [['id', "=", $job_id], ['client_id', "=", $client_id]]));
    }
    
    

    /**
     * Update Job: Updates a specified user record in the database.
     * @access public
     * @param array $fields
     * @param integer $userID [optional]
     * @return void
     * @since 1.0.3
     * @throws Exception
     */
    public function updateJob(array $fields, $userID = null) {
        if (!$this->update("jobs", $fields, $userID)) {
            throw new Exception(Utility\Text::get("USER_UPDATE_EXCEPTION"));
        }
    }
    
    

    /**
     * Select All User: Select a specified user record in the database.
     * @access public
     * @param array $where
     * @return array
     * @since 1.0.3
     * @throws Exception
     */
    public function selectJob(array $where = []) {
        return($this->findAll("users"));
    }
    
    

    /**
     * Delete User: Select a specified user record in the database.
     * @access public
     * @param array $where
     * @return array
     * @since 1.0.3
     * @throws Exception
     */
    public function deleteUser(array $fields = []) {
        return( $this->delete("users", ['id', "=", $fields['id']]) );
    }

}
