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
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */

class All extends Core\Controller {

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
     * @example All/index
     * @return void
     * @since 1.0.2
     */
    public function index() {

        // Check that the user is authenticated.
        // Utility\Auth::checkAuthenticated();

        // // Get an instance of the user model using the ID stored in the session. 
        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));

        $user = $userID === null ? false : Model\User::getInstance($userID);

        // Get All job
        $model = new model\Crud;

        $categories = $model->_find('categories', [], 'ORDER BY name ASC')->data();
        //$jobs = $model->_find('jobs', [], 'ORDER BY id DESC')->data();
        $jobs = $model->_custom('
            SELECT 
                j.*,
                u.avatar as user_avatar,
                u.name as user_name
            FROM jobs j
            INNER JOIN users u ON u.id = j.client_id 
            ORDER BY j.id DESC LIMIT 10
        ', []);

        // Set any dependencies, data and render the view.
        $this->View->render("all/index", [
            "user" =>  !empty($user) ? $user->data() : [],
            "categories" =>  $categories,
            "jobs" =>  $jobs,
            "title" => "Список работы",
            "page" => 'index'
        ]);
        // Utility\Redirect::to(APP_URL);
    }

    /**
     * detail
     * @access public
     * @example All/index
     * @return void
     * @since 1.0.2
     */
    public function detail() {

        $urls = explode("/", filter_var(rtrim(Input::get("url"), "/"), FILTER_SANITIZE_URL));
        if (count($urls) !== 2) {            
            Redirect::to(404);
        }

        $model = new model\Crud;
        $job = $model->_custom(sprintf('
            SELECT 
                j.*,
                u.avatar as user_avatar,
                u.name as user_name
            FROM jobs j
            INNER JOIN users u ON u.id = j.client_id
            WHERE j.slug = \'%s\'
            ORDER BY j.id DESC LIMIT 10
        ', addslashes($urls[1])), []);
        $model->_custom('UPDATE jobs SET views = views + 1', []);

        // Set any dependencies, data and render the view.
        $this->View->render("all/detail", [
            "user" => self::$user->data(),
            "job" => $job[0],
            "title" => $job[0]->name,
            "page" => 'index'
        ]);
    }

}
