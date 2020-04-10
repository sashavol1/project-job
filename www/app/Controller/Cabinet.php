<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Cabinet Controller:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class Cabinet extends Core\Controller {

    /**
     * Index: Renders the Cabinet view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example Cabinet/index
     * @return void
     * @since 1.0.2
     */
    public function index() {

        // Check that the user is unauthenticated.
        Utility\Auth::checkAuthenticated();

        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));
        $user = $userID === null ? false : Model\User::getInstance($userID);

        // Set any dependencies, data and render the view.
        $this->View->render("cabinet/index", [
            "user" =>  !empty($user) ? $user->data() : [],
            "title" => "Личный кабинет",
            "page" => 'index'
        ]);
    }

    /**
     * Index: Renders the Cabinet view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example Cabinet/add
     * @return void
     * @since 1.0.2
     */
    public function add() {

        // Check that the user is unauthenticated.
        Utility\Auth::checkAuthenticated();

        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));
        $user = $userID === null ? false : Model\User::getInstance($userID);

        // Set any dependencies, data and render the view.
        $this->View->render("cabinet/add", [
            "user" =>  !empty($user) ? $user->data() : [],
            "title" => "Добавить объявление",
            "page" => 'index',
            "post" => Utility\Session::get('post')
        ]);
    }

    /**
     * Index: Renders the Cabinet view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example Cabinet/add
     * @return void
     * @since 1.0.2
     */
    public function _add() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();
        
        // Process the register request, redirecting to the login controller if
        // successful or back to the register controller if not.
        Utility\Session::put('post', $_POST);
        if (Model\JobAdd::add()) {
            Utility\Redirect::to(APP_URL . "cabinet/add");
        }
        Utility\Redirect::to(APP_URL . "cabinet/add");
    }

    /**
     * Index: Renders the Cabinet view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example Cabinet/add
     * @return void
     * @since 1.0.2
     */
    public function edit() {

        // Check that the user is unauthenticated.
        Utility\Auth::checkAuthenticated();

        $id = intval(Utility\Input::trim(Utility\Input::get("id")));
        if (!$id) Utility\Redirect::to(APP_URL . "cabinet");
        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));
        $user = $userID === null ? false : Model\User::getInstance($userID)->data();

        // Get Job
        $Job = new model\Job;
        $current_job = $Job->findOneJob($id, $user->id)->data();
        if (empty($current_job)) Utility\Redirect::to(APP_URL . "cabinet/add");

        // Set any dependencies, data and render the view.
        $this->View->render("cabinet/edit", [
            "job" => $current_job,
            "user" => $user,
            "title" => "Добавить объявление",
            "page" => 'index',
            "post" => Utility\Session::get('post')
        ]);
    }

    /**
     * Index: Renders the Cabinet view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example Cabinet/add
     * @return void
     * @since 1.0.2
     */
    public function _edit() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();
        
        // Process the register request, redirecting to the login controller if
        // successful or back to the register controller if not.
        Utility\Session::put('post', $_POST);
        if (Model\JobAdd::edit()) {
            Utility\Redirect::to(APP_URL . "cabinet");
        }
        Utility\Redirect::to(APP_URL . "cabinet");
    }

}
