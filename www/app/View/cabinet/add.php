<?

use App\Utility;

?>

<div class="container">
    <form action="<?= $this->makeUrl("cabinet/_add"); ?>" method="post">
        <div class="form-group">
            <label for="email-input">Название <span class="text-danger">*</span></label>
            <input type="text" id="email-input" class="form-control" name="name" value="<?= isset($this->post["name"]) ? $this->post["name"] : ''; ?>" />
        </div>
        <div class="form-group">
            <label>Анонс <span class="text-danger">*</span></label>
            <textarea name="work_annonce" rows="3" class="form-control"><?= isset($this->post["work_annonce"]) ? $this->post["work_annonce"] : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label>Требования <span class="text-danger">*</span></label>
            <textarea name="work_requirements" rows="3" class="form-control"><?= isset($this->post["work_requirements"]) ? $this->post["work_requirements"] : ''; ?></textarea>
        </div>
        <div class="form-group">
            <label>Условия <span class="text-danger">*</span></label>
            <textarea name="work_conditions" rows="3" class="form-control"><?= isset($this->post["work_conditions"]) ? $this->post["work_conditions"] : ''; ?></textarea>
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