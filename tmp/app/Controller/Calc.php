<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;
use App\Model\Company;

/**
 * Calc Controller:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0
 */
class Calc extends Core\Controller {

    /**
     * Index: Renders the Calc view. NOTE: This controller can only be
     * accessed by unauthenticated users!
     * @access public
     * @example Calc/index/{$1}
     * @param string $user [optional]
     * @return void
     * @since 1.0.4
     */
    public function index($user = "") {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        // Get an instance of the user model using the ID stored in the session. 
        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));
        if (!$User = Model\User::getInstance($userID)) {
            Utility\Redirect::to(APP_URL);
        }

        // List company
        $company = new Company();

        // Set any dependencies, data and render the view.
        $this->View->render("calc/index", [
            "title" => "Калькулятор",
            "user" => $User->data(),
            "page" => 'calc',
            "company" => $company->getAllCompany()
        ]);
    }

}
