<a href="<?= \Uri::create('admin/estimates/:id', ['id' => $estimate->id]); ?>"><?= $estimate->uuid ?></a>/紹介 (<?= $estimate->company->getCompanyName(); ?>)
<br>
<?= render('notifier/footer'); ?>
