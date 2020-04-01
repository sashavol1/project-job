<div class="container">
    <div class="row">
        <div class="offset-md-4 col-md-4">
            <div class="card" style="margin-top: 8rem;">
                <div class="card-body">
                    <h5 class="card-title">Регистрация</h5>
                    <form action="<?= $this->makeUrl("login/_login"); ?>" method="post">
                        <div class="form-group">
                            <label for="email-input">Почта <span class="text-danger">*</span></label>
                            <input type="text" id="email-input" class="form-control" name="email" />
                        </div>
                        <div class="form-group">
                            <label for="password-input">Пароль <span class="text-danger">*</span></label>
                            <input type="password" id="password-input" class="form-control" name="password" />
                        </div>
                        <div class="checkbox">
                            <label for="remember">
                                <input type="checkbox" id="remember" name="remember" /> Запонить меня
                            </label>
                        </div>
                        <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
                        <button type="submit" class="btn btn-primary">Войти</button>
                        <!-- <a href="<?//= $this->makeURL("register"); ?>" class="btn btn-link">Register</a> -->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>