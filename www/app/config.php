<?php

return [
    // 
    // Core Config
    // =========================================================================
    "DATABASE_HOST" => "localhost",
    "DATABASE_NAME" => "new_job",
    "DATABASE_USERNAME" => "root",
    "DATABASE_PASSWORD" => "",
    // 
    // Cookie Config
    // =========================================================================
    "COOKIE_DEFAULT_EXPIRY" => 604800,
    "COOKIE_USER" => "user",
    "" => "",
    // 
    // Session Config
    // =========================================================================
    "SESSION_ERRORS" => "errors",
    "SESSION_FLASH_DANGER" => "danger",
    "SESSION_FLASH_INFO" => "info",
    "SESSION_FLASH_SUCCESS" => "success",
    "SESSION_FLASH_WARNING" => "warning",
    "SESSION_TOKEN" => "token",
    "SESSION_TOKEN_TIME" => "token_time",
    "SESSION_USER" => "user",
    "" => "",
    // 
    // Texts Config
    // =========================================================================
    "TEXTS" => [
        // 
        // Login Model Texts
        // =====================================================================
        "LOGIN_INVALID_PASSWORD" => "Логин или пароль введен неверно",
        "LOGIN_USER_NOT_FOUND" => "Не найден введенный емейл адрес!",
        "" => "",
        // 
        // MAIN Model Texts
        // =====================================================================
        "REGISTER_USER_CREATED" => "Аккаунт успешно создан!",
        "NEW_JOB_CREATED" => "Вакансия успешно добавлена!",
        "JOB_EDITED" => "Вакансия успешно отредактирована!",
        "NEW_JOB_EXCEPTION" => "Проблемы с добавлением работы!",
        "" => "",
        // 
        // Register Model Texts
        // =====================================================================
        "USER_DELETED" => "Аккаунт успешно удален!",
        "" => "",
        // 
        // User Model Texts
        // =====================================================================
        "USER_CREATE_EXCEPTION" => "Проблемы с созданием аккаунта!",
        "USER_UPDATE_EXCEPTION" => "Проблемы с обновлением аккаунта!",
        "COMPANY_UPDATE_EXCEPTION" => "Проблемы с обновлением компаний!",
        "" => "",
        // 
        // Input Utility Texts
        // =====================================================================
        "INPUT_INCORRECT_CSRF_TOKEN" => "Cross-site request forgery verification failed!",
        "" => "",
        // 
        // Validate Utility Texts
        // =====================================================================
        "VALIDATE_FILTER_RULE" => "%ITEM% ошибка %RULE_VALUE%!",
        "VALIDATE_MISSING_INPUT" => "Проверьте поле %ITEM%!",
        "VALIDATE_MISSING_METHOD" => "Проверьте поле %ITEM%!",
        "VALIDATE_MATCHES_RULE" => "%RULE_VALUE% не совпадает %ITEM%.",
        "VALIDATE_MAX_CHARACTERS_RULE" => "%ITEM% максимальная длина %RULE_VALUE% символов.",
        "VALIDATE_MIN_CHARACTERS_RULE" => "%ITEM% минимальная длина %RULE_VALUE% символов.",
        "VALIDATE_MAX_INT_RULE" => "%ITEM% максимальное число %RULE_VALUE%.",
        "VALIDATE_MIN_INT_RULE" => "%ITEM% минимальное число %RULE_VALUE%.",
        "VALIDATE_REQUIRED_RULE" => "%ITEM% обязательное поле!",
        "VALIDATE_UNIQUE_RULE" => "%ITEM% уже есть.",
        "" => "",
        // 
        // Texts
        // =====================================================================
        "" => "",
    ],
    // 
    // Config
    // =========================================================================
    "" => "",
];
