<div class="form-group row">
  <div class="col-12">
    <a class="btn btn-secondary" href="<?= \Uri::create('admin/templates/create'); ?>" role="button">新規作成</a>
  </div>
</div>

<table class="table table-sm table-hover small-row">
  <thead>
    <tr>
      <th>テンプレート名</th>
      <th>件名</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach($templates as $t): ?>
      <tr>
        <td><?= $t->name; ?></td>
        <td><?= $t->subject; ?></td>
        <td class="text-right">
          <a href="<?= \Uri::create('admin/templates/:id/edit', ['id' => $t->id]); ?>" class="btn-estimate-delete btn btn-primary btn-sm px-3 py-0" role="button"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> 編集</a>
          <a href="<?= \Uri::create('admin/templates/:id/delete', ['id' => $t->id]); ?>" class="btn-estimate-delete btn btn-danger btn-sm px-3 py-0" role="button" onclick="return confirm('本当によろしいですか?')"><i class="fa fa-trash" aria-hidden="true"></i> 削除</a>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>
