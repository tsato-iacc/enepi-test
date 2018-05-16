<?= \Form::open(['action' => \Uri::create('admin/templates/:id', ['id' => $template->id])]); ?>
  <?= \Form::csrf(); ?>
  <?= render('admin/templates/_form', ['val' => $val, 'template' => $template]); ?>
  <button type="submit" class="btn btn-primary">登録する</button>
<?= Form::close(); ?>

<?= render('admin/templates/_documentation'); ?>
