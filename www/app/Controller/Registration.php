<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Registration Controller:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class Registration extends Core\Controller {

    /**
     * Index: Renders the registration view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example registration/index
     * @return void
     * @since 1.0.2
     */
    public function index() {

        // Check that the user is unauthenticated.
        Utility\Auth::checkUnauthenticated();

        // Set any dependencies, data and render the view.
        $this->View->render("registration/index", [
            "title" => "Авторизация"
        ]);
    }

}
