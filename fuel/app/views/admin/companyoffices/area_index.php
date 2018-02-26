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

<?= \Form::open(['action' => \Uri::create('admin/tracking')]); ?>
  <?= \Form::csrf(); ?>
  <p>改行して複数の郵便番号を登録できます。</p>
  <div class="form-inline">    
    <div class="form-group">
      <label class="mr-sm-2" for="cv_point">市区町村からも選べます。</label>
      <?= Form::select('prefecture_code', $val->input('prefecture_code', ''), ['' => '選択して'] + JpPrefecture::allKanjiAndCode(), ['class' => 'form-control', 'id' => 'prefecture_code', 'required' => 'required']); ?>
    </div>
  </div>

  <div class="form-group<?= $val->error('zip_code') ? ' has-danger' : ''?>">
    <label class="form-control-label" for="zip_code"><h6>CVタグ</h6></label>
    <textarea name="zip_code" class="form-control" id="zip_code" rows="2"><?= $val->input('zip_code', '') ?></textarea>
    <?php if ($val->error('zip_code')): ?>
      <div class="form-control-feedback"><?= e($val->error('zip_code')) ?></div>
    <?php endif; ?>
  </div>

  <div class="form-check">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox" name="render_conversion_tag_only_if_match" value="1"<?= $val->input('render_conversion_tag_only_if_match') ? ' checked="checked"' : '' ?>>
      経由元が一致する場合のみ完了画面でCVタグを表示
    </label>
  </div>
  <div class="form-check">
    <label class="form-check-label">
      <input class="form-check-input" type="checkbox" name="auto_sendable" value="1"<?= $val->input('auto_sendable') ? ' checked="checked"' : '' ?>>
      自動見積もり可
    </label>
  </div>

  <button type="submit" class="btn btn-primary">登録する</button>
<?= Form::close(); ?>
