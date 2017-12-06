<?= MyView::form_tag bulk_update_admin_lpgas_company_ng_companies_path, ["method" => 'POST' { ?>
  <p>
    改行して複数のパターンを登録できます。
  </p>
  <div class="form-group">
    <?= text_area_tag :pattern, "", ["class" => "form-control", rows: "10" ?>
  </div>
  <div class="form-group">
    <?= submit_tag "追加", ["class" => 'btn btn-primary' ?>
  </div>
<? } ?>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>パターン</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <? @ng_companies.each { |nc| ?>
      <tr>
        <td><?= nc.id ?></td>
        <td><?= nc.pattern ?></td>
        <td><?= MyView::link_to('削除', admin_lpgas_company_ng_company_path(:company_id=> nc.company_id, :id=> nc.id), data: {["method" => 'delete', confirm: 1} ?></td>
      </tr>
    <? } ?>
  </tbody>
</table>
