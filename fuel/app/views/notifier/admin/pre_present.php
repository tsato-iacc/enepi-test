<?= $estimate->company->getCompanyName(); ?>/見積り提示<br>
(見積りID:<a href="<?= \Uri::create('admin/estimates/:id', ['id' => $estimate->id]); ?>"><?= $estimate->uuid ?></a>)<br>
確認後、ユーザーへ送信してください。
<br>
<?= render('notifier/footer'); ?>
