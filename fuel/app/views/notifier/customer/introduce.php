<?= $estimate->contact->name ?>様<br>
<br>
お世話になっております。<br>
enepi運営事務局でございます。<br>
<br>
<?= $company_name ?>様と連絡をご希望とのこと、承知致しました。<br>
それでは<?= $company_name ?>様とのご連絡の手続きを進めさせていただきます。<br>
<br>
■今後の流れ<br>
①<?= $company_name ?>様に、<?= $estimate->contact->name ?>様が連絡をご希望されている旨をお伝え致します。<br>
<br>
②<?= $company_name ?>様より、<?= $estimate->contact->name ?>様宛(<?= $estimate->contact->tel ?>)にお電話にてご連絡が入ります。<br>
プロパンガスの供給契約を結んでいただくにあたり、<?= $company_name ?>より直接ご説明がございます。<br>
気軽にご相談いただければと思います。<br>
<br>
③<?= $company_name ?>様にガスの変更を希望される場合は、そのまま担当の方と直接のやり取りになります。<br>
ご訪問時に変更の意向があればその場で契約手続き、後日である場合は再訪問から契約手続きへ<br>
という流れとなります。<br>
<?= $company_name ?>様よりご連絡が入りましたら、ご対応よろしくお願い申し上げます。<br>
<br>
<!-- FIX ME -->
<% if NewYearHoliday.holiday?(Time.zone.now) %>
  <%= NewYearHoliday.holiday_email_estimate_ok.gsub("{name}", $estimate.name).split("\n").join("<br>").html_safe %><br>
  <br>
<% endif; %>
■注意事項<br>
また本件に関して<br>
・他候補の会社にする<br>
・ご要望<br>
・連絡がない<br>
・トラブルが発生した<br>
検討の上、上記のようなことがありましたら<br>
このメールに返信いただくか、下記の連絡先に連絡ください。<br>
--<br>
enepi運営事務局　連絡先<br>
TEL：<?= \Config::get('enepi.service.tel'); ?><br>
Mail：<?= \Config::get('enepi.service.email'); ?><br>
--<br>
<br>
その他ご不明な点などございましたら、気兼ねなくご連絡いただけますと幸いでございます。<br>
お手数おかけ致しますが、何卒宜しくお願い申し上げます。<br>
