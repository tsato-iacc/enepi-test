<div class="btn-group mb-4" role="group" aria-label="Company">
  <a class="btn btn-secondary" href="<?= \Uri::create('admin/companies/:id/estimates', ['id' => $partner_company->company->id]); ?>" role="button"><i class="fa fa-handshake-o"></i> 見積もり依頼一覧</a>
  <a class="btn btn-secondary" href="<?= \Uri::create('admin/companies/:id/ng', ['id' => $partner_company->company->id]); ?>" role="button"><i class="fa fa-exclamation-triangle"></i> NG企業</a>
  <a class="btn btn-secondary" href="<?= \Uri::create('admin/companies/:id/offices', ['id' => $partner_company->company->id]); ?>" role="button"><i class="fa fa-map-marker"></i> 営業拠点一覧</a>
</div>

<?= \Form::open(['action' => \Uri::create('admin/partner_companies/:id', ['id' => $partner_company->id]), 'enctype' => 'multipart/form-data']); ?>
  <?= \Form::csrf(); ?>
  <?= render('admin/partnercompanies/_form', ['val' => $val, 'partner_company' => $partner_company, 'company_image_err' => $company_image_err, 'company_logo_err' => $company_logo_err]); ?>
  <button type="submit" class="btn btn-primary">更新する</button>
<?= Form::close(); ?>

<!-- TEMPLATE PICKUP START -->
<?= render('admin/partnercompanies/_template_pickup'); ?>
<!-- TEMPLATE PICKUP END -->
