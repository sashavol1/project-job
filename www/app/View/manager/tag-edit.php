

<?

// var_dump($this->tags);

?>
<div class="container">
    <h1>Тэги</h1>
    <hr>
    <form action="<?= $this->makeUrl("manager/tag_edit?id=" . $this->tag->id); ?>" method="post">
        <div class="form-group">
            <label>Название <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name" value="<?= isset($this->post['name']) ? $this->post['name'] : $this->tag->name; ?>" />
        </div>
        <div class="form-group">
            <label>Описание <span class="text-danger">*</span></label>
            <textarea name="description" rows="3" class="form-control"><?= isset($this->post['description']) ? $this->post['description'] : $this->tag->description; ?></textarea>
        </div>
        <input type="hidden" name="csrf_token" value="<?= App\Utility\Token::generate(); ?>" />
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>
