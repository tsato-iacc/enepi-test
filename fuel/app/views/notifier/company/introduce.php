<?= $estimate->uuid; ?>さんが連絡希望<br>
<br>
<?= $estimate->company->partner_company->company_name; ?><br>
ご担当者様<br>
<br>
お世話になります。<br>
enepi(エネピ)運営事務局でございます。<br>
<br>
先日貴社への切替を検討されているユーザーから、<br>
貴社との連絡希望の意思表示をいただきました。<br>
<br>
つきましては、該当案件について個人情報を開示しておりますので、<br>
下記、貴社専用管理画面からご確認の上、ユーザー様にご連絡いただき、<br>
ご相談・現地調査・契約に向けてご連絡頂きますようお願い申し上げます。<br>
<br>
<p>
  貴社専用管理画面ログインURL<br>
  <a href="<?= \Uri::create('partner/estimates/:id', ['id' => $estimate->id]); ?>"><?= \Uri::create('partner/estimates/:id', ['id' => $estimate->id]); ?></a>
</p>
お手数おかけ致しますが、何卒宜しくお願い致します。<br>
ご不明な点がございましたら、お気軽にお問い合わせくださいますようお願い申し上げます。<br>
<br>
<?= render('notifier/footer'); ?>
