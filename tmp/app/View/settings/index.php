<?php $company = json_decode( json_encode((array) $this->company->data()), true); ?>

<div class="container">
    <div class="jumbotron mt-5">
      <h1 class="display-4">Настроить доставку</h1>
      <hr class="my-4">
      <form action="<?= $this->makeUrl("settings/_update_company"); ?>" method="post">
      <div class="form-group">
        <label for="">Выбор компаний</label>
        <select class="form-control" multiple="multiple" name="ids[]">
            <?php foreach($company as $c): ?>
              <option <?php echo $c['show'] ? 'selected' : ''; ?> value="<?php echo $c['id']; ?>"><?php echo $c['name']; ?></option>
            <?php endforeach; ?>
        </select>
      </div>
      <p class="lead">
        <button class="btn btn-primary btn-lg" href="#" role="button">Сохранить</button>
      </p>
    </form>
    </div>
</div>