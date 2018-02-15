<?= $estimate->company->getCompanyName(); ?>/見積り提示<br>
(見積りID:<?= $estimate->uuid ?>)<br>
確認後、ユーザーへ送信してください。
<br>
<?= render('notifier/footer'); ?>
