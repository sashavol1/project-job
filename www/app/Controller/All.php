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
