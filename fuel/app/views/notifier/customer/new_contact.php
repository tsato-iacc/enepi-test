<?= $contact->name ?>様<br>
<br>
<?php if ($contact->from_kakaku): ?>
  はじめまして。<br>
  プロパンガス(LPガス)お見積もりサービス『enepi』運営事務局でございます。<br>
  <br>
  この度は、価格.comよりお見積もりのご依頼を頂き、誠にありがとうございます。<br>
<?php else: ?>
  この度はプロパンガスのお見積もりサービス『enepi』より<br>
  お見積もりのご依頼を頂き、誠にありがとうございます。<br>
<?php endif; ?>
<br>
<?php if ($contact->sent_auto_estimate_req): ?>
  このSMSで届いたコードを、以下のページで入力してください。<br>
  <a href="<?= \Uri::create("lpgas/contacts/{$contact->id}?token={$contact->token}"); ?>"><?= \Uri::create("lpgas/contacts/{$contact->id}?token={$contact->token}"); ?></a><br>
  ■次の画面に進めない方<br>
  ・SMSがどうしても届かない<br>
  ・認証コード入力やその他操作でエラーが発生する<br>
  など、提案内容が見れない場合は、<br>
  このメールに返信いただくか、下記に連絡ください。<br>
<?php else: ?>
  今後のステップをお伝えいたします。<br>
  <br>
  ①enepi運営事務局からお見積もりに関するご連絡が1週間以内に入ります。<br>
  ②メールでの見積書送付およびお電話での確認、プラン説明やご要望に対するご相談等をさせていただきます。<br>
  ③切替希望ガス会社が決まりましたら、ガス会社と直接やり取りできる様対応いたします。<br>
  ④ガス会社が訪問・工事を行い、切替が完了します。<br>
  <br>
  <?php if (\Model_Holiday::isHolliday()): ?>
    <?= \Model_Holiday::holiday_email_contact(); ?><br>
  <?php else: ?>
    お客様へのお見積りの準備に時間を要することがございますが、<br>
    原則1週間以内には必ずご連絡を差し上げております。<br>
    1週間を経過しても連絡がない場合に関しましては、お手数ではございますが、<br>
    再度、enepi運営事務局までお問い合わせいただきますようお願い申し上げます。<br>
  <?php endif; ?>
  <br>
  ご不明な点などございましたら、下記連絡先かこのメールの返信に、<br>
  気兼ねなくご連絡いただけますと幸いです。<br>
<?php endif; ?>
<br>
--<br>
enepi運営事務局　連絡先<br>
<br>
TEL：<?= $contact->from_kakaku ? \Config::get('enepi.service.tel_kakaku') : \Config::get('enepi.service.tel'); ?><br>
Mail：<?= \Config::get('enepi.service.email'); ?><br>
--<br>
<br>
当サイトを通じて、<?= $contact->name ?>様にとってよきLPガス切替の機会となることを<br>
心よりお祈り申し上げます。<br>
どうぞよろしくお願い申し上げます。<br>
<br>
<?= render('notifier/footer'); ?>
