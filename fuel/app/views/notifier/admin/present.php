問い合わせID: <a href="<?= \Uri::create('admin/contacts/:id/edit', ['id' => $estimate->contact->id]); ?>"><?= $estimate->contact->id; ?></a> に <a href="<?= \Uri::create("lpgas/contacts/{$estimate->contact->id}/estimates/{$estimate->uuid}?token={$estimate->contact->token}"); ?>">見積り</a> を提示しました。
<br>
<?= render('notifier/footer'); ?>
