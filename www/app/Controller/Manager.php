<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Manager Controller:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class Manager extends Core\Controller {

    /**
     * beforeAction
     * @access private
     * @return void
     * @since 1.0.2
     */
    public function beforeAction() {
        Utility\Auth::checkAuthenticated();
        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));
        $user = $userID === null ? false : Model\User::getInstance($userID);
        Utility\Auth::checkIsAdmin($user);
    }

    /**
     * Index: Renders the manager view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example manager/index
     * @return void
     * @since 1.0.2
     */
    public function index() {
        $Tag = new model\Tag;
        $tags = $Tag->findTags()->data();

        $this->View->render("manager/index", [
            "user" =>  !empty($user) ? $user->data() : [],
            "tags" =>  $tags,
            "title" => "Административная часть"
        ]);
    }

    /**
     * Index: Renders the manager view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example manager/index
     * @return void
     * @since 1.0.2
     */
    public function tag() {
        $Tag = new model\Tag;
        $tags = $Tag->findTags()->data();

        // Set any dependencies, data and render the view.
        $this->View->render("manager/tag", [
            "user" =>  !empty($user) ? $user->data() : [],
            "tags" =>  $tags,
            "title" => "Административная часть"
        ]);
    }

    public function _tag_add() {
        $model = new model\Tag;
        $model->createTag([
            "name" => Utility\Input::trim(Utility\Input::post("name")),
            "description" => Utility\Input::trim(Utility\Input::post("description"))
        ]);
        Utility\Redirect::to(APP_URL . "manager/tag");
    }

}
