
<?
    // var_dump($this->job);
?>

<div class="uk-card uk-card-default uk-card-body uk-width-1-1@m uk-margin">
    <a href="/" class="uk-button uk-button-default uk-margin-bottom"><span class="uk-margin-small-right" uk-icon="arrow-left"></span></a>
    <hr />
    <ul class="uk-breadcrumb">
        <li><a href="/">Главная</a></li>
        <li><a href="/all">Поиск работы</a></li>
        <li><span><?= $this->title; ?></span></li>
    </ul>
    
    <div class="uk-flex" uk-grid>
        <div class="uk-width-2-3@l uk-width-1-2@s">
            <div class="uk-flex" uk-grid>
                <div class="uk-width-1-3@l uk-width-1-2@s">
                    <h1><?= $this->title; ?></h1>
                </div>
                <div class="uk-width-1-3@l uk-width-1-2@s uk-flex uk-flex-right uk-flex-middle uk-padding-small">
                    <? if ($this->job->salary_type == 0 && ($this->job->salary_from != 0 || $this->job->salary_to != 0)): ?>
                        <strong>Оплата:</strong> <?= $this->job->salary_from != 0 ? $this->job->salary_from : ''; ?> - <?= $this->job->salary_to != 0 ? $this->job->salary_to : ''; ?> рублей
                    <? else: ?>
                        <span class="uk-badge">оплата по договоренности</span>
                    <? endif; ?>
                </div>
            </div>
            <p><?= nl2br($this->job->announcement); ?></p>
            <p><?= nl2br($this->job->requirements); ?></p>
            <p><?= nl2br($this->job->duties); ?></p>
        </div>
        <div class="uk-width-1-3@l uk-width-1-2@s">
            <div class="uk-card uk-card-default">
                <div class="uk-card-header">
                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-width-auto">
                            <img class="uk-border-circle" width="40" height="40" src="<?= $this->job->user_avatar; ?>" alt="<?= $this->job->user_name; ?>" title="<?= $this->job->user_name; ?>">
                        </div>
                        <div class="uk-width-expand">
                            <h3 class="uk-card-title uk-margin-remove-bottom"><?= $this->job->user_name; ?></h3>
                            <p class="uk-text-meta uk-margin-remove-top"><time datetime="<?= $this->job->user_dt_add; ?>"><?= $this->job->user_dt_add; ?></time></p>
                        </div>
                    </div>
                </div>
                <div class="uk-card-body">
                    <p><?= nl2br($this->job->contacts); ?></p>
                </div>
            </div>
        </div>
    </div>

    <hr>
    <div class="uk-text-meta"><div>Просмотры: <?= $this->job->views; ?></div><div>Время добавления: <?= $this->job->dt_add; ?></div></div>
</div>