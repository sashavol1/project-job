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
 * @author Aleksandr Volmanov <info@volmanov.ru>
 * @since 1.0.0
 */

class Api extends Core\Controller {

    /**
     * beforeAction
     * @access private
     * @return void
     * @since 1.0.0
     */
    public function beforeAction() {
        if ($_SERVER['REQUEST_METHOD'] !== 'post') {
            // Тут проверка API
            header('Access-Control-Allow-Origin: *');
            header('Content-Type: application/json');
            // // Utility\Auth::checkAuthenticated();
            // $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));
            // self::$user = $userID === null ? false : Model\User::getInstance($userID); 
        } else {
            echo 'welcome, to the rice field';
            exit();
        }
    }

    /**
     * Index: Simple API
     * @access public
     * @example All/index
     * @return void
     * @since 1.0.0
     */
    public function index() {
        $this->View->renderJson([]);

    }

    /**
     * Index: Simple API
     * @access public
     * @example All/get_categories
     * @return render
     * @since 1.0.0
     */
    public function get_categories() {
        $model = new model\Crud;
        $jobs = $model->_custom('
            SELECT 
                *
            FROM categories
        ', []); 
        $this->View->renderJson($jobs);
    }

}
