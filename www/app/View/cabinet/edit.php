<?

use App\Utility;

$text = explode('%br%', $this->job->text);

?>

<div class="container">
    <h1>Редактирование работы № <?= $this->job->id; ?></h1>
    <form action="<?= $this->makeUrl("cabinet/_edit"); ?>" method="post">
        <div class="form-group">
            <label for="email-input">Название <span class="text-danger">*</span></label>
            <input type="text" id="email-input" class="form-control" name="name" value="<?= $this->job->name; ?>" />
        </div>
        <div class="form-group">
            <label>Анонс <span class="text-danger">*</span></label>
            <textarea name="work_annonce" rows="3" class="form-control"><?= isset($text[0]) ? $text[0] : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label>Требования <span class="text-danger">*</span></label>
            <textarea name="work_requirements" rows="3" class="form-control"><?= isset($text[1]) ? $text[1] : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label>Условия <span class="text-danger">*</span></label>
            <textarea name="work_conditions" rows="3" class="form-control"><?= isset($text[2]) ? $text[2] : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label>Категории <span class="text-danger">*</span></label>
            <select class="form-control">
                <option value="">Выбрать категории</option>
            </select>
        </div>

        <input type="hidden" name="csrf_token" value="<?= App\Utility\Token::generate(); ?>" />
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>