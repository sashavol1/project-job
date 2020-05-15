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

    /** @var array Validate tags. */
    private static $_inputs_tags = [
        "name" => [
            "required" => true,
            "min_characters" => 4,
            "max_characters" => 120
        ],
        "description" => [
            "required" => true,
            "min_characters" => 5,
            "max_characters" => 1000
        ]
    ];

    /** @var array Validate categories. */
    private static $_inputs_categories = [
        "name" => [
            "required" => true,
            "min_characters" => 4,
            "max_characters" => 120
        ],
        "description" => [
            "required" => true,
            "min_characters" => 5,
            "max_characters" => 1000
        ],
        "slug" => [
            "required" => true,
            "min_characters" => 3,
            "max_characters" => 64
        ],
        "popularity" => [
            "required" => true,
            "min_int" => 1,
            "max_int" => 100
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
        $categories = $model->_find('categories')->data();
        $jobs = $model->_find('jobs')->data();

        $this->View->render("manager/index", [
            "user" =>  self::$user->data(),
            "tags" =>  $tags,
            "jobs" =>  $jobs,
            "categories" =>  $categories,
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
            Utility\Redirect::to(APP_URL . "manager");
        }

        $this->View->render("manager/tag-edit", [
            "user" =>  self::$user->data(),
            "tag" =>  $tag,
            "title" => "Административная часть",
            "post" => Utility\Session::get('post')
        ]);
    }

    /**
     * Edit add
     * @access public
     * @example manager/tag_add
     * @return void
     * @since 1.1.0
     */
    public function tag_add() {
        $model = new model\Crud;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Utility\Input::check($_POST, self::$_inputs_tags)) {
                Utility\Session::put('post', $_POST);
                Utility\Redirect::to(APP_URL . "manager/tag_add");
            }
            Utility\Session::put('post', []);
            $tagId = $model->_create('tags', [
                "name" => Utility\Input::trim(Utility\Input::post("name")),
                "description" => Utility\Input::trim(Utility\Input::post("description"))
            ]);
            Utility\Flash::success('Добавили новый ТЭГ.');
            Utility\Redirect::to(APP_URL . "manager/tag_edit?id=".$tagId);
        }

        $this->View->render("manager/tag-add", [
            "user" =>  self::$user->data(),
            "title" => "Административная часть",
            "post" => Utility\Session::get('post')
        ]);
    }

    /**
     * Edit category_edit
     * @access public
     * @example manager/category_edit
     * @return void
     * @since 1.1.0
     */
    public function category_edit() {
        $id = intval(Utility\Input::trim(Utility\Input::get("id")));
        $model = new model\Crud;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Utility\Input::check($_POST, self::$_inputs_categories)) {
                Utility\Session::put('post', $_POST);
                Utility\Redirect::to(APP_URL . "manager/category_edit?id=".$id);
            }
            Utility\Session::put('post', []);
            $model->_update('categories',[
                "name" => Utility\Input::trim(Utility\Input::post("name")),
                "description" => Utility\Input::trim(Utility\Input::post("description"))
            ], $id);
            Utility\Flash::success('Обновили категорию.');
            Utility\Redirect::to(APP_URL . "manager/category_edit?id=".$id);
        }

        $category = $model->_findById('categories', $id);
        if (empty($category)) {
            Utility\Redirect::to(APP_URL . "manager");
        }

        $this->View->render("manager/category-edit", [
            "user" =>  self::$user->data(),
            "category" =>  $category,
            "title" => "Административная часть",
            "post" => Utility\Session::get('post')
        ]);
    }

    /**
     * Add
     * @access public
     * @example manager/category_add
     * @return void
     * @since 1.1.0
     */
    public function category_add() {
        $model = new model\Crud;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Utility\Input::check($_POST, self::$_inputs_categories)) {
                Utility\Session::put('post', $_POST);
                Utility\Redirect::to(APP_URL . "manager/category_add");
            }
            Utility\Session::put('post', []);
            $tagId = $model->_create('categories', [
                "name" => Utility\Input::trim(Utility\Input::post("name")),
                "dt_add" => date('Y-m-d H:i:s'),
                "description" => Utility\Input::trim(Utility\Input::post("description"))
            ]);
            Utility\Flash::success('Добавили новый ТЭГ.');
            Utility\Redirect::to(APP_URL . "manager/category_edit?id=".$tagId);
        }

        $this->View->render("manager/category-add", [
            "user" =>  self::$user->data(),
            "title" => "Административная часть",
            "post" => Utility\Session::get('post')
        ]);
    }

}
