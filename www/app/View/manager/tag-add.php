

<?

// var_dump($this->tags);

?>
<div class="container">
    <h1>Добавить ТЭГ</h1>
    <hr>
    <form action="<?= $this->makeUrl("manager/tag_add"); ?>" method="post">
        <div class="uk-margin">
            <label>Название <span class="text-danger">*</span></label>
            <input type="text" class="uk-input" name="name" value="<?= isset($this->post['name']) ? $this->post['name'] : ''; ?>" />
        </div>
        <div class="uk-margin">
            <label>Описание <span class="text-danger">*</span></label>
            <textarea name="description" rows="3" class="uk-input"><?= isset($this->post['description']) ? $this->post['description'] : ''; ?></textarea>
        </div>
        <input type="hidden" name="csrf_token" value="<?= App\Utility\Token::generate(); ?>" />
        <button type="submit" class="uk-button uk-button-primary">Добавить</button>
    </form>
</div>
