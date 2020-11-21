<div class="uk-card uk-card-default uk-card-body uk-width-1-2@m">
    <h3 class="uk-card-title">Регистрация</h3>
    <form action="<?= $this->makeUrl("registration/_add/"); ?>" method="post">
        <div class="uk-margin">
            <label for="my_name">Имя / Организация <span class="text-danger">*</span></label>
            <input type="text" value="<?= isset($this->post["name"]) ? $this->post["name"] : ''; ?>" id="my_name" class="uk-input" name="name" />
        </div>
        <div class="uk-margin">
            <label for="email-input">Почта <span class="text-danger">*</span></label>
            <input type="text" value="<?= isset($this->post["email"]) ? $this->post["email"] : ''; ?>" id="email-input" class="uk-input" name="email" />
        </div>
        <div class="uk-margin">
            <label for="password-input">Пароль <span class="text-danger">*</span></label>
            <input type="password" value="<?= isset($this->post["password"]) ? $this->post["password"] : ''; ?>" id="password-input" class="uk-input" name="password" />
        </div>
        <div class="uk-margin">
            <label for="password-input">Повторите пароль <span class="text-danger">*</span></label>
            <input type="password" value="<?= isset($this->post["password_repeat"]) ? $this->post["password_repeat"] : ''; ?>" id="password-input" class="uk-input" name="password_repeat" />
        </div>
        <div class="uk-margin">
            <label for="password-input">Проверка <span class="text-danger">*</span></label>
            <div class="hcv-slider">
                <div class="hcv-slider__wheel"></div>
                <div class="hcv-slider__text">Перетащите ползунок</div>
            </div>
        </div>
        <div class="checkbox">
            <label for="is_employer">
                <input type="checkbox" id="is_employer" name="is_employer" /> Работодатель
            </label>
        </div>
        <div class="checkbox">
            <label for="is_employee">
                <input type="checkbox" id="is_employee" name="is_employee" /> Соискатель
            </label>
        </div>
        <input type="hidden" name="csrf_token" class="hcv-value-from" value="<?php echo App\Utility\Token::generate(); ?>" />
        <input type="hidden" name="captcha" class="hcv-value-to" value="" />
        <button type="submit" class="uk-button uk-button-primary">Регистрация</button>
        <!-- <a href="<?//= $this->makeURL("register"); ?>" class="btn btn-link">Register</a> -->
    </form>
</div>