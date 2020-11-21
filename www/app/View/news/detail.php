
<?
    // var_dump($this->job);
?>

<div class="uk-card uk-card-default uk-card-body uk-width-1-1@m">
    <a href="/" class="uk-button uk-button-default uk-margin-bottom"><span class="uk-margin-small-right" uk-icon="arrow-left"></span></a>
    <hr />
    <ul class="uk-breadcrumb">
        <li><a href="/">Главная</a></li>
        <li><span><?= $this->title; ?></span></li>
    </ul>
    
    <div class="uk-flex">
        <div class="uk-width-1-1">
            <div class="uk-flex">
                <div class="uk-width-1-1">
                    <h1><?= $this->title; ?></h1>
                </div>
            </div>
            <div class="uk-height-medium uk-flex uk-flex-center uk-flex-middle uk-background-cover uk-light" data-src="<?= $this->blog->url_image; ?>" uk-img></div>
            <p><?= $this->blog->text; ?></p>
            <p>Источник текста: <a target="nofollow" href="<?= $this->blog->url; ?>"><?= $this->blog->url; ?></a></p>
        </div>
    </div>

    <hr>
    <div class="uk-text-meta"><div>Просмотры: <?= $this->blog->views; ?></div><div>Время добавления: <?= $this->blog->dt_add; ?></div></div>
</div>