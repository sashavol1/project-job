<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Cabinet Controller:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class Cabinet extends Core\Controller {

    /** @var array Validate settings. */
    private static $_inputs_settings = [
        "name" => [
            "required" => true,
            "min_characters" => 4,
            "max_characters" => 120
        ],
        "about" => [
            "max_characters" => 250
        ]
    ];

    /** @var array Validate settings. */
    private static $_inputs_job = [
        "name" => [
            "required" => true,
            "min_characters" => 4,
            "max_characters" => 120
        ],
        "announcement" => [
            "required" => true,
            "min_characters" => 4,
            "max_characters" => 250
        ],
        "requirements" => [
            "required" => true,
            "min_characters" => 4,
            "max_characters" => 250
        ],
        "salary_from" => [
            "min_int" => 0,
            "max_int" => 1000000
        ],
        "salary_to" => [
            "min_int" => 0,
            "max_int" => 1000000
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
    }

    /**
     * Index: Renders the Cabinet view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example Cabinet/index
     * @return void
     * @since 1.0.2
     */
    public function index() {
        Utility\Session::put('post', []);

        $model = new model\Crud;
        $jobs = $model->_find('jobs', [['client_id', '=', self::$user->data()->id]], 'ORDER BY id DESC')->data();

        // Set any dependencies, data and render the view.
        $this->View->render("cabinet/index", [
            "user" =>  self::$user->data(),
            "title" => "Личный кабинет",
            "jobs" => $jobs,
            "page" => 'index'
        ]);
    }

    /**
     * Add job
     * @access public
     * @example Cabinet/add
     * @return void
     * @since 1.0.2
     */
    public function add() {
        $model = new model\Crud;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Utility\Input::check(Utility\Input::prepareToDbArray($_POST), self::$_inputs_job)) {
                Utility\Session::put('post', Utility\Input::prepareToDbArray($_POST));
                Utility\Redirect::to(APP_URL . "cabinet/add");
            }
            Utility\Session::put('post', []);
            $jobId = $model->_create('jobs', [
                "name" => Utility\Input::trim(Utility\Input::post("name")),
                "slug" => Utility\Helper::generateRandomStringForUrl(12),
                "dt_add" => date('Y-m-d H:i:s'),
                "client_id" => self::$user->data()->id,
                "announcement" => Utility\Input::trim(Utility\Input::post("announcement")),
                "requirements" => Utility\Input::trim(Utility\Input::post("requirements")),
                "salary_from" => intval(Utility\Input::post("salary_from")),
                "salary_to" => intval(Utility\Input::post("salary_to")),
                "salary_type" => boolval(Utility\Input::post("salary_type")) ? true : false
            ]);
            Utility\Flash::success('Добавили вакансию!');
            Utility\Redirect::to(APP_URL . "cabinet/edit?id=" . $jobId);
        }
        // Set any dependencies, data and render the view.
        $this->View->render("cabinet/add", [
            "user" =>  self::$user->data(),
            "title" => "Добавить объявление",
            "page" => 'cabinet',
            "post" => Utility\Session::get('post')
        ]);
    }

    /**
     * Edit job
     * @access public
     * @example Cabinet/add
     * @return void
     * @since 1.0.2
     */
    public function edit() {

        $id = intval(Utility\Input::trim(Utility\Input::get("id")));
        $model = new model\Crud;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Utility\Input::check(Utility\Input::prepareToDbArray($_POST), self::$_inputs_job)) {
                Utility\Session::put('post', Utility\Input::prepareToDbArray($_POST));
                Utility\Redirect::to(APP_URL . "cabinet/edit?id=".$id);
            }
            Utility\Session::put('post', []);
            $model->_update('jobs',[
                "name" => Utility\Input::trim(Utility\Input::post("name")),
                "dt_chg" => date('Y-m-d H:i:s'),
                "announcement" => Utility\Input::trim(Utility\Input::post("announcement")),
                "requirements" => Utility\Input::trim(Utility\Input::post("requirements")),
                "salary_from" => intval(Utility\Input::post("salary_from")),
                "salary_to" => intval(Utility\Input::post("salary_to")),
                "salary_type" => boolval(Utility\Input::post("salary_type")) ? true : false
            ], $id);
            Utility\Flash::success('Обновили вакансию.');
            Utility\Redirect::to(APP_URL . "cabinet/edit?id=".$id);
        }

        $current_job = $model->_find('jobs', [['id', "=", $id], ['client_id', "=", (int) self::$user->data()->id]])->data();
        if (empty($current_job)) {
            Utility\Redirect::to(APP_URL . "cabinet");
        }

        // Set any dependencies, data and render the view.
        $this->View->render("cabinet/edit", [
            "job" => $current_job[0],
            "user" =>  self::$user->data(),
            "title" => "Редактировать объявление",
            "page" => 'index',
            "post" => Utility\Session::get('post')
        ]);
    }

    /**
     * Settings
     * @access public
     * @example Cabinet/settings
     * @return void
     * @since 1.0.2
     */
    public function settings() {

        $model = new model\Crud;

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!Utility\Input::check(Utility\Input::prepareToDbArray($_POST), self::$_inputs_settings)) {
                Utility\Session::put('post', Utility\Input::prepareToDbArray($_POST));
                Utility\Redirect::to(APP_URL . "cabinet/settings");
            }

            /*
             * Загрузка аватара 
             */
            $dest_path = '';
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $image = new Utility\Image;
                $filename = $image->load_resize_image($_FILES['avatar'], './upload/avatar/', 300, 300);
                $dest_path = '/upload/avatar/' . $filename;
            }

            Utility\Session::put('post', []);
            $tagId = $model->_update('users', [
                "name" => Utility\Input::trim(Utility\Input::post("name")),
                "about" => Utility\Input::trim(Utility\Input::post("about")),
                "avatar" => $dest_path === '' ? Utility\Input::trim(Utility\Input::post("avatar_file")) : $dest_path,
                "is_employee" => boolval(Utility\Input::post("is_employee")),
                "is_employer" => boolval(Utility\Input::post("is_employer"))
            ], self::$user->data()->id);
            Utility\Flash::success('Обновили профиль.');
            Utility\Redirect::to(APP_URL . "cabinet/settings");
        }

        $this_user = $model->_findById('users', self::$user->data()->id);

        // Set any dependencies, data and render the view.
        $this->View->render("cabinet/settings", [
            "user" =>  self::$user->data(),
            "this_user" =>  $this_user,
            "title" => "Профиль",
            "page" => 'profile',
            "post" => Utility\Session::get('post')
        ]);
    }
}
