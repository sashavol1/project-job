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

class News extends Core\Controller {

    /**
     * beforeAction
     * @access private
     * @return void
     * @since 1.1.0
     */
    public function beforeAction() {
        // Utility\Auth::checkAuthenticated();
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

        // Get All job
        $model = new model\Crud;
        $blogs = $model->_find('blogs', [['slug', '=', $urls[1]]], 'ORDER BY name ASC')->data();
        if (empty($blogs)) {
            Redirect::to(404);
        }

        // view +1
        $model = new model\Crud;
        $model->_custom(sprintf('UPDATE blogs SET views = views + 1 WHERE id = %d', $blogs[0]->id), []);

        // Set any dependencies, data and render the view.
        $this->View->render("news/detail", [
            "user" =>  !empty($user) ? $user->data() : [],
            "description" =>  $blogs[0]->announcement,
            "keywords" =>  $blogs[0]->name,
            "blog" =>  $blogs[0],
            "title" => $blogs[0]->name,
            "page" => 'detail'
        ]);
    }

}
