<?php if (\Fuel::$env == \Fuel::PRODUCTION): ?>
<a href="<?= \Uri::create('https://enepi.jp/admin/contacts/:id/edit', ['id' => $contact->id]) ?>">新規見積もり。</a>
<?php else: ?>
<a href="<?= \Uri::create('admin/contacts/:id/edit', ['id' => $contact->id]) ?>">新規見積もり。</a>
<?php endif; ?>
<br>
<?= render('notifier/footer'); ?>
