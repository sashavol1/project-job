<div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
    <h3 class="uk-card-title">Войти в личный кабинет</h3>
    <form action="<?= $this->makeUrl("login/_login/"); ?>" method="POST">
        <div class="uk-margin">
            <label for="email-input">Почта <span class="text-danger">*</span></label>
            <input type="text" id="email-input" class="uk-input" name="email" />
        </div>
        <div class="uk-margin">
            <label for="password-input">Пароль <span class="text-danger">*</span></label>
            <input type="password" id="password-input" class="uk-input" name="password" />
        </div>
        <div class="checkbox">
            <label for="remember">
                <input type="checkbox" id="remember" name="remember" /> Запонить меня
            </label>
        </div>
        <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
        <button type="submit" class="uk-button uk-button-primary">Войти</button>
        <!-- <a href="<?//= $this->makeURL("register"); ?>" class="btn btn-link">Register</a> -->
    </form>
</div>