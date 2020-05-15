

<?

// var_dump($this->tags);
use App\Utility;

?>
<div class="container">
    <h1>Привет, Админ</h1>
    <hr>

    <div class="form-group">
        <a href="/manager/tag_add" class="uk-button uk-button-default">Добавить тэг</a>
        <a href="/manager/category_add" class="uk-button uk-button-default">Добавить категорию</a>
    </div>

    <ul class="uk-tab" data-uk-tab="{connect:'#switch-table'}">
        <li><a href="#">Тэги</a></li>
        <li><a href="#">Категории</a></li>
        <li><a href="#">Работа</a></li>
    </ul>

    <div id="switch-table" class="uk-switcher uk-margin">
        <div>
            <h2>Тэги</h2>
            <table class="uk-table uk-table-divider">
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
        <div>
            <h2>Категории</h2>
            <table class="uk-table uk-table-divider">
                <? foreach($this->categories as $c): ?>
                <tr>
                    <td><?= $c->name; ?></td>
                    <td><?= $c->description; ?></td>
                    <td>
                        <a href="/manager/category_edit?id=<?= $c->id; ?>">Редактировать</a>
                    </td>
                </tr>
                <? endforeach; ?>
            </table>
        </div>
        <div>
            <h2>Работа</h2>
            <table class="uk-table uk-table-divider">
                <? foreach($this->jobs as $j): ?>
                <tr>
                    <td><?= $j->name; ?></td>
                    <td><?= $j->announcement; ?></td>
                    <td>
                        <a href="/manager/job_edit?id=<?= $j->id; ?>">Редактировать</a>
                    </td>
                </tr>
                <? endforeach; ?>
            </table>
        </div>
    </div>

    <? if (Utility\Input::get("type") == 'tag'): ?>
    <? elseif (Utility\Input::get("type") == 'category'): ?>
    <? else: ?>
    <? endif; ?>
</div>
