登録日時：<?= Date::forge(null, 'Asia/Tokyo')->format('front_presentation'); ?><br>
ユーザーID：<?= $contact->id; ?><br>
対象の物件はどの様な形態でしょうか？：<?= $data['q_1']; ?><br>
対象物件のご使用のガスの種類は？：<?= $data['q_2']; ?><br>
対象物件の築年数は？：<?= $data['q_3']; ?><br>
<br>
問い合わせ編集ページ：
<a href="<?= \Uri::create('admin/contacts/:id/edit', ['id' => $contact->id]); ?>"><?= \Uri::create('admin/contacts/:id/edit', ['id' => $contact->id]); ?></a><br>
<br>
<?= render('notifier/footer'); ?>
