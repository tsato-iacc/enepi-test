<?

class tracking_parameters{

	var $id;
	var $name;
	var $display_name;
	var $cv_point;
	var $conversion_tag;
	var $render_conversion_tag_only_if_match;
	var $support_ssl;
}



class tracking_parameter_change_logs{
	var $pr_tracking_parameter_name;
	var $created_at;
	var $admin_user_email;
	var $diff = ["k" => "v", "k2" => "v2"];
}




function edit_admin_pr_tracking_parameter_path($p){

}

function admin_pr_tracking_parameter_path($p){

}


$pr_tracking_parameters = [
		new tracking_parameters(),
		new tracking_parameters(),
		new tracking_parameters(),
		new tracking_parameters(),
		new tracking_parameters(),
];



$pr_tracking_parameter_change_logs = [
	new tracking_parameter_change_logs(),
	new tracking_parameter_change_logs(),
	new tracking_parameter_change_logs(),
	new tracking_parameter_change_logs(),
	new tracking_parameter_change_logs(),
];

?>
  <div class="form-group">
    <div class="form-inline">
      <div class="form-group string required pr_tracking_parameter_name"><label class="string required control-label" for="pr_tracking_parameter_name"><abbr title="required">*</abbr> パラメータ名</label><input class="string required form-control" required="required" aria-required="true" type="text" name="pr_tracking_parameter[name]" id="pr_tracking_parameter_name" /></div>
      <div class="form-group string required pr_tracking_parameter_display_name"><label class="string required control-label" for="pr_tracking_parameter_display_name"><abbr title="required">*</abbr> 表示名</label><input class="string required form-control" required="required" aria-required="true" type="text" name="pr_tracking_parameter[display_name]" id="pr_tracking_parameter_display_name" /></div>
      <div class="form-group enum optional pr_tracking_parameter_cv_point"><label class="enum optional control-label" for="pr_tracking_parameter_cv_point">CV地点</label><select class="enum optional form-control form-control" name="pr_tracking_parameter[cv_point]" id="pr_tracking_parameter_cv_point"><option value=""></option>
<option selected="selected" value="cv_point_done_estimate">見積もり</option>
<option value="cv_point_done_verbal_ok">送客</option></select></div>
    </div>
  </div>
  <div class="form-group text optional pr_tracking_parameter_conversion_tag"><label class="text optional control-label" for="pr_tracking_parameter_conversion_tag">CVタグ</label><textarea class="text optional form-control" name="pr_tracking_parameter[conversion_tag]" id="pr_tracking_parameter_conversion_tag">
</textarea></div>
  <div class="form-group boolean optional pr_tracking_parameter_render_conversion_tag_only_if_match"><div class="checkbox"><input value="0" type="hidden" name="pr_tracking_parameter[render_conversion_tag_only_if_match]" /><label class="boolean optional" for="pr_tracking_parameter_render_conversion_tag_only_if_match"><input class="boolean optional" type="checkbox" value="1" name="pr_tracking_parameter[render_conversion_tag_only_if_match]" id="pr_tracking_parameter_render_conversion_tag_only_if_match" />経由元が一致する場合のみ完了画面でCVタグを表示</label></div></div>
  <div class="form-group boolean optional pr_tracking_parameter_auto_sendable"><div class="checkbox"><input value="0" type="hidden" name="pr_tracking_parameter[auto_sendable]" /><label class="boolean optional" for="pr_tracking_parameter_auto_sendable"><input class="boolean optional" type="checkbox" value="1" checked="checked" name="pr_tracking_parameter[auto_sendable]" id="pr_tracking_parameter_auto_sendable" />自動見積もり可</label></div></div>

  <input type="submit" name="commit" value="登録する" class="btn btn-default" />
</form>



<h2>登録済みの経由元</h2>

<table class="table table-condensed table-striped table-hover">
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
    <? foreach($pr_tracking_parameters as $p){ ?>
      <tr>
        <td><?= $p->id ?></td>
        <td><?= $p->name ?></td>
        <td><?= $p->display_name ?></td>
        <td><?= $p->cv_point ?></td>
        <td style="width: 300px"><?= $p->conversion_tag ?></td>
        <td><?= $p->render_conversion_tag_only_if_match ? "経由元が一致する場合のみ" : "いつでも" ?></td>
        <td><?= $p->support_ssl ? "対応" : "非対応" ?></td>
        <td><?= MyView::link_to("編集", edit_admin_pr_tracking_parameter_path($p)) ?></td>
        <td><?= MyView::link_to("削除", admin_pr_tracking_parameter_path($p), ["confirm" => 1, "title" => '経由元のパラメータ名を正しく入力してください。']	); ?></td>
      </tr>
    <? } ?>
  </tbody>
</table>

<h2>更新履歴 (最新100件)</h2>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>日時</th>
      <th>パラメータ名</th>
      <th>変更した管理者</th>
      <th>変更内容</th>
    </tr>
  </thead>
  <tbody>
    <? foreach($pr_tracking_parameter_change_logs as $l){ ?>
      <tr>
        <td><?= MyView::format_datetime($l->created_at) ?></td>
        <td><?= $l->pr_tracking_parameter_name ?></td>
        <td><?= $l->admin_user_email ?></td>
        <td>
          <?= $l->diff ? "新規" : "更新" ?>:
          <? foreach($l->diff as $k => $v){ ?>
            <? if($k != 'last_update_admin_user_id'){ ?>

            <? } ?>
          <? } ?>
        </td>
      </tr>
    <? } ?>
  </tbody>
</table>
