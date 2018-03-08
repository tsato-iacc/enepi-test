<?= \Form::open(['action' => \Uri::create('admin/tracking/:id', ['id' => $tracking->id])]); ?>
  <?= \Form::csrf(); ?>
  <div class="form-group row">
    <label class="col-sm-2 col-form-label">パラメータ名</label>
    <div class="col-sm-10">
      <p class="form-control-static"><?= $tracking->name; ?></p>
    </div>
  </div>

  <div class="form-group<?= $val->error('display_name') ? ' has-danger' : ''?>">
    <label class="form-control-label" for="display_name"><h6>表示名 <span class="badge badge-default">必須</span></h6></label>
    <input type="text" name="display_name" value="<?= $tracking->display_name; ?>" class="form-control form-control-danger" id="display_name">
    <?php if ($val->error('display_name')): ?>
      <div class="form-control-feedback"><?= e($val->error('display_name')) ?></div>
    <?php endif; ?>
  </div>
  <div class="form-group<?= $val->error('cv_point') ? ' has-danger' : ''?>">
    <label class="form-control-label" for="cv_point"><h6>CV地点</h6></label>
    <?= Form::select('cv_point', \Config::get('views.tracking.cv_point.'.$tracking->cv_point), __('admin.tracking.cv_point'), ['class' => 'form-control', 'id' => 'cv_point']); ?>
  </div>

  <div class="form-group<?= $val->error('conversion_tag') ? ' has-danger' : ''?>">
    <label class="form-control-label" for="conversion_tag"><h6>CVタグ</h6></label>
    <textarea name="conversion_tag" class="form-control" id="conversion_tag" rows="2"><?= $tracking->conversion_tag; ?></textarea>
    <?php if ($val->error('conversion_tag')): ?>
      <div class="form-control-feedback"><?= e($val->error('conversion_tag')) ?></div>
    <?php endif; ?>
  </div>

  <div class="form-check">
    <label class="form-check-label">
      <?= Form::checkbox('render_conversion_tag_only_if_match', 1, $val->input('render_conversion_tag_only_if_match', $tracking->render_conversion_tag_only_if_match), ['class' => 'form-check-input']); ?>
      経由元が一致する場合のみ完了画面でCVタグを表示
    </label>
  </div>
  <div class="form-check">
    <label class="form-check-label">
      <?= Form::checkbox('auto_sendable', 1, $val->input('auto_sendable', $tracking->auto_sendable), ['class' => 'form-check-input']); ?>
      自動見積もり可
    </label>
  </div>

  <button type="submit" class="btn btn-primary">更新する</button>
<?= Form::close(); ?>
