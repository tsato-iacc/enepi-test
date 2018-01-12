<div class="form-group row">
  <div class="col-12">
    <a class="btn btn-secondary" href="<?= \Uri::create('admin/users/create'); ?>" role="button">新規作成</a>
  </div>
</div>

<table class="table table-sm table-hover small-row">
  <thead>
    <tr>
      <th>メールアドレス</th>
      <th>作成日時</th>
      <th>更新日時</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($users as $u): ?>
      <tr>
        <td><?= $u->email ?></td>
        <td><?= \Helper\TimezoneConverter::convertFromString($u->created_at, 'admin_table') ?></td>
        <td><?= \Helper\TimezoneConverter::convertFromString($u->updated_at, 'admin_table') ?></td>
        <td><a href="<?= \Uri::create('admin/users/:id/delete', ['id' => $u->id]) ?>" onclick="return confirm('本当によろしいですか?')">削除</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
