
<?php $array = json_decode( json_encode((array) $this->users->data()), true); ?>

<div class="container">
    <div class="jumbotron bg-white mt-1">
        <h1 class="display-4">Все пользователи</h1>
        <hr class="my-4">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Имя</th>
                <th>Тип</th>
                <th>Действие</th>
            </tr>
            <?php foreach($array as $u): ?>
                <?php if($u["type"] != 'admin'): ?>
                <tr>
                    <td><?php echo $u["id"]; ?></td>
                    <td><?php echo $u["forename"] . ' ' . $u["surname"]; ?></td>
                    <td><?php echo $u["type"]; ?></td>
                    <td>
                        <form action="<?= $this->makeUrl("settings/_delete"); ?>" method="post">
                            <input type="hidden" value="<?php echo $u["id"]; ?>" name="id">
                            <input type="hidden" name="csrf_token" value="<?php echo App\Utility\Token::generate(); ?>" />
                            <button type="submit" class="btn btn-danger btn-sm">Удалить</button>
                        </form>
                    </td>
                </tr>
                <?php endif; ?>
            <?php endforeach; ?>
        </table>
    </div>
</div>