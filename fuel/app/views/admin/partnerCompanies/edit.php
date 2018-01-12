<?= \Form::open(['action' => \Uri::create('admin/partner_companies/:id', ['id' => $partner_company->id])]); ?>
  <?= \Form::csrf(); ?>
  <?= render('admin/partnerCompanies/_form', ['val' => $val, 'partner_company' => $partner_company]); ?>
  <button type="submit" class="btn btn-primary">更新する</button>
<?= Form::close(); ?>
