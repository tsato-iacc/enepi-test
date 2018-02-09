<!-- SEARCH FORM START -->
<?= \Form::open(['method' => 'GET', 'class' => 'mb-4']); ?>
  <div class="form-group row mb-0">
    <div class="col-2 pr-0">
      <div class="form-group<?= $val->error('created_from') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="created_from"><h6>開始日</h6></label>
        <input type="text" name="created_from" value="<?= \Helper\TimezoneConverter::convertFromString($from, 'admin_datepicker'); ?>" class="form-control datepicker" id="created_from">
      </div>
    </div>
    <div class="px-1 text-center">
      <div class="form-group">
        <label class="form-control-label"><h6>&nbsp;</h6></label>
        <p class="form-control-static">~</p>
      </div>
    </div>
    <div class="col-2 pl-0">
      <div class="form-group<?= $val->error('created_to') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="created_to"><h6>終了日</h6></label>
        <input type="text" name="created_to" value="<?= \Helper\TimezoneConverter::convertFromString($to, 'admin_datepicker'); ?>" class="form-control datepicker" id="created_to">
      </div>
    </div>
  </div>

  <button type="submit" class="btn btn-secondary">検索</button>
<?= Form::close(); ?>
<!-- SEARCH FORM END -->

<table class="table table-sm table-hover mt-4 small-row">
  <thead>
    <tr>
      <th>媒体</th>
      <th>問い合わせ数</th>
      <th>紹介数</th>
      <th>成約</th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($tracks as $track): ?>
      <tr>
        <td><?= $track->display_name ?></td>
        <td><?= \Model_Contact::count(['where' => [['pr_tracking_parameter_id', $track->id], ['created_at', '>=', $from], ['created_at', '<=', $to]]]); ?></td>
        <td><?= \Model_Estimate::count(['where' => [['created_at', '>=', $from], ['created_at', '<=', $to]], 'related' => ['contact' => ['where' => [['pr_tracking_parameter_id', $track->id]]]]]); ?></td>
        <td><?= \Model_Estimate::count(['where' => [['created_at', '>=', $from], ['created_at', '<=', $to]], 'related' => ['contact' => ['where' => [['pr_tracking_parameter_id', $track->id], ['status', 4]]]]]); ?></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
