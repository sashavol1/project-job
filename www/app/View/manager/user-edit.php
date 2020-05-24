

<?

// var_dump($this->tags);

?>
<div class="container">
    <h1>Редактирование пользователя <?= $this->cur_user->name; ?></h1>
     <?= is_null($this->cur_user->dt_del) ? '<span class="uk-label uk-label-success">Активный</span>' : '<span class="uk-label uk-label-danger">Удален</span>'; ?> <span class="uk-label"><?= $this->cur_user->dt_add; ?></span>
    <hr>
    <form action="<?= $this->makeUrl("manager/user_edit?id=" . $this->cur_user->id); ?>" method="post">
        <div class="uk-margin">
            <label>Имя <span class="text-danger">*</span></label>
            <input type="text" class="uk-input trigger-input-translit" name="name" value="<?= isset($this->post['name']) && $this->post['name'] != '' ? $this->post['name'] : $this->cur_user->name; ?>" />
        </div>
        <div class="uk-margin">
            <label><input class="uk-checkbox" type="checkbox" name="delete" <?= is_null($this->cur_user->dt_del) ? '' : 'checked'; ?> > Удалить?</label>
        </div>
        <input type="hidden" name="csrf_token" value="<?= App\Utility\Token::generate(); ?>" />
        <button type="submit" class="uk-button uk-button-primary">Добавить</button>
    </form>
</div>
