<?= simple_form_for [:admin, @new_office] { |f| ?>
  <?= f.error_notification ?>
  <div class="form-group">
    <div class="form-inline">
      <?= f.input :zip_code ?>
      <?= f.input :prefecture_code, collection: JpPrefecture::Prefecture.all, value_["method" => :code ?>
      <?= f.input :address ?>
    </div>
  </div>

  <?= f.button :submit ?>
<? } ?>

<table class="table table-condensed table-striped table-hover">
  <thead>
    <tr>
      <th>郵便番号</th>
      <th>都道府県</th>
      <th>住所</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td><?= @company.zip_code ?></td>
      <td><?= @company.prefecture_name ?></td>
      <td><?= @company.address ?></td>
      <td>
        <?= MyView::link_to('料金テーブル', admin_lpgas_company_company_geocode_price_rules_path(@company, @company.company_geocode), ["class" => 'btn btn-primary btn-xs' ?>
        <?= MyView::link_to('対応可能市区町村', admin_lpgas_company_company_geocode_zip_codes_path(@company, @company.company_geocode), ["class" => 'btn btn-primary btn-xs' ?>
        <?= MyView::link_to('詳細', admin_lpgas_company_company_geocode_path(@company, @company.company_geocode), ["class" => 'btn btn-secondary btn-xs' ?>
      </td>
    </tr>
    <? @offices.select(&:persisted?).each { |o| ?>
      <tr>
        <td><?= o.zip_code ?></td>
        <td><?= o.prefecture_name ?></td>
        <td><?= o.address ?></td>
        <td>
          <?= MyView::link_to('料金テーブル', admin_lpgas_company_company_geocode_price_rules_path(@company, o.company_geocode), ["class" => 'btn btn-primary btn-xs' ?>
          <?= MyView::link_to('対応可能市区町村', admin_lpgas_company_company_geocode_zip_codes_path(@company, o.company_geocode), ["class" => 'btn btn-primary btn-xs' ?>
          <?= MyView::link_to('詳細', admin_lpgas_company_company_geocode_path(o.company, o.company_geocode), ["class" => 'btn btn-secondary btn-xs' ?>
          <?= MyView::link_to('削除', admin_lpgas_company_office_path(o.company, o), data: {["method" => 'delete', confirm: 1}, ["class" => 'btn btn-danger btn-xs' ?>
        </td>
      </tr>
    <? } ?>
  </tbody>
</table>
