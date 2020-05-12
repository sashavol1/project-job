

<?

// var_dump($this->tags);

?>
<div class="container">
    <h1>Тэги</h1>
    <hr>
    <div class="form-group">
        <a class="btn btn-primary" href="/manager/tag">Тэги</a>
        <a class="btn btn-primary" href="/manager/category">Категории</a>
        <a class="btn btn-primary" href="/manager/job">Работа</a>
    </div>
    <form action="<?= $this->makeUrl("manager/_tag_add"); ?>" method="post">
        <div class="form-group">
            <label>Название <span class="text-danger">*</span></label>
            <input type="text" class="form-control" name="name"  />
        </div>
        <div class="form-group">
            <label>Описание <span class="text-danger">*</span></label>
            <textarea name="description" rows="3" class="form-control"></textarea>
        </div>
        <input type="hidden" name="csrf_token" value="<?= App\Utility\Token::generate(); ?>" />
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
    <hr>
    <table class="table table-bordered">
        <? foreach($this->tags as $t): ?>
        <tr>
            <td><?= $t->name; ?></td>
            <td><?= $t->description; ?></td>
            <td>
                <a href="/manager/tag_edit?id=<?= $t->id; ?>">Редактировать</a>
            </td>
        </tr>
        <? endforeach; ?>
    </table>
</div>
