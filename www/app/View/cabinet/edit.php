<?


?>
<div class="uk-card uk-card-default uk-card-body uk-width-1-1@m">
    <h1>Редактирование вакансии</h1>
    <hr>
    <form action="<?= $this->makeUrl("cabinet/edit?id=" . $this->job->id); ?>" method="post">
        <div class="uk-margin">
            <label>Название <span class="text-danger">*</span></label>
            <input type="text" class="uk-input trigger-input-translit" name="name" value="<?= isset($this->post['name']) ? $this->post['name'] : $this->job->name; ?>" />
        </div>
        <div class="uk-margin">
            <label>Анонс <span class="text-danger">*</span></label>
            <textarea name="announcement" class="uk-textarea" rows="5"><?= isset($this->post['announcement']) ? $this->post['announcement'] : $this->job->announcement; ?></textarea>
        </div>
        <div class="uk-margin">
            <label>Требования <span class="text-danger">*</span></label>
            <textarea name="requirements" class="uk-textarea" rows="5"><?= isset($this->post['requirements']) ? $this->post['requirements'] : $this->job->requirements; ?></textarea>
        </div>
        <div class="uk-margin">
            <label>Вознаграждение, от <span class="text-danger">*</span></label>
            <input type="text" class="uk-input" name="salary_from" value="<?= isset($this->post['salary_from']) ? $this->post['salary_from'] : $this->job->salary_from; ?>" />
        </div>
        <div class="uk-margin">
            <label>Вознаграждение, до <span class="text-danger">*</span></label>
            <input type="text" class="uk-input" name="salary_to" value="<?= isset($this->post['salary_to']) ? $this->post['salary_to'] : $this->job->salary_to; ?>" />
        </div>
        <div class="uk-margin">
            <label><input class="uk-checkbox" type="checkbox" name="salary_type" <?= !boolval($this->job->salary_type) ? '' : 'checked'; ?> > Оплата по договоренности</label>
        </div>
        <input type="hidden" name="csrf_token" value="<?= App\Utility\Token::generate(); ?>" />
        <button type="submit" class="uk-button uk-button-primary">Добавить</button>
    </form>
</div>