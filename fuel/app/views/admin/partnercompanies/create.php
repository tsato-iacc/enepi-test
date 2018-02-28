<?= \Form::open(['action' => \Uri::create('admin/partner_companies'), 'enctype' => 'multipart/form-data']); ?>
  <?= \Form::csrf(); ?>
  <?= render('admin/partnercompanies/_form', ['val' => $val, 'partner_company' => $partner_company, 'company_image_err' => $company_image_err, 'company_logo_err' => $company_logo_err]); ?>
  <button type="submit" class="btn btn-primary">登録する</button>
<?= Form::close(); ?>
