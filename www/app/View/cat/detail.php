
<?

    // var_dump($this->category);
    // die();

?> 
<h1><?= $this->category[0]->name; ?> - работа, вакансии</h1>
<div class="uk-flex uk-flex-top uk-grid-small" uk-grid>
    <div class="uk-width-1-3@m">
        <div class="uk-card uk-card-default uk-card-body uk-card-small">
            <div class="uk-width-1-1@s">
            <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
                <? foreach ($this->categories as $c): ?>
                    <? if ($this->category[0]->name == $c->name): ?>
                        <li class="uk-active"><a href="/cat/<?= $c->slug; ?>/"><?= $c->name; ?></a></li>
                    <? else: ?>
                        <li><a href="/cat/<?= $c->slug; ?>/"><?= $c->name; ?></a></li>
                    <? endif; ?>
                <? endforeach; ?>
            </ul>
            </div>
        </div>
    </div>
    <div class="uk-width-1-2@m">
        <div class="uk-card-small uk-margin-left">
            <? if (empty($this->jobs)): ?>
                Вакансий не найдено
            <? endif; ?>
            <? foreach ($this->jobs as $j): ?>
                <div class="uk-card uk-card-default uk-margin">
                    <div class="uk-card-header">
                        <div class="uk-grid-small uk-flex-middle" uk-grid>
                            <div class="uk-width-auto">
                                <img class="uk-border-circle" width="40" height="40" src="<?= $j->user_avatar != '' ? $j->user_avatar : '/image/default-image.jpg' ; ?>">
                            </div>
                            <div class="uk-width-expand">
                                <h3 class="uk-card-title uk-margin-remove-bottom"><?= $j->name; ?></h3>
                                <p class="uk-text-meta uk-margin-remove-top"><time datetime="<?= $j->dt_add; ?>"><?= $j->dt_add; ?></time> | <?= $j->user_name; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="uk-card-body">
                        <p><?= $j->announcement; ?></p>
                    </div>
                    <div class="uk-card-footer">
                        <a href="/all/<?= $j->slug; ?>" class="uk-button uk-button-text">Подробнее</a>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>