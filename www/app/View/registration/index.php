<div class="container">
    <div class="row">
        <div class="offset-md-4 col-md-4">
            <div class="card" style="margin-top: 8rem;">
                <div class="card-body">
                    <h5 class="card-title">Регистрация</h5>
                    <form action="<?= $this->makeUrl("registration/_add"); ?>" method="post">
                        <div class="form-group">
                            <label for="my_name">Имя / Организация <span class="text-danger">*</span></label>
                            <input type="text" value="<?= isset($this->post["name"]) ? $this->post["name"] : ''; ?>" id="my_name" class="form-control" name="name" />
                        </div>
                        <div class="form-group">
                            <label for="email-input">Почта <span class="text-danger">*</span></label>
                            <input type="text" value="<?= isset($this->post["email"]) ? $this->post["email"] : ''; ?>" id="email-input" class="form-control" name="email" />
                        </div>
                        <div class="form-group">
                            <label for="password-input">Пароль <span class="text-danger">*</span></label>
                            <input type="password" value="<?= isset($this->post["password"]) ? $this->post["password"] : ''; ?>" id="password-input" class="form-control" name="password" />
                        </div>
                        <div class="form-group">
                            <label for="password-input">Повторите пароль <span class="text-danger">*</span></label>
                            <input type="password" value="<?= isset($this->post["password_repeat"]) ? $this->post["password_repeat"] : ''; ?>" id="password-input" class="form-control" name="password_repeat" />
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
                        <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
                        <button type="submit" class="btn btn-primary">Регистрация</button>
                        <!-- <a href="<?//= $this->makeURL("register"); ?>" class="btn btn-link">Register</a> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>