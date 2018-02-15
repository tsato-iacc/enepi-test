<p>
  <?= $estimate->company->partner_company->company_name; ?><br>
  ご担当者様
</p>

<p>
お世話になります。<br>
enepi(エネピ)運営事務局でございます。
</p>

<?php if ($by_user): ?>
  <p>
    ご紹介させていただきました【案件番号:<?= $estimate->uuid ?>】について、
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
<?php else: ?>
  <p>
    ご要望いただきました【案件番号:<?= $estimate->uuid ?>】のキャンセルについて承りました。<br>
    引き続き他のユーザー様のご対応をよろしくお願い申し上げます。
  </p>
  <p>
    今度ともどうぞよろしくお願いいたします。
  </p>
<?php endif; ?>
<p>
  貴社専用管理画面ログインURL<br>
  <!-- FIX ME -->
  <?= "link_to partner_root_url, partner_root_url" ?>
</p>
<br>
<?= render('notifier/footer'); ?>
