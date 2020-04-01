<div class="container">
    <div class="jumbotron mt-5">
      <h1 class="display-4">Добавить нового пользователя</h1>
      <hr class="my-4">
        <form action="<?= $this->makeUrl("settings/_registration"); ?>" method="post">
            <div class="form-group">
                <label for="forename-input">Имя <span class="text-danger">*</span></label>
                <input type="text" id="forename-input" class="form-control" name="forename" />
            </div>
            <div class="form-group">
                <label for="surname-input">Фамилия <span class="text-danger">*</span></label>
                <input type="text" id="surname-input" class="form-control" name="surname" />
            </div>                        
            <div class="form-group">
                <label for="email-input">Email <span class="text-danger">*</span></label>
                <input type="text" id="email-input" class="form-control" name="email" />
            </div>
            <div class="form-group">
                <label for="password-input">Пароль <span class="text-danger">*</span></label>
                <input type="password" id="password-input" class="form-control" name="password" />
            </div>
            <div class="form-group">
                <label for="password-repeat-input">Пароль (Повторите) <span class="text-danger">*</span></label>
                <input type="password" id="password-repeat-input" class="form-control" name="password_repeat" />
            </div>
            <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
            <p class="lead">
                <button type="submit" class="btn btn-primary btn-lg" href="#" role="button">Добавить</button>
            </p>
        </form>
    </div>
</div>