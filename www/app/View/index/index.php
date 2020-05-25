
<?

    // var_dump($this->jobs[0]->name);
    // die();

?> 
<h1>Работа в Великом Новгороде</h1>
<div class="uk-flex">
    <div class="uk-card uk-card-default uk-card-body uk-width-1-4 uk-card-small">
        <div class="uk-width-1-2@s uk-width-2-5@m">
        <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
            <? foreach ($this->categories as $c): ?>
                <li class="uk-active"><a href="/<?= $c->slug; ?>/"><?= $c->name; ?></a></li>
            <? endforeach; ?>
        </ul>
        </div>
    </div>
    <div class="uk-width-1-2 uk-card-small uk-margin-left">
        <? foreach ($this->jobs as $j): ?>
            <div class="uk-card uk-card-default uk-width-1-1@m uk-margin">
                <div class="uk-card-header">
                    <div class="uk-grid-small uk-flex-middle" uk-grid>
                        <div class="uk-width-auto">
                            <img class="uk-border-circle" width="40" height="40" src="/image/default-image.jpg">
                        </div>
                        <div class="uk-width-expand">
                            <h3 class="uk-card-title uk-margin-remove-bottom"><?= $j->name; ?></h3>
                            <p class="uk-text-meta uk-margin-remove-top"><time datetime="<?= $j->dt_add; ?>"><?= $j->dt_add; ?></time></p>
                        </div>
                    </div>
                </div>
                <div class="uk-card-body">
                    <p><?= $j->announcement; ?></p>
                </div>
                <div class="uk-card-footer">
                    <a href="#" class="uk-button uk-button-text">Read more</a>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>