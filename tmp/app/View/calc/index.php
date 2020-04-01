
<?php
    $company = json_decode( json_encode((array) $this->company->data()), true);
    $companies = '';
?>
<?php foreach($company as $c): ?>
  <?php if ($c['show']): ?>
    <?php $companies .= $c['company_id'] . ','; ?>
  <?php endif; ?>
<?php endforeach; ?>

<?php if (isset($this->user)): ?>
    <div class="container">
        <div class="jumbotron">
            <h1>Расчёт доставки</h1>
            <div class="ec-delivery"></div>
            <script id="dcsbl" src="<?= $this->makeURL("/js/delivery.js?comp=". trim($companies, ",") ."&btn=no&dopInsure=1&innerDeliv=1"); ?>" type="text/javascript"></script>
        </div>
    </div>
<?php endif; ?>