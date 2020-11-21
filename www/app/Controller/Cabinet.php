<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;
use App\Presenter;

/**
 * Cabinet Controller:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.1.0
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
        "duties" => [
            "required" => true,
            "min_characters" => 4,
            "max_characters" => 1000
        ],
        "contacts" => [
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
        $jobs = $model->_find('jobs', [['client_id', '=', self::$user->data()->id]], 'ORDER BY dt_chg DESC, dt_add DESC')->data();

        // Кидаем в архив
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {

            // в архив
            $id_to_archive = intval(Utility\Input::trim(Utility\Input::get("to_archive")));
            if ($id_to_archive > 0) {
                $model = new model\Crud;
                $cur_job = $model->_find('jobs', [['client_id', '=', self::$user->data()->id], ['id', '=', $id_to_archive]])->data();

                if (!empty($cur_job)) {
                    $model->_update('jobs', ["status" => 'archive'], $id_to_archive);
                    Utility\Flash::info('Добавили в архив ' . $cur_job[0]->name);
                    Utility\Redirect::to(APP_URL . "cabinet");
                }
            }

            // актуально
            $id_to_improve = intval(Utility\Input::trim(Utility\Input::get("to_improve")));
            if ($id_to_improve > 0) {                
                $model = new model\Crud;
                $cur_job = $model->_find('jobs', [['client_id', '=', self::$user->data()->id], ['id', '=', $id_to_improve]])->data();
                if (!empty($cur_job)) {
                    if (!\App\Presenter\Helper::isActual($cur_job[0]->dt_current, 7)) {                        
                        $model->_update('jobs', ["dt_current" => date('Y-m-d H:i:s')], $id_to_improve);
                        Utility\Flash::info('Обновили актуальность объявления ' . $cur_job[0]->name);
                        Utility\Redirect::to(APP_URL . "cabinet");
                    }
                }
            }
        } 

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
        $categories = $model->_find('categories', [], 'ORDER BY name ASC')->data();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            if (!Utility\Input::check(Utility\Input::prepareToDbArray($_POST), self::$_inputs_job)) {
                Utility\Session::put('post', Utility\Input::prepareToDbArray($_POST));
                Utility\Redirect::to(APP_URL . "cabinet/add/");
            }
            Utility\Session::put('post', []);
            $jobId = $model->_create('jobs', [
                "name" => Utility\Input::trim(Utility\Input::post("name")),
                "status" => 'active',
                "dt_add" => date('Y-m-d H:i:s'),
                "dt_chg" => date('Y-m-d H:i:s'),
                "client_id" => self::$user->data()->id,
                "announcement" => Utility\Input::trim(Utility\Input::post("announcement")),
                "requirements" => Utility\Input::trim(Utility\Input::post("requirements")),
                "duties" => Utility\Input::trim(Utility\Input::post("duties")),
                "contacts" => Utility\Input::trim(Utility\Input::post("contacts")),
                "salary_from" => intval(Utility\Input::post("salary_from")),
                "salary_to" => intval(Utility\Input::post("salary_to")),
                "salary_type" => boolval(Utility\Input::post("salary_type")) ? true : false
            ]);

            $model->_update('jobs',[
                "slug" =>  $jobId . '-' . Utility\Helper::getTranslit(Utility\Input::trim(Utility\Input::post("name")))
            ], $jobId);

            // Категории
            if (is_array(Utility\Input::post("categories"))) {
                if (count(Utility\Input::post("categories")) <= 3) {
                    foreach (Utility\Input::post("categories") as $c) {
                        $model->_create('category_job', [
                            "cat_id" => intval($c),
                            "job_id" => intval($jobId)
                        ]);
                    }
                } else {
                    Utility\Flash::danger('Категорий не может быть больше 3.');
                }
            }

            Utility\Flash::success('Добавили вакансию!');
            Utility\Redirect::to(APP_URL . "cabinet/edit/?id=" . $jobId);
        }

        // Set any dependencies, data and render the view.
        $this->View->addCSS("bower_components/chosen/chosen.min.css");
        $this->View->addJS("bower_components/chosen/chosen.jquery.min.js");
        $this->View->addJS("js/job.js");
        $this->View->render("cabinet/add", [
            "user" =>  self::$user->data(),
            "title" => "Добавить объявление",
            "page" => 'cabinet',
            "categories" => $categories,
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
        $categories = $model->_find('categories', [], 'ORDER BY name ASC')->data();
        $categories_checked = $model->_custom(sprintf('
            SELECT 
                c.*
            FROM jobs 
                LEFT JOIN category_job cj ON cj.job_id = %d
                LEFT JOIN categories c ON c.id = cj.cat_id
                WHERE jobs.id = %d
        ', intval($id), intval($id)), []);

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            if (!Utility\Input::check(Utility\Input::prepareToDbArray($_POST), self::$_inputs_job)) {
                Utility\Session::put('post', Utility\Input::prepareToDbArray($_POST));
                Utility\Redirect::to(APP_URL . "cabinet/edit/?id=".$id);
            }
            Utility\Session::put('post', []);
            $model->_update('jobs',[
                "name" => Utility\Input::trim(Utility\Input::post("name")),
                "dt_chg" => date('Y-m-d H:i:s'),
                "announcement" => Utility\Input::trim(Utility\Input::post("announcement")),
                "requirements" => Utility\Input::trim(Utility\Input::post("requirements")),
                "duties" => Utility\Input::trim(Utility\Input::post("duties")),
                "contacts" => Utility\Input::trim(Utility\Input::post("contacts")),
                "salary_from" => intval(Utility\Input::post("salary_from")),
                "salary_to" => intval(Utility\Input::post("salary_to")),
                "salary_type" => boolval(Utility\Input::post("salary_type")) ? true : false
            ], $id);

            // Сохранение категории
            $model->_custom(sprintf('DELETE FROM category_job WHERE job_id = %d', intval($id)), []); // Удаляем всё
            if (is_array(Utility\Input::post("categories"))) {
                if (count(Utility\Input::post("categories")) <= 3) {
                    foreach (Utility\Input::post("categories") as $c) {
                        $model->_create('category_job', [
                            "cat_id" => intval($c),
                            "job_id" => intval($id)
                        ]);
                    }
                } else {                    
                    Utility\Flash::danger('Категорий не может быть больше 3.');
                }
            }
            $categories = $model->_find('categories', [], 'ORDER BY name ASC')->data();

            Utility\Flash::success('Обновили вакансию.');
            Utility\Redirect::to(APP_URL . "cabinet/edit/?id=".$id);
        }

        $current_job = $model->_find('jobs', [['id', "=", $id], ['client_id', "=", (int) self::$user->data()->id], ['status', "=", 'active']])->data();
        if (empty($current_job)) {
            Utility\Redirect::to(APP_URL . "cabinet");
        }

        // Set any dependencies, data and render the view.
        $this->View->addCSS("bower_components/chosen/chosen.min.css");
        $this->View->addJS("bower_components/chosen/chosen.jquery.min.js");
        $this->View->addJS("js/job.js");
        $this->View->render("cabinet/edit", [
            "job" => $current_job[0],
            "user" => self::$user->data(),
            "categories" => $categories,
            "categories_checked" => $categories_checked,
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


            /*
             * Сохр обычных хар-ки
             */
            Utility\Session::put('post', []);
            $model->_update('users', [
                "name" => Utility\Input::trim(Utility\Input::post("name")),
                "about" => Utility\Input::trim(Utility\Input::post("about")),
                "avatar" => $dest_path === '' ? Utility\Input::trim(Utility\Input::post("avatar_file")) : $dest_path,
                "is_employee" => boolval(Utility\Input::post("is_employee")),
                "is_employer" => boolval(Utility\Input::post("is_employer"))
            ], self::$user->data()->id);


            /*
             * Сохранение контактов
             */
            // $new_contacts = json_decode(urldecode(trim(Utility\Input::post("contacts"))), true);
            // foreach($contacts as $c) {
            //     if (!in_array($c->id, array_column($new_contacts, 'id'))) {
            //         // delete
            //         $jobs = $model->_custom(sprintf('DELETE FROM users_contacts WHERE user_id=%d AND id=%d', self::$user->data()->id, $c->id), []); // delete prev
            //     }
            // }
            // foreach($new_contacts as $c) {
            //     if (!in_array($c['id'], array_column($contacts, 'id'))) {
            //         // create
            //         $contactId = $model->_create('users_contacts', [
            //             "user_id" => self::$user->data()->id,
            //             "type" => $c['type'],
            //             "value" => $c['val']
            //         ]);
            //     } else {
            //         // update
            //         $model->_update('users_contacts',[
            //             "user_id" => self::$user->data()->id,
            //             "type" => $c['type'],
            //             "value" => $c['val']
            //         ], $c['id']);
            //     }
            // }

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
