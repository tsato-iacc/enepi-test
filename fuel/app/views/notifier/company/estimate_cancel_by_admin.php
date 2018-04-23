<p>
  <?= $estimate->company->partner_company->company_name; ?><br>
  ご担当者様
</p>

<p>
お世話になります。<br>
enepi(エネピ)運営事務局でございます。
</p>

<p>
  ご紹介させていただきました【案件番号:<a href="<?= \Uri::create('partner/estimates/:uuid', ['uuid' => $estimate->uuid]); ?>"><?= $estimate->uuid ?></a>】について、
  今回のご登録についてキャンセルさせていただきました。
</p>
<p>
  ご対応いただいている中、大変恐縮ではございますが、
  ご確認の程よろしくお願い申し上げます。
<p>
<p>
  引き続き他のユーザー様のご対応をよろしくお願い申し上げます。
  今度ともどうぞよろしくお願いいたします。
</p>

<p>
  貴社専用管理画面ログインURL<br>
  <a href="<?= \Uri::create('partner/estimates/:uuid', ['uuid' => $estimate->uuid]); ?>"><?= \Uri::create('partner/estimates/:uuid', ['uuid' => $estimate->uuid]); ?></a>
</p>
<br>
<?= render('notifier/footer'); ?>
