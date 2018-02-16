<?= $estimate->contact->name; ?>様<br>
<br>
お世話になっております。<br>
enepi運営事務局でございます。<br>
<br>
お問い合わせ頂いておりますプロパンガス料金のお見積りにつきまして、<br>
ガス会社様よりお見積りを頂きましたので、お送りいたします。<br>
<br>
下記URLでSMSで届いた認証コードを入力の上、お見積もり内容をご確認いただきますようお願い申し上げます。<br>
<br>
【ご提案内容URL：<a href="<?= \Uri::create("lpgas/contacts/{$estimate->contact->id}?token={$estimate->contact->token}"); ?>"><?= \Uri::create("lpgas/contacts/{$estimate->contact->id}?token={$estimate->contact->token}"); ?></a><br>】<br>
<br>
■ご提案企業<br>
<?= $estimate->company->getCompanyName(); ?><br>
<br>
■料金プラン<br>
基本料金：<?= number_format($estimate->basic_price); ?>円<br>
<?php if (count($estimate->prices) == 1): ?>
  従量単価（m3）：<?= number_format(array_shift($estimate->prices)->unit_price); ?>円<br>
<?php else: ?>
  従量単価（m3）
  <ul>
    <?php foreach ($estimate->prices as $price): ?>
      <li><b><?= $price->getRangeLabel() ?>:</b> <?= number_format($price->unit_price); ?>円</li>
    <?php endforeach; ?>
  </ul>
<?php endif; ?>
燃料調整費（円/m3）：<?= number_format($estimate->fuel_adjustment_cost); ?>円<br>
■年間節約効果<br>
<?= number_format($saving); ?>円<br>
<br>
■備考<br>
<?= $estimate->notes; ?><br>
<br>
ガス会社切り替えのご希望がございましたら、本メールにご返信頂くか、<br>
もしくはenepi運営事務局のフリーダイヤル（0120-771-664）まで<br>
ご連絡頂けますと幸いです。<br>
<br>
ご検討の程、何卒宜しくお願い申し上げます<br>
<br>
<?= render('notifier/footer'); ?>
