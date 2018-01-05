<? //@page = "Users"
$new_admin_user_path = "/admin/users/new";

class Users{
	var $email = "test@test";
	var $created_at;
	var $updated_at;
}

$users = [
		new Users(),
		new Users(),
		new Users(),
];

?>

<div class="btn-group" role="group" aria-label="...">
  <?= MyView::link_to('新規作成', $new_admin_user_path, ["class" => "btn btn-default"]) ?>
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

    <? foreach($users as $u){ ?>
      <tr>
        <td><?= $u->email ?></td>
        <td><?= MyView::format_datetime($u->created_at) ?></td>
        <td><?= MyView::format_datetime($u->updated_at) ?></td>
        <td> <?= MyView::link_to_local_contents('削除', MyView::admin_user_path($u), ["method" => 'delete', "confirm" => "1"]) ?> </td>
      </tr>
    <? } ?>

  </tbody>
</table>
