
<?

    // var_dump($this->jobs[0]->name);
    // die();

?> 
<h1>Поиск работы</h1>
<div class="uk-flex uk-flex-top uk-grid-small" uk-grid uk-height-match="target: > div">
    <div class="uk-width-1-2@m">
        <div class="uk-card uk-card-default uk-card-body">
            <h3 class="uk-card-title">Добавленная работа</h3>
            <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
            <? foreach ($this->jobs as $j): ?>
                <li><a href="/all/<?= $j->slug; ?>"><?= $j->name; ?> <div><strong><time datetime="<?= $j->dt_add; ?>"><?= $j->dt_add; ?></time></strong></div></a></li>                  
            <? endforeach; ?>
            </ul>
        </div>
    </div>
    <div class="uk-width-1-2@m">
        <div class="uk-card uk-card-default uk-card-body">
            <h3 class="uk-card-title">Новости</h3>
            <ul class="uk-nav-default uk-nav-parent-icon" uk-nav>
            <? foreach ($this->blogs as $b): ?>
                <li><a href="/news/<?= $b->slug; ?>"><?= $b->name; ?> <div><strong><time datetime="<?= $b->dt_add; ?>"><?= $b->dt_add; ?></time></strong></div></a></li>                  
            <? endforeach; ?>
            </ul>
        </div>
    </div>
</div>

<div class="uk-flex uk-flex-top uk-margin">
    <div class="uk-card uk-card-default uk-card-body uk-width-1-2@ uk-margin-top">
        <h3 class="uk-card-title">Категории</h3>
        <ul class="uk-nav-default uk-nav-parent-icon uk-column-1-2@s uk-column-1-3@m uk-column-1-4@l uk-column-1-5@xl" uk-nav>
        <? foreach ($this->categories as $c): ?>
            <li><a href="/cat/<?= $c->slug; ?>/"><?= $c->name; ?></a></li>             
        <? endforeach; ?>
        </ul>
    </div>
</div>