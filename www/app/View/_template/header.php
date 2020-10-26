<?php

use App\Utility\Config;
use App\Utility\Flash;

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= $this->escapeHTML($this->title . " - " . APP_NAME); ?></title>
        <meta name="description" content="<?= $this->description; ?>" />
        <meta name="keywords" content="<?= $this->keywords; ?>" />
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="<?= $this->makeURL("favicon.ico"); ?>" rel="shortcut icon">
        <link href="<?= $this->makeURL("bower_components/uikit/dist/css/uikit.min.css"); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= $this->makeURL("css/index.css"); ?>" rel="stylesheet" type="text/css"/>
        <?= $this->getCSS(); ?>
        <script>DEBUG = <?= PROJECT_PRODUCTION ? 'false' : 'true'; ?></script>
    </head>
    <body>
        <nav class="uk-navbar-container uk-navbar-transparent" uk-navbar>
            <div class="uk-navbar-left">
              <a class="uk-navbar-item uk-logo" href="<?= $this->makeURL("cabinet"); ?>"><?= $this->escapeHTML(APP_NAME); ?></a>
            </div>
            <div class="uk-navbar-right">
                <ul class="uk-navbar-nav">
                    <?php if (!empty($this->user)): ?>
                      <?php if ($this->user->type == 'admin'): ?>                          
                        <li class="nav-item <?php echo isset($this->page) && $this->page == 'all' ? 'uk-active' : ''; ?>">
                          <a class="nav-link" href="<?= $this->makeURL("manager"); ?>">Менеджер</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="<?= $this->makeURL("login/logout"); ?>">Выйти</a>
                        </li>
                      <?php else: ?>
                        <li class="nav-item <?php echo isset($this->page) && $this->page == 'all' ? 'uk-active' : ''; ?>">
                          <a class="nav-link" href="<?= $this->makeURL("all"); ?>">Вся работа</a>
                        </li>
                        <li class="nav-item <?php echo isset($this->page) && $this->page == 'cabinet' ? 'uk-active' : ''; ?>">
                          <a class="nav-link" href="<?= $this->makeURL("cabinet/add"); ?>">Добавить вакансию</a>
                        </li>
                        <li class="nav-item <?php echo isset($this->page) && $this->page == 'cabinet' ? 'uk-active' : ''; ?>">
                            <a class="nav-link" href="<?= $this->makeURL("cabinet"); ?>">Кабинет</a>
                            <div class="uk-navbar-dropdown">
                                <ul class="uk-nav uk-navbar-dropdown-nav">
                                    <li><a href="<?= $this->makeURL("cabinet"); ?>">Рабочая область</a></li>
                                    <li><a href="<?= $this->makeURL("cabinet/settings"); ?>">Настройка</a></li>
                                    <li><a href="<?= $this->makeURL("login/logout"); ?>">Выйти</a></li>
                                </ul>
                            </div>
                        </li>
                      <?php endif; ?>
                    <?php else: ?>
                        <li class="nav-item <?php echo isset($this->page) && $this->page == 'all' ? 'uk-active' : ''; ?>">
                          <a class="nav-link" href="<?= $this->makeURL("all"); ?>">Вся работа</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="<?= $this->makeURL("registration/index"); ?>">Регистрация</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link" href="<?= $this->makeURL("login/index"); ?>">Войти</a>
                        </li>
                    <?php endif; ?>
                </ul>
            </div>
          <!-- /#main-navbar -->
        </nav>
        <!-- /#navbar -->

        <div class="uk-container uk-margin-top">
            <div id="header"></div>
            <!-- /#header -->
            <div id="content">
                <div id="feedback" class="container">
                    <?php if (($danger = Flash::danger())): ?>
                        <div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a><strong>Ошибка!</strong> <?= $this->escapeHTML($danger); ?></div>
                        <?php
                    endif;
                    if (($info = Flash::info())):
                        ?>
                        <div class="uk-alert-primary" uk-alert><a class="uk-alert-close" uk-close></a><strong>Внимание!</strong> <?= $this->escapeHTML($info); ?></div>
                        <?php
                    endif;
                    if (($success = Flash::success())):
                        ?>
                        <div class="uk-alert-success" uk-alert><a class="uk-alert-close" uk-close></a><strong>Успешно!</strong> <?= $this->escapeHTML($success); ?></div>
                        <?php
                    endif;
                    if (($warning = Flash::warning())):
                        ?>
                        <div class="uk-alert-warning" uk-alert><a class="uk-alert-close" uk-close></a><strong>Предупреждение!</strong> <?= $this->escapeHTML($warning); ?></div>
                        <?php
                    endif;
                    if (($errors = Flash::session(Config::get("SESSION_ERRORS")))):
                        ?>
                        <div class="uk-alert-danger" uk-alert><a class="uk-alert-close" uk-close></a>
                            <h4>Ошибки:</h4>
                            <ul>
                                <?php foreach ($errors as $key => $values): ?>
                                    <?php foreach ($values as $value): ?>
                                        <li><?= $value; ?></li>
                                    <?php endforeach; ?>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                </div>

