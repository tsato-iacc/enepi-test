<?= \Form::open(['action' => \Uri::create('admin/partner_companies')]); ?>
  <?= \Form::csrf(); ?>
  <?= render('admin/partnercompanies/_form', ['val' => $val, 'partner_company' => $partner_company]); ?>
  <button type="submit" class="btn btn-primary">登録する</button>
<?= Form::close(); ?>
