

<?

// var_dump($this->tags);

?>
<div class="container">
    <h1>Редактирование работы <?= is_null($this->job->dt_del) ? '<span class="uk-label uk-label-success">Активная</span>' : '<span class="uk-label uk-label-danger">Удалена</span>'; ?></h1>
    <hr>
    <form action="<?= $this->makeUrl("manager/job_edit/?id=" . $this->job->id); ?>" method="post">
        <div class="uk-margin">
            <label>Название <span class="text-danger">*</span></label>
            <input type="text" class="uk-input trigger-input-translit" name="name" value="<?= isset($this->post['name']) ? $this->post['name'] : $this->job->name; ?>" />
        </div>
        <div class="uk-margin">
            <label>Причина блокировки</label>
            <textarea name="block_reason" rows="3" class="uk-input"><?= isset($this->post['block_reason']) ? $this->post['block_reason'] : $this->job->block_reason; ?></textarea>
        </div>
        <div class="uk-margin">
            <label>Статус <span class="text-danger">*</span></label>
            <select name="status" class="uk-select">
                <option <?= $this->job->status === 'active' ? 'selected' : ''; ?> value="active">Активный</option>
                <option <?= $this->job->status === 'block' ? 'selected' : ''; ?> value="block">Блок</option>
                <option <?= $this->job->status === 'archive' ? 'selected' : ''; ?> value="archive">Архив</option>
            </select>
        </div>
        <div class="uk-margin">
            <label><input class="uk-checkbox" type="checkbox" name="delete" <?= is_null($this->job->dt_del) ? '' : 'checked'; ?> > Удалить?</label>
        </div>
        <input type="hidden" name="csrf_token" value="<?= App\Utility\Token::generate(); ?>" />
        <button type="submit" class="uk-button uk-button-primary">Добавить</button>
    </form>
</div>
