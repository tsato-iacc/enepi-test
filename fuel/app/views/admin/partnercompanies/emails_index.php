<?= \Form::open(); ?>
  <?= \Form::csrf(); ?>
  <div class="form-group row mb-0">
    <div class="col-4">
      <div class="form-group<?= $val->error('email') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="email"><h6><i class="fa fa-asterisk" aria-hidden="true"></i> Email</h6></label>
        <input type="text" required name="email" value="<?= $val->input('email', '') ?>" class="form-control" id="email">
        <?php if ($val->error('email')): ?>
          <div class="form-control-feedback"><?= e($val->error('email')) ?></div>
        <?php endif; ?>
      </div>
    </div>
  </div>
  <button type="submit" class="btn btn-primary">登録する</button>
<?= Form::close(); ?>

<table class="table table-sm table-hover small-row mt-4">
  <thead>
    <tr>
      <th>メールアドレス</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?= $partner_company->email; ?></td>
      <td></td>
    </tr>
    <?php if ($partner_company->emails): ?>
      <?php foreach($partner_company->emails as $e): ?>
        <tr>
          <td><?= $e->email ?></td>
          <td><a href="<?= \Uri::create('admin/partner_companies/:id/emails/:e_id/delete', ['id' => $partner_company->id, 'e_id' => $e->id]) ?>" onclick="return confirm('本当によろしいですか?')">削除</a></td>
        </tr>
      <?php endforeach; ?>
    <?php endif;?>
  </tbody>
</table>
