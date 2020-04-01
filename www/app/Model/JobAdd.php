<?php

namespace App\Model;

use Exception;
use App\Utility;

/**
 * Job Add Model:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class JobAdd {

    /** @var array The register form inputs. */
    private static $_inputs = [
        "name" => [
            "required" => true,
            "min_characters" => 6,
            "max_characters" => 120
        ],
        "work_annonce" => [
            "required" => true,
            "min_characters" => 6,
            "max_characters" => 330
        ],
        "work_requirements" => [
            "required" => true,
            "min_characters" => 6,
            "max_characters" => 330
        ],
        "work_conditions" => [
            "required" => true,
            "min_characters" => 6,
            "max_characters" => 330
        ],
        // "email" => [
        //     "filter" => "email",
        //     "required" => true,
        //     "unique" => "users"
        // ],
    ];

    /**
     * Add: Validates the register form inputs, creates a new user in the
     * database and writes all necessary data into the session if the
     * registration was successful. Returns the new user's ID if everything is
     * okay, otherwise turns false.
     * @access public
     * @return boolean
     * @since 1.0.2
     */
    public static function add() {

        // Validate the register form inputs.
        if (!Utility\Input::check($_POST, self::$_inputs)) {
            return false;
        }
        try {
            // Generate a salt, which will be applied to the during the password
            // hashing process.
            $salt = Utility\Hash::generateSalt(32);

            // Insert the new user record into the database, storing the unique
            // ID which will be returned on success.
            $Job = new Job;
            $jobID = $Job->createJob([
                "name" => Utility\Input::trim(Utility\Input::post("name")),
                "text" => Utility\Input::trim(Utility\Input::post("work_annonce")) . '%br%' . Utility\Input::trim(Utility\Input::post("work_requirements")) . '%br%' . Utility\Input::trim(Utility\Input::post("work_conditions")),
                "status" => 'active',
                "announcement" => Utility\Input::trim(Utility\Input::post("work_annonce"))
            ]);

            // где-то тут создание категорий

            // Write all necessary data into the session as the user has been
            // successfully registered and return the user's unique ID.
            Utility\Flash::success(Utility\Text::get("NEW_JOB_CREATED"));
            return $jobID;
        } catch (Exception $ex) {
            Utility\Flash::danger($ex->getMessage());
        }
        return false;
    }

}
