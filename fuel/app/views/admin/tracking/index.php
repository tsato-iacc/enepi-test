<?= \Form::open(['action' => \Uri::create('admin/tracking')]); ?>
  <?= \Form::csrf(); ?>
  <div class="form-inline">
    <div class="form-group<?= $val->error('name') ? ' has-danger' : ''?>">
      <label class="form-control-label mr-sm-2" for="name"><h6>パラメータ名 <span class="badge badge-default">必須</span></h6></label>
      <input type="text" name="name" value="<?= $val->input('name', '') ?>" class="form-control mb-2 mr-sm-2 mb-sm-0" id="name">
    </div>
    
    <div class="form-group<?= $val->error('display_name') ? ' has-danger' : ''?>">
      <label class="form-control-label mr-sm-2" for="display_name"><h6>表示名 <span class="badge badge-default">必須</span></h6></label>
      <input type="text" name="display_name" value="<?= $val->input('display_name', '') ?>" class="form-control mb-2 mr-sm-2 mb-sm-0" id="display_name">
    </div>
    
    <div class="form-group">
      <label class="mr-sm-2" for="cv_point">CV地点</label>
      <?= Form::select('cv_point', $val->input('cv_point', ''), __('admin.tracking.cv_point'), ['class' => 'custom-select mb-2 mr-sm-2 mb-sm-0', 'id' => 'cv_point']); ?>
    </div>
  </div>

  <?php if ($val->error('name') || $val->error('display_name')): ?>
  <div class="form-group has-danger">
    <?php if ($val->error('name')): ?>
    <div class="form-control-feedback"><?= e($val->error('name')) ?></div>
    <?php endif; ?>
    <?php if ($val->error('display_name')): ?>
    <div class="form-control-feedback"><?= e($val->error('display_name')) ?></div>
    <?php endif; ?>
  </div>
  <?php endif; ?>

  <div class="form-group<?= $val->error('conversion_tag') ? ' has-danger' : ''?>">
    <label class="form-control-label" for="conversion_tag"><h6>CVタグ</h6></label>
    <textarea name="conversion_tag" class="form-control" id="conversion_tag" rows="2"><?= $val->input('conversion_tag', '') ?></textarea>
    <?php if ($val->error('conversion_tag')): ?>
      <div class="form-control-feedback"><?= e($val->error('conversion_tag')) ?></div>
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

<h4 class="mt-4">登録済みの経由元</h4>

<table class="table table-sm table-hover small-row">
  <thead>
    <tr>
      <th>ID</th>
      <th>パラメータ名</th>
      <th>表示名</th>
      <th>CV地点</th>
      <th>CVタグ</th>
      <th>CVタグ表示条件</th>
      <th>SSL対応</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($tracks as $t): ?>
      <tr>
        <td><?= $t->id ?></td>
        <td><?= $t->name ?></td>
        <td><?= $t->display_name ?></td>
        <td><?= __('admin.tracking.cv_point.'.\Config::get('views.tracking.cv_point.'.$t->cv_point)) ?></td>
        <td>
          <?php if ($t->conversion_tag): ?>
            <i class="fa fa-commenting-o" aria-hidden="true" data-container="body" data-toggle="popover" data-placement="top" data-content="<?= $t->conversion_tag; ?>"></i>
          <?php endif;?>
        </td>
        <td><?= $t->render_conversion_tag_only_if_match ? "経由元が一致する場合のみ" : "いつでも" ?></td>
        <td><?= $t->support_ssl ? "対応" : "非対応" ?></td>
        <td><a href="<?= \Uri::create('admin/tracking/:id/edit', ['id' => $t->id]) ?>">編集</a></td>
        <td><a href="<?= \Uri::create('admin/tracking/:id/delete', ['id' => $t->id]) ?>" onclick="return confirm('本当によろしいですか?')">削除</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<h4 class="mt-4">更新履歴 (最新100件)</h4>

<table class="table table-sm table-hover small-row">
  <thead>
    <tr>
      <th>日時</th>
      <th>パラメータ名</th>
      <th>変更した管理者</th>
      <th>変更内容</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($tracks_history as $h): ?>
      <tr>
        <td><?= \Helper\TimezoneConverter::convertFromString($h->created_at, 'admin_table') ?></td>
        <td><?= $h->tracking->name ?></td>
        <td><?= $h->admin_user->email ?></td>
        <td>
          <!-- FIX ME Add diff -->
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
