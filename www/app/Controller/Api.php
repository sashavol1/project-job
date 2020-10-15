<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;
use App\Utility\Input;
use App\Utility\Redirect;

/**
 * List Controller:
 *
 * @author Aleksandr Volmanov <info@volmanov.ru>
 * @since 1.0.0
 */

class Api extends Core\Controller {

    /**
     * beforeAction
     * @access private
     * @return void
     * @since 1.1.0
     */
    public function beforeAction() {
        // Тут проверка API
        header('Content-Type: application/json');
        Utility\Auth::checkAuthenticated();
        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));
        self::$user = $userID === null ? false : Model\User::getInstance($userID);
    }

    /**
     * Index: Simple API
     * @access public
     * @example All/index
     * @return void
     * @since 1.0.2
     */
    public function index() {

        if ($_SERVER['REQUEST_METHOD'] !== 'post') {
            // Check that the user is authenticated.
            // Utility\Auth::checkAuthenticated();

            // // Get an instance of the user model using the ID stored in the session. 
            $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));
            $this->View->renderJson([]);
        } else {
            echo 'welcome, to the rice field';
        }

    }

}
