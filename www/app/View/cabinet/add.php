<div class="container">
    <form action="<?= $this->makeUrl("cabinet/_add"); ?>" method="post">
        <div class="form-group">
            <label for="email-input">Название <span class="text-danger">*</span></label>
            <input type="text" id="email-input" class="form-control" name="name" value="<?= $this->post["name"]; ?>" />
        </div>
        <div class="form-group">
            <label for="password-input">Текст <span class="text-danger">*</span></label>
            <textarea name="text" id="" cols="30" rows="10" class="form-control"><?= $this->post["text"]; ?></textarea>
        </div>
        <input type="hidden" name="csrf_token" value="<?= App\Utility\Token::generate(); ?>" />
        <button type="submit" class="btn btn-primary">Добавить</button>
    </form>
</div>