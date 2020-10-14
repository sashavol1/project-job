<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;
use App\Utility\Input;
use App\Utility\Redirect;

/**
 * Category Controller:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */

class Cat extends Core\Controller {

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
    }

    /**
     * Index: Renders the All view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example Cat/index
     * @return void
     * @since 1.0.2
     */
    public function index() {
        Utility\Redirect::to(APP_URL);
    }

    /**
     * detail
     * @access public
     * @example Cat/url
     * @return void
     * @since 1.0.2
     */
    public function detail() {

        $urls = explode("/", filter_var(rtrim(Input::get("url"), "/"), FILTER_SANITIZE_URL));
        if (count($urls) !== 2) {            
            Redirect::to(404);
        }

        // // Get an instance of the user model using the ID stored in the session. 
        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));

        $user = $userID === null ? false : Model\User::getInstance($userID);

        // Get All job
        $model = new model\Crud;

        $categories = $model->_find('categories', [], 'ORDER BY name ASC')->data();
        $category = $model->_find('categories', [['slug', '=', $urls[1]]], 'ORDER BY name ASC')->data();

        //$jobs = $model->_find('jobs', [], 'ORDER BY id DESC')->data();
        $jobs = $model->_custom('
            SELECT 
                j.*,
                u.avatar as user_avatar,
                u.name as user_name
            FROM jobs j
            LEFT JOIN users u ON u.id = j.client_id 
            LEFT JOIN category_job cj ON cj.job_id = j.id 
            ORDER BY j.id DESC LIMIT 10
        ', []); 

        // Set any dependencies, data and render the view.
        $this->View->render("cat/detail", [
            "user" =>  !empty($user) ? $user->data() : [],
            "categories" =>  $categories,
            "category" =>  $category,
            "description" =>  $category[0]->description,
            "keywords" =>  $category[0]->name,
            "jobs" =>  $jobs,
            "title" => "Работа с определенной категории",
            "page" => 'detail'
        ]);
    }

}
