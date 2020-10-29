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
     * Get categoryes
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

    /**
     * Get jobs
     * @access public
     * @example All/get_jobs
     * @return render
     * @since 1.0.0
     */
    public function get_jobs() {
        $filter = '';

        if (!empty(Utility\Input::get("category_id"))) {
            $filter .= sprintf(' AND j.id IN (SELECT job_id FROM category_job WHERE category_job.cat_id =  %d)', intval(Utility\Input::get("category_id")));
        }

        $model = new model\Crud;
        $jobs = $model->_custom(sprintf('
            SELECT 
                j.*,
                u.avatar as user_avatar,
                u.name as user_name
            FROM jobs j
            INNER JOIN users u ON u.id = j.client_id 
            WHERE 1 = 1 %s
            ORDER BY j.id DESC LIMIT 10
        ', $filter), []); 
        $this->View->renderJson($jobs);
    }

}
