<?= \Form::open(['action' => \Uri::create('admin/partner_companies/:id', ['id' => $company->id])]); ?>
  <?= \Form::csrf(); ?>
  <?= render('admin/partnerCompanies/_form'); ?>
  <button type="submit" class="btn btn-primary">更新する</button>
<?= Form::close(); ?>
