<?php

namespace App\Model;

use Exception;
use App\Utility;

/**
 * User Register Model:
 *
 * @author Andrew Dyer <andrewdyer@outlook.com>
 * @since 1.0.2
 */
class UserRegister {

    /** @var array The register form inputs. */
    private static $_inputs = [
        "name" => [
            "required" => true
        ],
        "email" => [
            "filter" => "email",
            "required" => true,
            "unique" => "users"
        ],
        "password" => [
            "min_characters" => 6,
            "required" => true
        ],
        "password_repeat" => [
            "matches" => "password",
            "required" => true
        ],
        "captcha" => [
            "required" => true,
            "matches" => "csrf_token"
        ],
    ];

    /**
     * Register: Validates the register form inputs, creates a new user in the
     * database and writes all necessary data into the session if the
     * registration was successful. Returns the new user's ID if everything is
     * okay, otherwise turns false.
     * @access public
     * @return boolean
     * @since 1.0.2
     */
    public static function register() {

        // Validate the register form inputs.
        if (!Utility\Input::check($_POST, self::$_inputs)) {
            return false;
        }

        try {

            // Generate a salt, which will be applied to the during the password
            // hashing process.
            $salt = Utility\Hash::generateSalt(32);
            $hash = Utility\Hash::generate(Utility\Input::post("password"), $salt);

            $model = new Crud;
            $userID = $model->_create('users', [
                "email" => trim(Utility\Input::post("email")),
                "name" => trim(Utility\Input::post("name")),
                "password" => $hash,
                "salt" => $salt,
                "status" => Utility\Config::get("STATUS")['DISABLED'],
                "is_employer" => (bool) Utility\Input::post("is_employer") ? 1 : 0,
                "is_employee" => (bool) Utility\Input::post("is_employee") ? 1 : 0,
                "type" => 'user'
            ]);

            // Отправляем письмо с ссылкой
            $mail = new Utility\Mailer();
            $message = 'Перейдите по ссылке, чтобы подтвердить аккаунт на сайте Работа Новгород <a href="https://rabota.nov.ru/registration/verify/?hash='.$hash.'&id='.$userID.'">подтвердить</a>. Если вы не регистрировались, проигнорируйте это письмо.'; // 
            $mail->send('Подтверждение почты', trim(Utility\Input::post("name")), $message, trim(Utility\Input::post("email")));

            // Write all necessary data into the session as the user has been
            // successfully registered and return the user's unique ID.
            Utility\Flash::success(Utility\Text::get("REGISTER_USER_EMAIL"));
            Utility\Redirect::to(APP_URL . "/");
        } catch (Exception $ex) {
            Utility\Flash::danger($ex->getMessage());
        }
        return false;
    }

}
