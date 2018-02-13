<div class="btn-group mb-4" role="group" aria-label="Company">
  <a class="btn btn-secondary" href="<?= \Uri::create('admin/companies/:id/estimates', ['id' => $partner_company->company->id]); ?>" role="button"><i class="fa fa-handshake-o"></i> 見積もり依頼一覧</a>
  <a class="btn btn-secondary" href="<?= \Uri::create('admin/companies/:id/ng', ['id' => $partner_company->company->id]); ?>" role="button"><i class="fa fa-exclamation-triangle"></i> NG企業</a>
  <a class="btn btn-secondary" href="<?= \Uri::create('admin/companies/:id/offices', ['id' => $partner_company->company->id]); ?>" role="button"><i class="fa fa-map-marker"></i> 営業拠点一覧</a>
</div>

<?= \Form::open(['action' => \Uri::create('admin/partner_companies/:id', ['id' => $partner_company->id])]); ?>
  <?= \Form::csrf(); ?>
  <?= render('admin/partnerCompanies/_form', ['val' => $val, 'partner_company' => $partner_company]); ?>
  <button type="submit" class="btn btn-primary">更新する</button>
<?= Form::close(); ?>
