

<?

// var_dump($this->tags);

?>
<div class="container">
    <h1>Редактирование категории</h1>
    <hr>
    <form action="<?= $this->makeUrl("manager/category_edit?id=" . $this->category->id); ?>" method="post">
        <div class="uk-margin">
            <label>Название <span class="text-danger">*</span></label>
            <input type="text" class="uk-input trigger-input-translit" name="name" value="<?= isset($this->post['name']) ? $this->post['name'] : $this->category->name; ?>" />
        </div>
        <div class="uk-margin">
            <label>Описание <span class="text-danger">*</span></label>
            <textarea name="description" rows="3" class="uk-input"><?= isset($this->post['description']) ? $this->post['description'] : $this->category->description; ?></textarea>
        </div>
        <div class="uk-margin">
            <label>ЧПУ <span class="text-danger">*</span></label>
            <input type="text" class="uk-input input-translit" name="slug" value="<?= isset($this->post['slug']) ? $this->post['slug'] : $this->category->slug; ?>" />
        </div>
        <div class="uk-margin">
            <label>Популярность <span class="text-danger">*</span></label>
            <input type="text" class="uk-input" name="popularity" value="<?= isset($this->post['popularity']) ? $this->post['popularity'] : $this->category->popularity; ?>" />
        </div>
        <input type="hidden" name="csrf_token" value="<?= App\Utility\Token::generate(); ?>" />
        <button type="submit" class="uk-button uk-button-primary">Добавить</button>
    </form>
</div>
