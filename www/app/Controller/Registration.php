<?php

namespace App\Controller;

use App\Core;
use App\Model;
use App\Utility;

/**
 * Registration Controller:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class Registration extends Core\Controller {

    /**
     * Index: Renders the registration view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example registration/index
     * @return void
     * @since 1.0.2
     */
    public function index() {

        // Check that the user is unauthenticated.
        Utility\Auth::checkUnauthenticated();

        $this->View->addJS("js/registration.min.js");
        // Set any dependencies, data and render the view.
        $this->View->render("registration/index", [
            "title" => "Регистрация",
            "page" => 'registration',
            "post" => Utility\Session::get('post')
        ]);
    }

    /**
     * Index: Renders the registration view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example registration/index
     * @return void
     * @since 1.0.2
     */
    public function _add() {

        // Check that the user is authenticated.
        Utility\Auth::checkUnauthenticated();
        
        // Process the register request, redirecting to the login controller if
        // successful or back to the register controller if not.
        Utility\Session::put('post', $_POST);
        if ($userId = Model\UserRegister::register()) {
            Utility\Session::put(Utility\Config::get("SESSION_USER"), $userId);
            Utility\Redirect::to(APP_URL . "cabinet");
        }
        Utility\Redirect::to(APP_URL . "registration");
    }

    /**
     * Index: Renders the registration view. NOTE: This controller can only be accessed
     * by unauthenticated users!
     * @access public
     * @example registration/index
     * @return void
     * @since 1.0.2
     */
    public function verify() {

        // $mail = new Utility\Mailer();
        // $message = 'Перейдите по ссылке, чтобы подтвердить аккаунт на rabota.nov.ru <a href="https://rabota.nov.ru/registration/verify/?hash=">подтвердить</a>. Если вы не регистрировались, проигнорируйте это письмо.'; // 
        // $mail->send('123Подтверждение почты123', 'name', $message, 'ssashavol7@gmail.com');

        $id = (int) trim(Utility\Input::get("id"));
        $hash = trim(Utility\Input::get("hash"));

        if ($id > 0 && $hash != '') {

            $model = new model\Crud;
            $client = $model->_find('users', [['id', '=', $id], ['password', '=', $hash], ['status', '=', Utility\Config::get("STATUS")['DISABLED']]])->data();

            if (!empty($client)) {

                // update status
                $model = new model\Crud;
                $model->_custom(sprintf('UPDATE users SET status = \'active\' WHERE id = %d', $client[0]->id), []);

                // auth
                Utility\Session::put(Utility\Config::get("SESSION_USER"), $client[0]->id);
                Utility\Flash::success(Utility\Text::get("REGISTER_USER_CREATED"));
                Utility\Redirect::to(APP_URL . "cabinet/");
            }
        }

        Utility\Redirect::to(APP_URL);

    }

}
