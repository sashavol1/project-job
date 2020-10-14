

<?

$this->addJS(['js/setting.js']);

?>
<script src='https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.3/inputmask.min.js'></script>
<a href="/cabinet/" class="uk-button uk-button-primary uk-margin-bottom"><span class="uk-margin-small-right" uk-icon="arrow-left"></span></a>
<div class="uk-card uk-card-default uk-card-body uk-width-1-1@m">
    <h1>Редактирование профиля</h1>
    <hr>
    <form action="<?= $this->makeUrl("cabinet/settings/"); ?>" method="post" enctype="multipart/form-data">
        <div class="uk-margin">
            <label>Название <span class="text-danger">*</span></label>
            <input type="text" class="uk-input trigger-input-translit" name="name" value="<?= isset($this->post['name']) ? $this->post['name'] : $this->this_user->name; ?>" />
        </div>
        <div class="uk-margin">
            <label>Описание <span class="text-danger">*</span></label>
            <textarea name="about" rows="3" class="uk-input"><?= isset($this->post['about']) ? $this->post['about'] : $this->this_user->about; ?></textarea>
        </div>
        <? if ($this->this_user->avatar != ''): ?>
        <div class="uk-child-width-1-4@m" uk-grid>
            <div>
                <div class="uk-card uk-card-default">
                    <div class="uk-card-media-top">
                        <img src="<?= $this->this_user->avatar; ?>" alt="<?= isset($this->post['name']) ? $this->post['name'] : $this->this_user->name; ?>">
                    </div>
                </div>
            </div>
        </div>
        <? endif; ?>
        <div class="uk-margin">
            <div uk-form-custom>
                <input type="file" name="avatar" accept=".jpg, .jpeg, .png">
                <input type="hidden" name="avatar_file" value="<?= $this->this_user->avatar; ?>">
                <button class="uk-button uk-button-default" type="button" tabindex="-1">Загрузить фото</button>
            </div>
        </div>
        <div class="uk-margin">
            <label><input class="uk-checkbox" type="checkbox" name="is_employee" <?= !boolval($this->this_user->is_employee) ? '' : 'checked'; ?> > Соискатель</label>
        </div>
        <div class="uk-margin">
            <label><input class="uk-checkbox" type="checkbox" name="is_employer" <?= !boolval($this->this_user->is_employer) ? '' : 'checked'; ?> > Работодатель</label>
        </div>
        <div class="uk-margin">
            <div class="uk-contacts">
                <h3>Контакты</h3>
                <div class="uk-contacts-wrap">
                    <? foreach ($this->contacts as $item): ?>
                        <div class="uk-grid item-contact">
                            <div class="uk-width-1-4">
                                <select name="type" class="uk-select contact-type">
                                    <option value="phone" <?= $item->type == 'phone' ? 'selected' : ''; ?> >Телефон</option>
                                    <option value="email" <?= $item->type == 'email' ? 'selected' : ''; ?> >Емейл</option>
                                </select>
                                <input type="hidden" class="contact-id" value="<?= $item->id; ?>" />
                            </div>
                            <div class="uk-width-1-2 item-contact-value">
                                <? if ($item->type === 'phone'): ?>
                                    <input type="text" class="uk-input mask contact-value" data-inputmask="'mask': '+7 (999)9999999'" value="<?= substr($item->value, 1); ?>">
                                <? else: ?>
                                    <input type="text" class="uk-input mask contact-value" data-inputmask="'mask': '*{1,20}[.*{1,20}][.*{1,20}][.*{1,20}]@*{1,20}[.*{2,6}][.*{1,2}]'" value="<?= $item->value; ?>">
                                <? endif; ?>
                            </div>
                            <div class="uk-width-1-5">
                                <a href="" class="uk-contacts-delete"><span class="uk-margin-small-right uk-text-danger " uk-icon="icon: close; ratio: 2"></span></a>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
                <a href="" id="addContact" class="uk-button uk-button-default uk-margin-top">Добавить контакт</a>
            </div>
            <input type="hidden" id="contacts" name="contacts">
        </div>
        <input type="hidden" name="csrf_token" value="<?= App\Utility\Token::generate(); ?>" />
        <button type="submit" class="uk-button uk-button-primary" id="add">Добавить</button>
    </form>
</div>
