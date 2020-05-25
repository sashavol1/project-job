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
        // Set any dependencies, data and render the view.
        $this->View->render("cabinet/index", [
            "user" =>  self::$user->data(),
            "title" => "Личный кабинет",
            "page" => 'index'
        ]);
    }

    /**
     * Index: Renders the Cabinet view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example Cabinet/add
     * @return void
     * @since 1.0.2
     */
    public function add() {
        // Set any dependencies, data and render the view.
        $this->View->render("cabinet/add", [
            "user" =>  self::$user->data(),
            "title" => "Добавить объявление",
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

            if (!Utility\Input::check($_POST, self::$_inputs_settings)) {
                Utility\Session::put('post', $_POST);
                Utility\Redirect::to(APP_URL . "cabinet/settings");
            }

            /**
             * Загрузка аватара 
             */
            $dest_path = '';
            if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
                $fileTmpPath = $_FILES['avatar']['tmp_name'];
                $fileName = $_FILES['avatar']['name'];
                $fileSize = $_FILES['avatar']['size'];
                $fileType = $_FILES['avatar']['type'];
                $fileNameCmps = explode(".", $fileName);
                $fileExtension = strtolower(end($fileNameCmps));

                //  types and size file
                if (in_array($fileExtension, ['image/jpeg', 'jpg', 'gif', 'png', 'jpeg']) && $fileSize <= 2171860) {
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                    $uploadFileDir = './upload/avatar/';
                    $uploadFileDirForDb = '/upload/avatar/';
                    $dest_path = $uploadFileDirForDb . $newFileName;
                     
                    if (move_uploaded_file($fileTmpPath, $uploadFileDir . $newFileName)) {
                        Utility\Flash::success('Загрузили аватар.');
                    }
                } else {
                    Utility\Flash::danger('Размер файла до 2 МБ, тип файла некорретный.');
                }
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

    /**
     * Index: Renders the Cabinet view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example Cabinet/add
     * @return void
     * @since 1.0.2
     */
    public function _add() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();
        
        // Process the register request, redirecting to the login controller if
        // successful or back to the register controller if not.
        Utility\Session::put('post', $_POST);
        if (Model\JobAdd::add()) {
            Utility\Redirect::to(APP_URL . "cabinet/add");
        }
        Utility\Redirect::to(APP_URL . "cabinet/add");
    }

    /**
     * Index: Renders the Cabinet view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example Cabinet/add
     * @return void
     * @since 1.0.2
     */
    public function edit() {

        // Check that the user is unauthenticated.
        Utility\Auth::checkAuthenticated();

        $id = intval(Utility\Input::trim(Utility\Input::get("id")));
        if (!$id) Utility\Redirect::to(APP_URL . "cabinet");
        $userID = Utility\Session::get(Utility\Config::get("SESSION_USER"));
        $user = $userID === null ? false : Model\User::getInstance($userID)->data();

        // Get Job
        $Job = new model\Job;
        $current_job = $Job->findOneJob($id, $user->id)->data();
        if (empty($current_job)) Utility\Redirect::to(APP_URL . "cabinet/add");

        // Set any dependencies, data and render the view.
        $this->View->render("cabinet/edit", [
            "job" => $current_job,
            "user" => $user,
            "title" => "Добавить объявление",
            "page" => 'index',
            "post" => Utility\Session::get('post')
        ]);
    }

    /**
     * Index: Renders the Cabinet view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example Cabinet/add
     * @return void
     * @since 1.0.2
     */
    public function _edit() {

        // Check that the user is authenticated.
        Utility\Auth::checkAuthenticated();
        
        // Process the register request, redirecting to the login controller if
        // successful or back to the register controller if not.
        Utility\Session::put('post', $_POST);
        if (Model\JobAdd::edit()) {
            Utility\Redirect::to(APP_URL . "cabinet");
        }
        Utility\Redirect::to(APP_URL . "cabinet");
    }

}
