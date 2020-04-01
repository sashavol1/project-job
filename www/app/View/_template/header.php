<?php

use App\Utility\Config;
use App\Utility\Flash;

?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= $this->escapeHTML($this->title . " - " . APP_NAME); ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link href="" rel="shortcut icon">
        <link href="<?= $this->makeURL("bower_components/bootstrap/dist/css/bootstrap.min.css"); ?>" rel="stylesheet" type="text/css"/>
        <link href="<?= $this->makeURL("bower_components/font-awesome/css/font-awesome.min.css"); ?>" rel="stylesheet" type="text/css"/>
        <?= $this->getCSS(); ?>
    </head>
    <body>
        <div id="wrapper">
            <div id="navbar" class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container">
                  <a class="navbar-brand" href="<?= $this->makeURL(); ?>"><?= $this->escapeHTML(APP_NAME); ?></a>
                  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                  </button>
                  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto">
                      <?php if (!empty($this->user)): ?>
                          <li class="nav-item <?php echo isset($this->page) && $this->page == 'all' ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?= $this->makeURL("all"); ?>">Список</a>
                          </li>
                          <li class="nav-item <?php echo isset($this->page) && $this->page == 'cabinet' ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?= $this->makeURL("cabinet"); ?>">Кабинет</a>
                          </li>
                          <li class="nav-item <?php echo isset($this->page) && $this->page == 'cabinet' ? 'active' : ''; ?>">
                            <a class="nav-link" href="<?= $this->makeURL("cabinet/add"); ?>">Добавить</a>
                          </li>
                          <?php if ($this->user->type == 'admin'): ?>
                            Для админа
                          <?php endif; ?>
                          <li class="nav-item">
                            <a class="nav-link" href="<?= $this->makeURL("login/logout"); ?>">Выйти</a>
                          </li>
                      <?php else: ?>
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
                </div>
            </div>
            <!-- /#navbar -->
            <div id="container">
                <div id="header"></div>
                <!-- /#header -->
                <div id="content">
                    <div id="feedback" class="container mt-3">
                        <?php if (($danger = Flash::danger())): ?>
                            <div class="alert alert-danger" role="alert"><strong>Ошибка!</strong> <?= $this->escapeHTML($danger); ?></div>
                            <?php
                        endif;
                        if (($info = Flash::info())):
                            ?>
                            <div class="alert alert-info" role="alert"><strong>Внимание!</strong> <?= $this->escapeHTML($info); ?></div>
                            <?php
                        endif;
                        if (($success = Flash::success())):
                            ?>
                            <div class="alert alert-success" role="alert"><strong>Успешно!</strong> <?= $this->escapeHTML($success); ?></div>
                            <?php
                        endif;
                        if (($warning = Flash::warning())):
                            ?>
                            <div class="alert alert-warning" role="alert"><strong>Предупреждение!</strong> <?= $this->escapeHTML($warning); ?></div>
                            <?php
                        endif;
                        if (($errors = Flash::session(Config::get("SESSION_ERRORS")))):
                            ?>
                            <div class="alert alert-danger" role="alert">
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

