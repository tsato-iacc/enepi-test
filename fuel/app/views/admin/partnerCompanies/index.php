<div class="btn-group" role="group" aria-label="...">
  <?= MyView::link_to('新規作成', new_admin_partner_company_path, ["class" => "btn btn-default" ?>
</div>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>会社名</th>
      <th>メールアドレス</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <? @companies.each { |gc| ?>
      <tr>
        <td><?= gc.id ?></td>
        <td><?= gc.company_name ?></td>
        <td><?= gc.email ?></td>
        <td>
          <ul>
            <li><?= MyView::link_to('編集', edit_admin_partner_company_path(gc) ?></li>
            <li><?= MyView::link_to('通知用メールアドレスの追加', admin_partner_company_emails_path(gc) ?></li>
            <? unless Rails.env.production? ?>
              <li><?= MyView::link_to('(デバッグ用) この会社としてログイン', admin_partner_company_login_path(gc), ["method" => 'post' ?></li>
            <? } ?>
          </ul>
        </td>
      </tr>
    <? } ?>
  </tbody>
</table>

<?= paginate @companies ?>
