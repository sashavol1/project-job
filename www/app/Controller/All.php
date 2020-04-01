<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * List Controller:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */

class All extends Core\Controller {

    /**
     * Index: Renders the All view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example All/index
     * @return void
     * @since 1.0.2
     */
    public function index() {

        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));
        $user = $userID === null ? false : Model\User::getInstance($userID);

        // Set any dependencies, data and render the view.
        $this->View->addCSS("css/index.css");
        $this->View->addJS("js/index.jquery.js");
        $this->View->render("all/index", [
            "user" =>  !empty($user) ? $user->data() : [],
            "title" => "Главная",
            "page" => 'index'
        ]);
    }

}
