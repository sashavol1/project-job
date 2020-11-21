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
        // Utility\Auth::checkAuthenticated();
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

        // VUEJS include
        $jsVue = array_slice(scandir(PUBLIC_ROOT . '/vue/js/'), 2);
        $cssVue = array_slice(scandir(PUBLIC_ROOT . '/vue/css/'), 2);
        $this->View->addJS("vue/js/" . $jsVue[0]);
        $this->View->addJS("vue/js/" . $jsVue[2]);
        $this->View->addCss("vue/css/" . $cssVue[0]);


        // Set any dependencies, data and render the view.
        $this->View->render("all/index", [
            "user" =>  !empty(self::$user) ? self::$user->data() : [],
            "title" => "Вся работа в Великом Новгороде",
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
                u.dt_add as user_dt_add,
                u.avatar as user_avatar,
                u.name as user_name
            FROM jobs j
            INNER JOIN users u ON u.id = j.client_id
            WHERE j.slug = \'%s\'
            ORDER BY j.id DESC LIMIT 10
        ', addslashes($urls[1])), []);

        $model = new model\Crud;
        $model->_custom(sprintf('UPDATE jobs SET views = views + 1 WHERE id = %d', $job[0]->id), []);

        // Set any dependencies, data and render the view.
        $this->View->render("all/detail", [
            "user" => !empty(self::$user) ? self::$user->data() : [],
            "job" => $job[0],
            "title" => $job[0]->name,
            "page" => 'index'
        ]);
    }

}
