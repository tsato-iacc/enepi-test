<p>
  <?= MyView::link_to(map_admin_lpgas_companies_path, target: '_blank' { ?>
    <i class="fa fa-map-marker"></i>
    旧対応エリアマップ
  <? } ?>
</p>

<?= search_form_for [:admin, @q] { |f| ?>
  <div class="form-group">
    <div class="form-inline">
      <?= f.input :display_name_eq, required: false, label: "表示名が等しい" ?>
      <div class="form-group">
        <label>この郵便番号に対応できる会社 ※送客可否のフラグは無視されます</label>
        <?= text_field_tag :zip_code, params[:zip_code], ["class" => 'form-control' ?>
      </div>
    </div>
  </div>

  <?= f.button :submit, '検索' ?>
<? } ?>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>ID</th>
      <th>パートナーID</th>
      <th>会社名</th>
      <th>表示名</th>
      <th>都道府県</th>
      <th>TEL</th>
      <th>FAX</th>
      <th>成約手数料</th>
      <th>送客可</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <? @companies.each { |c| ?>
      <tr>
        <td><?= c.id ?></td>
        <td><?= MyView::link_to(c.partner_company_id, edit_admin_partner_company_path(c.partner_company_id) ?></td>
        <td><?= c.company_name ?></td>
        <td><?= c.display_name ?></td>
        <td><?= c.prefecture_name ?></td>
        <td><?= c.tel ?></td>
        <td><?= c.fax ?></td>
        <td>
          <?= [
            c.default_contracted_commission_s,
            c.default_contracted_commission_w,
            c.default_contracted_commission_sw
          ].join("-") ?>
        </td>
        <td><?= boolean_label c.estimate_req_sendable ?></td>
        <td>
          <ul>
            <li><?= MyView::link_to(fa_text('list', '見積もり依頼一覧'), admin_lpgas_company_estimates_path(c) ?></li>
            <li><?= MyView::link_to(fa_text('exclamation-triangle', 'NG企業'), admin_lpgas_company_ng_companies_path(c) ?></li>
            <li><?= MyView::link_to(fa_text('map-marker', '営業拠点一覧'), admin_lpgas_company_offices_path(c) ?></li>
            <li><?= MyView::link_to(fa_text('edit', '編集'), edit_admin_lpgas_company_path(c) ?></li>
          </ul>
        </td>
      </tr>
    <? } ?>
  </tbody>
</table>

<?= paginate @companies ?>
