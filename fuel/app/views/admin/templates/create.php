<?= \Form::open(['action' => \Uri::create('admin/templates')]); ?>
  <?= \Form::csrf(); ?>
  <?= render('admin/templates/_form', ['val' => $val, 'template' => $template]); ?>
  <button type="submit" class="btn btn-primary">登録する</button>
<?= Form::close(); ?>

<?= render('admin/templates/_documentation'); ?>
