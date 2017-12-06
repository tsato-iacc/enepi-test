<? @page = "Users" ?>

<div class="btn-group" role="group" aria-label="...">
  <?= MyView::link_to('新規作成', new_admin_user_path, ["class" => "btn btn-default" ?>
</div>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>メールアドレス</th>
      <th>作成日時</th>
      <th>更新日時</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <? @users.each { |u| ?>
      <tr>
        <td><?= u.email ?></td>
        <td><?= format_datetime! u.created_at ?></td>
        <td><?= format_datetime! u.updated_at ?></td>
        <td> <?= MyView::link_to('削除', admin_user_path(u), data: {["method" => 'delete', confirm: 1} ?> </td>
      </tr>
    <? } ?>
  </tbody>
</table>
