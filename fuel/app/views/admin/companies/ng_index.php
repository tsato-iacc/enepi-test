<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="<?= \Uri::create('admin/companies/'); ?>">会社一覧</a></li>
  <li class="breadcrumb-item"><a href="<?= \Uri::create('admin/partner_companies/:id/edit', ['id' => $company->partner_company->id]); ?>"><?= $company->getCompanyName(); ?></a></li>
  <li class="breadcrumb-item active">NG企業</li>
</ol>

<?= \Form::open(); ?>
  <?= \Form::csrf(); ?>
  <div class="form-group<?= $val->error('pattern') ? ' has-danger' : ''?>">
    <label class="form-control-label" for="pattern"><h6>改行して複数のパターンを登録できます。</h6></label>
    <textarea name="pattern" id="pattern" class="form-control" rows="10"></textarea>
    <?php if ($val->error('pattern')): ?>
      <div class="form-control-feedback"><?= e($val->error('pattern')) ?></div>
    <?php endif; ?>
  </div>
  <button type="submit" class="btn btn-primary">追加</button>
<?= Form::close(); ?>

<table class="table table-sm table-hover mt-4 small-row">
  <thead>
    <tr>
      <th>ID</th>
      <th>パターン</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($ngs as $ng): ?>
      <tr>
        <td><?= $ng->id ?></td>
        <td><?= $ng->pattern ?></td>
        <td><a href="<?= \Uri::create('admin/companies/:id/ng/:ng_id/delete', ['id' => $company->id, 'ng_id' => $ng->id]) ?>" onclick="return confirm('本当によろしいですか?')">削除</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?= \Pagination::instance('ngs')->render(); ?>
