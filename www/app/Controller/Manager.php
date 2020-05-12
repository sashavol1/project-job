<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Manager Controller:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.1.0
 */
class Manager extends Core\Controller {

    /** @var array The register form inputs. */
    private static $_inputs_tags = [
        "name" => [
            "required" => true,
            "min_characters" => 4,
            "max_characters" => 120
        ],
        "description" => [
            "required" => true,
            "min_characters" => 30,
            "max_characters" => 1000
        ]
    ];

    /**
     * beforeAction
     * @access private
     * @return void
     * @since 1.1.0
     */
    public function beforeAction() {
        Utility\Auth::checkAuthenticated();
        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));
        self::$user = $userID === null ? false : Model\User::getInstance($userID);
        Utility\Auth::checkIsAdmin(self::$user);
    }

    /**
     * Index: Renders the manager view. 
     * @access public
     * @example manager/index
     * @return void
     * @since 1.1.0
     */
    public function index() {
        $model = new model\Crud;
        $tags = $model->_find('tags')->data();

        $this->View->render("manager/index", [
            "user" =>  self::$user->data(),
            "tags" =>  $tags,
            "title" => "Административная часть"
        ]);
    }

    /**
     * List tags
     * @access public
     * @example manager/tag
     * @return void
     * @since 1.1.0
     */
    public function tag() {
        $model = new model\Crud;
        $tags = $model->_find('tags')->data();

        // Set any dependencies, data and render the view.
        $this->View->render("manager/tag", [
            "user" =>  self::$user->data(),
            "tags" =>  $tags,
            "title" => "Административная часть"
        ]);
    }

    /**
     * Edit tag
     * @access public
     * @example manager/tag
     * @return void
     * @since 1.1.0
     */
    public function tag_edit() {
        $id = intval(Utility\Input::trim(Utility\Input::get("id")));
        $model = new model\Crud;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Utility\Input::check($_POST, self::$_inputs_tags)) {
                Utility\Session::put('post', $_POST);
                Utility\Redirect::to(APP_URL . "manager/tag_edit?id=".$id);
            }
            Utility\Session::put('post', []);
            $model->_update('tags',[
                "name" => Utility\Input::trim(Utility\Input::post("name")),
                "description" => Utility\Input::trim(Utility\Input::post("description"))
            ], $id);
            Utility\Flash::success('Обновили Тэг.');
            Utility\Redirect::to(APP_URL . "manager/tag_edit?id=".$id);
        }

        $tag = $model->_findById('tags', $id);
        if (empty($tag)) {
            Utility\Redirect::to(APP_URL . "manager/tag");
        }

        $this->View->render("manager/tag-edit", [
            "user" =>  self::$user->data(),
            "tag" =>  $tag,
            "title" => "Административная часть",
            "post" => Utility\Session::get('post')
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
