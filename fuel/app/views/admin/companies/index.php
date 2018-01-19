<?php
use JpPrefecture\JpPrefecture;
?>

<?= \Form::open(['method' => 'GET']); ?>
  <div class="form-group row mb-0">
    <div class="col-3">
      <div class="form-group<?= $val->error('name_equal') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="name_equal"><h6>表示名が等しい</h6></label>
        <input type="text" name="name_equal" value="<?= $val->input('name_equal', '') ?>" class="form-control" id="name_equal">
      </div>
    </div>
    <div class="col-3">
      <div class="form-group<?= $val->error('zip_code') ? ' has-danger' : ''?>">
        <label class="form-control-label" for="zip_code"><h6>この郵便番号に対応できる会社</h6></label>
        <input type="text" disabled="disabled" name="zip_code" value="<?= $val->input('zip_code', '') ?>" class="form-control" id="zip_code">
      </div>
    </div>
  </div>

  <button type="submit" class="btn btn-secondary">検索</button>
<?= Form::close(); ?>

<table class="table table-sm table-hover small-row mt-4">
  <thead>
    <tr>
      <th>
        <div>ID</div>
        <div>パートナー</div>
      </th>
      <th>
        <div><i class="fa fa-building" aria-hidden="true"></i> 会社名</div>
        <div><i class="fa fa-building-o" aria-hidden="true"></i> 表示名</div>
      </th>
      <th>
        <div><i class="fa fa-globe" aria-hidden="true"></i> 都道府県</div>
        <div><i class="fa fa-reply" aria-hidden="true"></i> 送客可</div>
      </th>
      <th>
        <div><i class="fa fa-phone" aria-hidden="true"></i> TEL</div>
        <div><i class="fa fa-fax" aria-hidden="true"></i> FAX</div>
      </th>
      <th>成約手数料</th>
      <th></th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php foreach ($companies as $company): ?>
      <tr>
        <td>
          <div><i class="fa fa-hashtag" aria-hidden="true"></i> <?= $company->id; ?></div>
          <div><a href="<?= \Uri::create('admin/partner_companies/:id/edit', ['id' => $company->partner_company->id]); ?>"><i class="fa fa-hashtag" aria-hidden="true"></i> <?= $company->partner_company->id; ?></a></div>
        </td>
        <td>
          <div><i class="fa fa-building" aria-hidden="true"></i> <?= $company->partner_company->company_name; ?></div>
          <div><i class="fa fa-building-o" aria-hidden="true"></i> <?= $company->display_name; ?></div>
        </td>
        <td>
            <div><i class="fa fa-globe" aria-hidden="true"></i> <?= JpPrefecture::findByCode($company->prefecture_code)->nameKanji; ?></div>
            <div>
              <i class="fa fa-reply" aria-hidden="true"></i>
              <?php if ($company->estimate_req_sendable): ?>
                <span class="badge badge-success">TRUE</span>
              <?php else: ?>
                <span class="badge badge-default">FALSE</span>
              <?php endif; ?>
            </div>
        </td>
        <td class="align-middle">
          <div><i class="fa fa-phone" aria-hidden="true"></i> <?= $company->tel; ?></div>
          <div><i class="fa fa-fax" aria-hidden="true"></i> <?= $company->fax; ?></div>
        </td>
        <td><?= implode('-', [$company->default_contracted_commission_s, $company->default_contracted_commission_w, $company->default_contracted_commission_sw ]); ?></td>
        <td>
          <div><a href="<?= \Uri::create('admin/companies/:id/estimates', ['id' => $company->id]); ?>"><i class="fa fa-list"></i> 見積もり依頼一覧</a></div>
          <div><a href="<?= \Uri::create('admin/companies/:id/ng', ['id' => $company->partner_company->id]); ?>"><i class="fa fa-exclamation-triangle"></i> NG企業</a></div>
        </td>
        <td>
          <div><a href="<?= \Uri::create('admin/companies/:id/offices', ['id' => $company->partner_company->id]); ?>"><i class="fa fa-map-marker"></i> 営業拠点一覧</a></div>
          <div><a href="<?= \Uri::create('admin/companies/:id/edit', ['id' => $company->partner_company->id]); ?>"><i class="fa fa-edit"></i> 編集</a></div>
        </td>
      </tr>
    <?php endforeach; ?>
  </tbody>
</table>

<?= \Pagination::instance('companies')->render(); ?>
