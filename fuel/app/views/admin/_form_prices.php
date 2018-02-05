<div class="form-group row">
  <label for="basic_price" class="col-3 col-form-label text-right"><b>基本料金</b> <span class="badge badge-default font-weight-normal">必須</span></label>
  <div class="col-2">
    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
      <input type="number" name="basic_price" class="form-control" id="basic_price" value="<?= $price_rule->basic_price; ?>" required="required">
      <div class="input-group-addon">円</div>
    </div>
  </div>
</div>
<div class="form-group row">
  <label for="fuel_adjustment_cost" class="col-3 col-form-label text-right"><b>基本料金</b> <span class="badge badge-default font-weight-normal">必須</span></label>
  <div class="col-2">
    <div class="input-group mb-2 mr-sm-2 mb-sm-0">
      <input type="number" name="fuel_adjustment_cost" class="form-control" id="fuel_adjustment_cost" value="<?= $price_rule->fuel_adjustment_cost; ?>" required="required">
      <div class="input-group-addon">円/m3</div>
    </div>
  </div>
</div>
<hr>
<div class="form-group row mb-0">
  <label class="col-3 col-form-label"></label>
  <label class="col-2 col-form-label"><b>従量単価</b></label>
  <label class="col-2 col-form-label"><b>下限</b></label>
  <label class="col-2 col-form-label"><b>上限</b></label>
</div>
<div id="unit_prices">
  <?php $rules_count = count($price_rule->prices); ?>
  <?php if ($rules_count == 0): ?>
    <div class="form-group row" data-position="0">
      <label class="col-3 col-form-label text-right"><b><span class="step">1</span>段階目</b></label>
      <div class="col-2">
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <input type="number" name="prices[0][unit_price]" class="form-control" required="required">
          <div class="input-group-addon">円</div>
        </div>
      </div>
      <div class="col-2">
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <input type="number" name="prices[0][under_limit]" class="form-control" readonly="readonly" value="0">
          <div class="input-group-addon">m3</div>
        </div>
      </div>
      <div class="col-2">
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <input type="number" name="prices[0][upper_limit]" class="form-control">
          <div class="input-group-addon">m3</div>
        </div>
      </div>
      <div class="col-1"><button type="button" class="btn btn-success" id="unit_price_add">追加</button></div>
    </div>
  <?php endif; ?>

  <?php foreach (\Arr::reindex($price_rule->prices) as $k => $price): ?>
    <?php $current = $k + 1; ?>
    <div class="form-group row" data-position="<?= $k; ?>">
      <label class="col-3 col-form-label text-right"><b><span class="step"><?= $current; ?></span>段階目</b></label>
      <div class="col-2">
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <input type="number" name="prices[<?= $k; ?>][unit_price]" class="form-control" required="required" value="<?= $price->unit_price; ?>"<?= $rules_count != $current ? 'readonly="readonly"' : ''; ?>>
          <div class="input-group-addon">円</div>
        </div>
      </div>
      <div class="col-2">
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <input type="number" name="prices[<?= $k; ?>][under_limit]" class="form-control" readonly="readonly" value="<?= $price->under_limit; ?>">
          <div class="input-group-addon">m3</div>
        </div>
      </div>
      <div class="col-2">
        <div class="input-group mb-2 mr-sm-2 mb-sm-0">
          <input type="number" name="prices[<?= $k; ?>][upper_limit]" class="form-control" value="<?= $price->upper_limit; ?>"<?= $rules_count != $current ? 'readonly="readonly"' : ''; ?>>
          <div class="input-group-addon">m3</div>
        </div>
      </div>
      <?php if ($k == 0): ?>
        <div class="col-1"><button type="button" class="btn btn-success" id="unit_price_add">追加</button></div>
      <?php else: ?>
        <div class="col-1"><button type="button" class="btn btn-danger"<?= $rules_count != $current ? 'disabled="disabled"' : ''; ?>>削除</button></div>
      <?php endif; ?>
    </div>
  <?php endforeach; ?>
</div>
<hr>
<div class="form-group row">
  <label for="notes" class="col-3 col-form-label text-right"><b>備考</b></label>
  <div class="col-9">
    <textarea class="form-control" id="notes" rows="3" name="notes"><?= $price_rule->notes; ?></textarea>
  </div>
</div>
<div class="form-group row">
  <label for="set_plan" class="col-3 col-form-label text-right"><b>機器・配管セットプラン</b></label>
  <div class="col-9">
    <textarea class="form-control" id="set_plan" rows="3" name="set_plan"><?= $price_rule->set_plan; ?></textarea>
  </div>
</div>
<div class="form-group row">
  <label for="other_set_plan" class="col-3 col-form-label text-right"><b>その他セットプラン</b></label>
  <div class="col-9">
    <textarea class="form-control" id="other_set_plan" rows="3" name="other_set_plan"><?= $price_rule->other_set_plan; ?></textarea>
  </div>
</div>
<div class="form-group row">
  <div class="col-1 offset-3">
    <button type="submit" class="btn btn-primary">送信</button>
  </div>
</div>
