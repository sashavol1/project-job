<div class="container">
    <?php if (isset($this->user)) : ?>
        <div class="jumbotron mt-5">
            <h1>Привет, <?= $this->escapeHTML($this->user->forename . " " . $this->user->surname); ?>!</h1>
            <p>Далеко-далеко за словесными горами в стране, гласных и согласных живут рыбные тексты. Домах коварных свое всеми рукопись языком заглавных правилами переписывается ipsum запятой! Послушавшись жизни взгляд языкового текстами, буквенных оксмокс. Своих, предупреждал.</p>
            <p>
                <a class="btn btn-default btn-lg" href="<?= $this->makeURL("calc"); ?>" role="button">Калькулятор</a>
                <a class="btn btn-primary btn-lg" href="<?= $this->makeURL("login/logout"); ?>" role="button">Выйти</a>
            </p>
        </div>
    <?php endif; ?>
</div>