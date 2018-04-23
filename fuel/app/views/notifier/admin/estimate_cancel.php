<a href="<?= \Uri::create('admin/estimates/:id', ['id' => $estimate->id]); ?>"><?= $estimate->uuid ?></a>/キャンセル(理由:<?= $reason; ?>)
<br>
<?= render('notifier/footer'); ?>
