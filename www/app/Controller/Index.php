<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Index Controller:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0
 */
class Index extends Core\Controller {

    /**
     * Index: Renders the index view. NOTE: This controller can only be accessed
     * by authenticated users!
     * @access public
     * @example index/index
     * @return void
     * @since 1.0
     */
    public function index($user = "") {

        // Check that the user is authenticated.
        // Utility\Auth::checkAuthenticated();

        // // Get an instance of the user model using the ID stored in the session. 
        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));

        $user = $userID === null ? false : Model\User::getInstance($userID);
        // if (Model\User::getInstance($userID) === null) {
        //     Utility\Session::destroy();
        //     Utility\Redirect::to(APP_URL);
        // }
        // if (!$user = Model\User::getInstance($userID)) {
        //     Utility\Redirect::to(APP_URL);
        // }

        // Set any dependencies, data and render the view.
        $this->View->addCSS("css/index.css");
        $this->View->addJS("js/index.jquery.js");
        $this->View->render("index/index", [
            "user" =>  !empty($user) ? $user->data() : [],
            "title" => "Главная",
            "page" => 'index'
        ]);
    }

    /**
     * list: Renders the index view. NOTE: This controller can only be accessed
     * by authenticated users!
     * @access public
     * @example index/index
     * @return void
     * @since 1.0
     */
    public function list($user = "") {

        var_dump($user);

        // Check that the user is authenticated.
        // Utility\Auth::checkAuthenticated();

        // // Get an instance of the user model using the ID stored in the session. 
        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));

        $user = $userID === null ? false : Model\User::getInstance($userID);
        // if (Model\User::getInstance($userID) === null) {
        //     Utility\Session::destroy();
        //     Utility\Redirect::to(APP_URL);
        // }
        // if (!$user = Model\User::getInstance($userID)) {
        //     Utility\Redirect::to(APP_URL);
        // }

        // Set any dependencies, data and render the view.
        $this->View->addCSS("css/index.css");
        $this->View->addJS("js/index.jquery.js");
        $this->View->render("index/index", [
            "user" =>  !empty($user) ? $user->data() : [],
            "title" => "Главная",
            "page" => 'index'
        ]);
    }

}
