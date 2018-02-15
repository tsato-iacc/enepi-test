<div class="form-group row">
  <div class="col-12">
    <a class="btn btn-secondary" href="<?= \Uri::create('admin/partner_companies/create'); ?>" role="button">新規作成</a>
  </div>
</div>

<table class="table table-sm table-hover small-row">
  <thead>
    <tr>
      <th>ID</th>
      <th>会社名</th>
      <th>メールアドレス</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($companies as $c): ?>
      <tr>
        <td><?= $c->id ?></td>
        <td><?= $c->company_name ?></td>
        <td><?= $c->email ?></td>
        <td>
          <div><a href="<?= \Uri::create('admin/partner_companies/:id/edit', ['id' => $c->id]) ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 編集</a></div>
          <div><a href="<?= \Uri::create('admin/partner_companies/:id/emails', ['id' => $c->id]) ?>"><i class="fa fa-envelope-o" aria-hidden="true"></i> 通知用メールアドレスの追加</a></div>
          <?php if (\Fuel::$env != \Fuel::PRODUCTION): ?>
            <div><a href="<?= \Uri::create('admin/partner_companies/:id/login', ['id' => $c->id]) ?>"><i class="fa fa-id-card-o" aria-hidden="true"></i> (デバッグ用) この会社としてログイン</a></div>
          <?php endif; ?>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
