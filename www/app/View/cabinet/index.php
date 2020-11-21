<div class="container">
    <h1>Здравствуйте, <?= $this->user->name; ?></h1>
    <a href="/cabinet/add" class="uk-button uk-button-primary">Добавить работу</a>
    <a href="/cabinet/settings" class="uk-button uk-button-primary">Редактировать профиль</a>
    <div class="uk-width-1-2@m uk-card-small uk-margin-top">
        <? foreach ($this->jobs as $j): ?>
            <div class="uk-card uk-width-1-1@m uk-margin <?= $j->status == 'archive' ? 'uk-card-secondary' : 'uk-card-default'; ?>">
                <div class="uk-card-header">
                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-width-expand">
                            <h3 class="uk-card-title uk-margin-remove-bottom">
                                <?= $j->name; ?> 
                                <? if (App\Presenter\Helper::isActual($j->dt_current, 7)): ?>
                                    <span uk-tooltip="Актуально" title="Актуально" uk-icon="bolt"></span>
                                <? endif; ?>
                            </h3>
                            <p class="uk-text-meta uk-margin-remove-top">
                                Добавлено: <time datetime="<?= $j->dt_add; ?>"><?= $j->dt_add; ?></time> 
                                | Изменено: <time datetime="<?= $j->dt_chg; ?>"><?= $j->dt_chg; ?></time>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="uk-card-body">
                    <p><?= $j->announcement; ?></p>
                </div>
                <div class="uk-card-footer">
                    <? if ($j->status == 'archive'): ?>
                        <span>Работа в архиве</span>
                    <? else: ?>
                        <a href="/all/<?= $j->slug; ?>" class="uk-button uk-button-text uk-margin-right" target="_blank">Публичная страница</a>
                        <a href="/cabinet/edit?id=<?= $j->id; ?>" class="uk-button uk-button-text uk-margin-right">Редактировать</a>
                        <a href="/cabinet?to_archive=<?= $j->id; ?>" class="uk-button uk-button-text uk-margin-right" onclick="return confirm('Отправить в архив?')">В архив</a>
                        <? if (!App\Presenter\Helper::isActual($j->dt_current, 7)): ?>
                            <a href="/cabinet?to_improve=<?= $j->id; ?>" class="uk-button uk-button-primary uk-margin-right" onclick="return confirm('Обновить актуальность?')">Актуально</a>
                        <? endif; ?>
                    <? endif; ?>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>

<?