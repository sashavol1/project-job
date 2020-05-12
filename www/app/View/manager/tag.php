

<?

// var_dump($this->tags);

?>
<div class="container">
    <h1>Тэги</h1>
    <hr>
    <div class="form-group">
        <a class="btn btn-primary" href="/manager/tags">Тэги</a>
        <a class="btn btn-primary" href="/manager/categories">Категории</a>
        <a class="btn btn-primary" href="/manager/jobs">Работа</a>
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
        <tr>
            <td></td>
            <td></td>
            <td></td>
        </tr>
    </table>
</div>
