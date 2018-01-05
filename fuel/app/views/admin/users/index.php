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
        <td><?= Carbon\Carbon::parse($u->created_at)->setTimezone('Asia/Tokyo')->format('Y-m-d H:i') ?></td>
        <td><?= $u->updated_at ?></td>
        <td><a href="/admin/users/1/delete" onclick="return confirm('本当によろしいですか?')">削除</a></td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
