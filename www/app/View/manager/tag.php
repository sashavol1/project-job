

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
    <div class="form-group">
    <a href="/manager/tag_add" class="btn btn-success">Добавить работу</a>
    </div>
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
