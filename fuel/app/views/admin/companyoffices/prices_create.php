<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="#">会社一覧</a></li>
  <li class="breadcrumb-item"><a href="#">営業拠点一覧</a></li>
  <li class="breadcrumb-item"><a href="#">料金テーブル</a></li>
  <li class="breadcrumb-item active">料金</li>
</ol>
<!-- FIX ME Add copy from other plans -->
<!-- <h3>他の料金表からコピーする</h3> -->

<div class="card-group mb-4">
  <div class="card">
    <div class="card-block">
      <p class="card-text">ガスコンロ</p>
    </div>
    <div class="card-footer text-center">
      <?php if ($price_rule->using_cooking_stove): ?>
        <span class="badge badge-success">TRUE</span>
      <?php else: ?>
        <span class="badge badge-default">FALSE</span>
      <?php endif; ?>
    </div>
  </div>
  <div class="card">
    <div class="card-block">
      <p class="card-text">ガス給湯付き風呂釜</p>
    </div>
    <div class="card-footer text-center">
      <?php if ($price_rule->using_bath_heater_with_gas_hot_water_supply): ?>
        <span class="badge badge-success">TRUE</span>
      <?php else: ?>
        <span class="badge badge-default">FALSE</span>
      <?php endif; ?>
    </div>
  </div>
  <div class="card">
    <div class="card-block">
      <p class="card-text">その他</p>
    </div>
    <div class="card-footer text-center">
      <?php if ($price_rule->using_other_gas_machine): ?>
        <span class="badge badge-success">TRUE</span>
      <?php else: ?>
        <span class="badge badge-default">FALSE</span>
      <?php endif; ?>
    </div>
  </div>
  <div class="card">
    <div class="card-block">
      <p class="card-text">開設先の物件種別</p>
    </div>
    <div class="card-footer text-center">
      <?= __('admin.price_rule.house_kind.'.\Config::get('views.price_rule.house_kind.'.$price_rule->house_kind)); ?>
    </div>
  </div>
</div>

<h3>料金</h3>
<hr>
<?= \Form::open(); ?>
  <?= \Form::csrf(); ?>
  <input type="hidden" name="using_cooking_stove" value="<?= $price_rule->using_cooking_stove; ?>">
  <input type="hidden" name="using_bath_heater_with_gas_hot_water_supply" value="<?= $price_rule->using_bath_heater_with_gas_hot_water_supply; ?>">
  <input type="hidden" name="using_other_gas_machine" value="<?= $price_rule->using_other_gas_machine; ?>">
  <input type="hidden" name="house_kind" value="<?= $price_rule->house_kind; ?>">

  <?= render('admin/_form_prices', ['price_rule' => $price_rule]); ?>
<?= Form::close(); ?>

<!-- TEMPLATE PRICES START -->
<?= render('admin/_form_prices_template'); ?>
<!-- TEMPLATE PRICES END -->
