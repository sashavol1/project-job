<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Model\Company;
use App\Utility;

/**
 * Settings Controller:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class Settings extends Core\Controller {

    /**
     * Index: Renders the settings view.
     * @access public
     * @example settings/index
     * @return void
     * @since 1.0.2
     */
    public function index() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        // Get an instance of the user model using the ID stored in the session. 
        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));
        $User = Model\User::getInstance($userID);
        Utility\Auth::checkIsAdmin($User);
        if (!$User) {
            Utility\Redirect::to(APP_URL);
        }

        $company = new Company();

        // Set any dependencies, data and render the view.
        $this->View->render("settings/index", [
            "title" => "Settings",
            "user" => $User->data(),
            "company" => $company->getAllCompany()
        ]);
    }

    /**
     * Registration: Renders the settings view.
     * @access public
     * @example settings/registration
     * @return void
     * @since 1.0.2
     */
    public function registration() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        // Get an instance of the user model using the ID stored in the session. 
        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));
        $User = Model\User::getInstance($userID);
        Utility\Auth::checkIsAdmin($User);
        if (!$User) {
            Utility\Redirect::to(APP_URL);
        }

        // Set any dependencies, data and render the view.
        $this->View->render("settings/registration", [
            "title" => "registration",
            "user" => $User->data(),
            "users" => Model\GetUsers::all()
        ]);
    }

    /**
     * Users: Renders the users list.
     * @access public
     * @example settings/users
     * @return void
     * @since 1.0.2
     */
    public function users() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();

        // Get an instance of the user model using the ID stored in the session. 
        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));
        $User = Model\User::getInstance($userID);
        Utility\Auth::checkIsAdmin($User);
        if (!$User) {
            Utility\Redirect::to(APP_URL);
        }

        // Set any dependencies, data and render the view.
        $this->View->render("settings/users", [
            "title" => "registration",
            "user" => $User->data(),
            "users" => Model\GetUsers::all()
        ]);
    }

    /**
     * Settings: Processes a update company. NOTE: This controller can
     * only be accessed by authenticated users!
     * @access public
     * @example settings/_register
     * @return void
     * @since 1.0.2
     */
    public function _update_company() {        
        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();
        
        $company = new Company();
        if ($company->updateCompany((array) Utility\Input::post("ids"))) {
            Utility\Redirect::to(APP_URL . "settings/index");
        }
        Utility\Redirect::to(APP_URL . "settings/index");
    }

    /**
     * Settings: Processes a create account request. NOTE: This controller can
     * only be accessed by authenticated users!
     * @access public
     * @example settings/_register
     * @return void
     * @since 1.0.2
     */
    public function _registration() {
        
        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();
        if (Model\UserRegister::register()) {
            Utility\Redirect::to(APP_URL . "settings/users");
        }
        Utility\Redirect::to(APP_URL . "settings/registration");
    }

    /**
     * Settings: Processes a delete account request. NOTE: This controller can
     * only be accessed by authenticated users!
     * @access public
     * @example settings/_delete
     * @return void
     * @since 1.0.2
     */
    public function _delete() {
        
        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();        
        if (Model\UserRegister::delete()) {
            Utility\Redirect::to(APP_URL . "settings/users");
        }
        Utility\Redirect::to(APP_URL . "settings/users");
    }

}
