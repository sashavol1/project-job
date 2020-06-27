
<?
    // var_dump($this->job);
?>

<div class="uk-card uk-card-default uk-card-body uk-width-1-1@m">
    <a href="/" class="uk-button uk-button-default uk-margin-bottom"><span class="uk-margin-small-right" uk-icon="arrow-left"></span></a>
    <hr />
    <ul class="uk-breadcrumb">
        <li><a href="/">Главная</a></li>
        <li><a href="/all">Поиск работы</a></li>
        <li><span><?= $this->title; ?></span></li>
    </ul>
    <h1><?= $this->title; ?></h1>
    <p><?= nl2br($this->job->announcement); ?></p>
    <p><?= nl2br($this->job->requirements); ?></p>
    <p><?= nl2br($this->job->duties); ?></p>
    <div class="uk-text-meta"><div>Просмотры: <?= $this->job->views; ?></div><div>Время добавления: <?= $this->job->dt_add; ?></div></div>
</div>