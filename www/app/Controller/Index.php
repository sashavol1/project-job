<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Index Controller:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0
 */
class Index extends Core\Controller {

    /**
     * Index: Renders the index view. NOTE: This controller can only be accessed
     * by authenticated users!
     * @access public
     * @example index/index
     * @return void
     * @since 1.0
     */
    public function index($user = "") {

        // Check that the user is authenticated.
        // Utility\Auth::checkAuthenticated();

        // // Get an instance of the user model using the ID stored in the session. 
        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));

        $user = $userID === null ? false : Model\User::getInstance($userID);

        // Get All job
        $model = new model\Crud;
        $categories = $model->_find('categories', [], 'ORDER BY name ASC')->data();
        //$jobs = $model->_find('jobs', [], 'ORDER BY id DESC')->data();
        $model = new model\Crud;
        $jobs = $model->_custom('
            SELECT 
                j.*,
                u.avatar as user_avatar,
                u.name as user_name
            FROM jobs j
            INNER JOIN users u ON u.id = j.client_id 
            ORDER BY j.dt_current DESC LIMIT 7
        ', []);

        $model = new model\Crud;
        $blogs = $model->_custom('
            SELECT 
                *
            FROM blogs ORDER BY id DESC LIMIT 5
        ', []);

        // Set any dependencies, data and render the view.
        $this->View->addCSS("css/index.css");
        $this->View->addJS("js/index.jquery.js");
        $this->View->render("index/index", [
            "user" =>  !empty($user) ? $user->data() : [],
            "categories" =>  $categories,
            "jobs" =>  $jobs,
            "blogs" =>  $blogs,
            "title" => "Поиск работы вакансий в Великом Новгороде",
            "description" =>  'Сайт вакансий и работы в городе Великим Новгород и область. Здесь можно найти работы или разместить вакансию, чтобы найти сотрудника!',
            "keywords" =>  'вакансии, сайт, работа',
            "page" => 'index'
        ]);
    }

}
