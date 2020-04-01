<?php

namespace App\Model;

use Exception;
use App\Utility;

/**
 * User GetUsers Model:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class GetUsers { 

    /**
     * GetUsers: Validates the GetUsers form inputs, creates a new user in the
     * database and writes all necessary data into the session if the
     * registration was successful. Returns the new user's ID if everything is
     * okay, otherwise turns false.
     * @access public
     * @return boolean
     * @since 1.0.2
     */
    public static function all() {
        try {
            // Insert the new user record into the database, storing the unique
            // ID which will be returned on success.
            $User = new User;
            $users = $User->selectUser();
            return $users;
        } catch (Exception $ex) {
            Utility\Flash::danger($ex->getMessage());
        }
        return false;
    }

}
