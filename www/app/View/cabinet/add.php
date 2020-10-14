<?

// var_dump($this->tags);

?>
<a href="/cabinet/" class="uk-button uk-button-primary uk-margin-bottom"><span class="uk-margin-small-right" uk-icon="arrow-left"></span></a>
<div class="uk-card uk-card-default uk-card-body uk-width-1-1@m">
    <h1>Добавить вакансию</h1>
    <hr>
    <form action="<?= $this->makeUrl("cabinet/add/"); ?>" method="post">
        <div class="uk-margin">
            <label>Название <span class="text-danger">*</span></label>
            <input type="text" class="uk-input" name="name" value="<?= isset($this->post['name']) ? $this->post['name'] : ''; ?>" />
        </div>
        <div class="uk-margin control-textarea" data-max-symbol="255">
            <label>Анонс <span class="text-danger">*</span></label>
            <textarea name="announcement" class="uk-textarea" rows="5"><?= isset($this->post['announcement']) ? $this->post['announcement'] : ''; ?></textarea>
        </div>
        <div class="uk-margin control-textarea" data-max-symbol="255">
            <label>Требования <span class="text-danger">*</span></label>
            <textarea name="requirements" class="uk-textarea" rows="5"><?= isset($this->post['requirements']) ? $this->post['requirements'] : ''; ?></textarea>
        </div>
        <div class="uk-margin control-textarea" data-max-symbol="1000">
            <label>Что делать? <span class="text-danger">*</span></label>
            <textarea name="duties" class="uk-textarea" rows="5"><?= isset($this->post['duties']) ? $this->post['duties'] : ''; ?></textarea>
        </div>
        <div class="uk-margin control-textarea" data-max-symbol="1000">
            <label>Контакты <span class="text-danger">*</span></label>
            <textarea name="contacts" class="uk-textarea" rows="3"><?= isset($this->post['contacts']) ? $this->post['contacts'] : ''; ?></textarea>
        </div>
        <div class="uk-margin">
            <label>Вознаграждение, от <span class="text-danger">*</span></label>
            <input type="text" class="uk-input" name="salary_from" value="<?= isset($this->post['salary_from']) ? $this->post['salary_from'] : ''; ?>" />
        </div>
        <div class="uk-margin">
            <label>Вознаграждение, до <span class="text-danger">*</span></label>
            <input type="text" class="uk-input" name="salary_to" value="<?= isset($this->post['salary_to']) ? $this->post['salary_to'] : ''; ?>" />
        </div>
        <div class="uk-margin">
            <label><input class="uk-checkbox" type="checkbox" name="salary_type"> Оплата по договоренности</label>
        </div>
        <div class="uk-margin">
            <label>Выберите категорию</label>
            <select data-placeholder="Выберите категории" multiple class="chosen-category uk-select" name="categories[]">
                <? foreach ($this->categories as $c): ?>
                    <option value="<?= $c->id; ?>"><?= $c->name; ?></option>
                <? endforeach; ?>
            </select>
        </div>
        <input type="hidden" name="csrf_token" value="<?= App\Utility\Token::generate(); ?>" />
        <button type="submit" class="uk-button uk-button-primary">Добавить</button>
    </form>
</div>