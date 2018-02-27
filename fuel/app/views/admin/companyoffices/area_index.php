<?php
use JpPrefecture\JpPrefecture;
?>
<!-- <div class="row">
  <?php foreach (JpPrefecture::allKanjiAndCode() as $key => $name):?>
    <div class="btn-group col-2 mb-4" role="group" aria-label="Basic example">
      <button type="button" class="btn btn-secondary w-100"><?= $name; ?></button>
      <button type="button" class="btn btn-secondary"><i class="fa fa-cogs" aria-hidden="true"></i></button>
    </div>
  <?php endforeach; ?>
</div> -->

<?= \Form::open(); ?>
  <?= \Form::csrf(); ?>
  <p>改行して複数の郵便番号を登録できます。</p>
  <div class="form-group row">
    <div class="col-3">
      <div class="form-inline">
        <div class="form-group">
          <label class="mr-sm-2" for="cv_point">市区町村からも選べます。</label>
          <div class="">
            <?= Form::select('prefecture_code', $val->input('prefecture_code', ''), ['' => '選択してください'] + JpPrefecture::allKanjiAndCode(), ['class' => 'form-control', 'id' => 'prefecture_code']); ?>
          </div>
          <div class="ml-3">
            <select name="city_code" id="city_list" class="form-control" disabled=""><option value="">選択してください</option></select>
          </div>
        </div>
      </div>
    </div>
  </div>
  
  <div class="form-group<?= $val->error('zip_code') ? ' has-danger' : ''?>">
    <textarea name="zip_code" class="form-control" id="zip_code" rows="10"><?= $val->input('zip_code', '') ?></textarea>
    <?php if ($val->error('zip_code')): ?>
      <div class="form-control-feedback"><?= e($val->error('zip_code')) ?></div>
    <?php endif; ?>
  </div>

  <button type="submit" class="btn btn-primary">追加</button>
<?= Form::close(); ?>
