<?php

namespace App\Model;

use Exception;
use App\Core;
use App\Utility;

/**
 * Company Model:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class Company extends Core\Model { 

    /**
     * Company: Validates the Company form inputs, creates a new user in the
     * database and writes all necessary data into the session if the
     * registration was successful. Returns the new user's ID if everything is
     * okay, otherwise turns false.
     * @access public
     * @return boolean
     * @since 1.0.2
     */
    public function updateCompany(array $fields = []) {
        $company = json_decode( json_encode((array) $this->getAllCompany()->data()), true);
        for ($i = 0; count($company) > $i; $i++) {
            if ($this->update("tcompany", ['show' => 0], (int) $company[$i]["id"] )) {
                throw new Exception(Utility\Text::get("COMPANY_UPDATE_EXCEPTION"));
            }
        }
        
        if (!empty($fields)) {
            for ($i = 0; count($fields) > $i; $i++) {
                if ($this->update("tcompany", ['show' => 1], (int) $fields[$i])) {
                    throw new Exception(Utility\Text::get("COMPANY_UPDATE_EXCEPTION"));
                }
            }
        }
    }

    /**
     * Company: Validates the Company form inputs, creates a new user in the
     * database and writes all necessary data into the session if the
     * registration was successful. Returns the new user's ID if everything is
     * okay, otherwise turns false.
     * @access public
     * @return boolean
     * @since 1.0.2
     */
    public function getAllCompany() {
        return($this->findAll("tcompany"));
    }

}
